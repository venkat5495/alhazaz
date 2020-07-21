<?php

namespace App\Http\Controllers;

use App\GeneralSetting;
use Illuminate\Http\Request;
use App\Order;
use PDF;
use Auth;

class InvoiceController extends Controller
{
    //downloads customer invoice
    public function customer_invoice_download($id)
    {
        $order = Order::findOrFail($id);
        $generalSetting = GeneralSetting::first();
        $pdf = PDF::loadView('invoices.customer_invoice', compact('order','generalSetting'));
        $order->print_view = 1;
        $order->save();
        return $pdf->download('order-'.$order->code.'.pdf');
    }

    public function customer_invoice_view($id)
    {
        $order = Order::findOrFail($id);
        $generalSetting = GeneralSetting::first();
        $pdf = PDF::loadView('invoices.customer_invoice', compact('order','generalSetting'));
        return $pdf->stream('order-'.$order->code.'.pdf');
    }

    //downloads seller invoice
    public function seller_invoice_download($id)
    {
        $order = Order::findOrFail($id);
        $generalSetting = GeneralSetting::first();
        $pdf = PDF::loadView('invoices.seller_invoice', compact('order','generalSetting'));
        return $pdf->download('order-'.$order->code.'.pdf');
    }
    
    public function shipping_label_download($id)
    {
        $order = Order::findOrFail($id);
        $location = public_path('uploads/aramex/'.$order->label_url) ;
        // Optional: serve the file under a different filename:
        $filename = $order->code.'.pdf';
        // optional headers
        $headers = [];
        return response()->download($location, $filename, $headers);
    }

    public function customer_multipleinvoice_download(Request $request)
    {
        if(!empty($request->ids))
        {
            $ids = $request->ids;
            $pdf = PDF::loadView('invoices.multicustomer_invoice', compact('ids'));
            return $pdf->stream('multiple-order.pdf');
        }
    }

    public function shipping_multiplelabel_download(Request $request)
    {
        if(!empty($request->ids))
        {
            foreach($request->ids as $id)
            {
                $order    = Order::findOrFail($id);
                if(!empty($order->label_url))
                {
                    $location = public_path('uploads/aramex/'.$order->label_url) ;
                    $filename = $order->code.'.pdf';
                    $headers  = [];                    
                }
            }
            return response()->download($location, $filename, $headers);
        }
    }

    public function updateAramexStatus(Request $request)
    {
        if(!empty($request->ids) && !empty($request->status))
        {
            foreach($request->ids as $id)
            {
                $item_array = array();
                $order = Order::findOrFail($id);
        		if($request->status == 'Registering orders in Aramex')
        		{
            		if(!empty($order->shipping_address))
            		{
                		$shipping_address = json_decode($order->shipping_address);
                		$item_array[] = array(
                            'PackageType' => 'Box',
                            'Quantity'    => $qty,
                            'Weight'      => array(
                                'Value'   => 0.5,
                                'Unit'    => 'KG',
                            ),
                            'Comments'    => "Test",
                            'Reference'   => ''
                        );
                		$data_to_shipping = array(
                		    'PaymentOptions' => $order->payment_type == 'cash_on_delivery' ? 'CASH' : '',
                		    'CollectAmount'  => $order->payment_type == 'cash_on_delivery' ? $order->grand_total : 0,
                		    'Items'          => $item_array,
                		);

                		$consingnee_address = array(
                		    'address_line_1' => $shipping_address->address ?? '',
                		    'city'           => $shipping_address->city ?? '',
                		    'country_code'   => 'SA',
                		    'person_name'    => $shipping_address->name ?? '',
                		    'CellPhone'      => $shipping_address->phone ?? '',
                		    'phone_number_1' => $shipping_address->phone ?? '',
                		    'EmailAddress'   => $shipping_address->email ?? '',
                		    'company_name'   => $shipping_address->name ?? '',
                		);
                		$qty = $order->orderDetails->count('');
                		$aramex_details = shipping($consingnee_address,$data_to_shipping, $qty, $order->grand_total);
                        if($aramex_details->HasErrors==true)
                        {
                            echo json_encode(array('status'=>'error', 'message'=>$aramex_details->Shipments->ProcessedShipment->Notifications->Notification->Message));
                            exit;
                        }
                		if(!empty($aramex_details))
                		{
                    		if (isset($aramex_details->HasErrors) && empty($aramex_details->HasErrors)) {
                    		    $order->aramex_id = isset($aramex_details->Shipments->ProcessedShipment->ID) ? $aramex_details->Shipments->ProcessedShipment->ID : '';
                    		    $order->label_url = isset($aramex_details->Shipments->ProcessedShipment->ShipmentLabel->LabelURL) ? store_aramex_lable($aramex_details->Shipments->ProcessedShipment->ShipmentLabel->LabelURL) : '';
                                $order->OrderStatus = 'Record Created.';
                                $order->ForwardToAramex = "TRUE";
                    		}else{
                    		    $order->aramex_id = '';
                    		    $order->label_url = 'data not find';
                    		}
                    		$order->save();
                		}
                    }
        		} else {
		            $order->OrderStatus = $request->status;
            		$order->save();
        		}
        	}
        	echo json_encode(array('status'=>'success', 'message'=>'Successfully updated status.'));
        } else {
            echo json_encode(array('status'=>'error', 'message'=>'Please atleast one order to update status.'));
        }
    }
}
