<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SoapClient;

class AramexController extends Controller
{
    public function ratesCalculatorAPI()
    {
        $params = array(
            'ClientInfo' => array(
                /*'AccountCountryCode' => 'GB',
                'AccountEntity' => 'LON',
                'AccountNumber' => '102331',
                'AccountPin' => '321321',*/
                'UserName' => 'vikas.k@cearsinfotech.com',
                'Password' => 'Haresh@05',
                'Version' => 'v1'
            ),

            'Transaction' => array(
                'Reference1' => '001'
            ),

            'OriginAddress' => array(
                'City' => 'Riyadh', //Riyadh
                'CountryCode' => 'SA' //SA
            ),

            'DestinationAddress' => array(
                'City' => 'Jeddah', //Jeddah
                'CountryCode' => 'SA' //SA
            ),
            'ShipmentDetails' => array(
                'PaymentType' => 'P', //P,C,3
                'ProductGroup' => 'EXP', //EXP,DOM
                'ProductType' => 'PPX', //PPX
                'ActualWeight' => array('Value' => 5, 'Unit' => 'KG'),
                'ChargeableWeight' => array('Value' => 5, 'Unit' => 'KG'),
                'NumberOfPieces' => 5
            )
        );
        $soapClient = new SoapClient(asset('/public/aramex-rates-calculator-wsdl.wsdl'), array('trace' => 1));
        $results = $soapClient->CalculateRate($params);
        dd($results);
        echo '<pre>';
        print_r($results);
        die();

    }

    public function shippingServicesAPI()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        $soapClient = new \SoapClient(asset('/public/shipping-services-api-wsdl.wsdl'));
        echo '<pre>';
        print_r($soapClient->__getFunctions());

        $params = array(
            'Shipments' => array(
                'Shipment' => array(
                    'Shipper'	=> array(
                        'Reference1' 	=> 'Ref 111111',
                        'Reference2' 	=> 'Ref 222222',
                        'AccountNumber' => '60497115',
                        'PartyAddress'	=> array(
                            'Line1'					=> 'Mecca St',
                            'Line2' 				=> '',
                            'Line3' 				=> '',
                            'City'					=> 'Riyadh',
                            'StateOrProvinceCode'	=> '',
                            'PostCode'				=> '',
                            'CountryCode'			=> 'SA'
                        ),
                        'Contact'		=> array(
                            'Department'			=> '',
                            'PersonName'			=> 'Michael',
                            'Title'					=> '',
                            'CompanyName'			=> 'Aramex',
                            'PhoneNumber1'			=> '5555555',
                            'PhoneNumber1Ext'		=> '125',
                            'PhoneNumber2'			=> '',
                            'PhoneNumber2Ext'		=> '',
                            'FaxNumber'				=> '',
                            'CellPhone'				=> '07777777',
                            'EmailAddress'			=> 'michael@aramex.com',
                            'Type'					=> ''
                        ),
                    ),

                    'Consignee'	=> array(
                        'Reference1'	=> 'Ref 333333',
                        'Reference2'	=> 'Ref 444444',
                        'AccountNumber' => '',
                        'PartyAddress'	=> array(
                            'Line1'					=> '15 ABC St',
                            'Line2'					=> '',
                            'Line3'					=> '',
                            'City'					=> 'Dubai',
                            'StateOrProvinceCode'	=> '',
                            'PostCode'				=> '',
                            'CountryCode'			=> 'AE'
                        ),

                        'Contact'		=> array(
                            'Department'			=> '',
                            'PersonName'			=> 'Mazen',
                            'Title'					=> '',
                            'CompanyName'			=> 'Aramex',
                            'PhoneNumber1'			=> '6666666',
                            'PhoneNumber1Ext'		=> '155',
                            'PhoneNumber2'			=> '',
                            'PhoneNumber2Ext'		=> '',
                            'FaxNumber'				=> '',
                            'CellPhone'				=> '07777777',
                            'EmailAddress'			=> 'mazen@aramex.com',
                            'Type'					=> ''
                        ),
                    ),

                    'ThirdParty' => array(
                        'Reference1' 	=> '',
                        'Reference2' 	=> '',
                        'AccountNumber' => '',
                        'PartyAddress'	=> array(
                            'Line1'					=> '',
                            'Line2'					=> '',
                            'Line3'					=> '',
                            'City'					=> '',
                            'StateOrProvinceCode'	=> '',
                            'PostCode'				=> '',
                            'CountryCode'			=> ''
                        ),
                        'Contact'		=> array(
                            'Department'			=> '',
                            'PersonName'			=> '',
                            'Title'					=> '',
                            'CompanyName'			=> '',
                            'PhoneNumber1'			=> '',
                            'PhoneNumber1Ext'		=> '',
                            'PhoneNumber2'			=> '',
                            'PhoneNumber2Ext'		=> '',
                            'FaxNumber'				=> '',
                            'CellPhone'				=> '07777777',
                            'EmailAddress'			=> '',
                            'Type'					=> ''
                        ),
                    ),

                    'Reference1' 				=> 'Shpt 0001',
                    'Reference2' 				=> '',
                    'Reference3' 				=> '',
                    'ForeignHAWB'				=> '',
                    'TransportType'				=> 0,
                    'ShippingDateTime' 			=> time(),
                    'DueDate'					=> time(),
                    'PickupLocation'			=> 'Reception',
                    'PickupGUID'				=> '',
                    'Comments'					=> 'Shpt 0001',
                    'AccountingInstrcutions' 	=> '',
                    'OperationsInstructions'	=> '',

                    'Details' => array(
                        'Dimensions' => array(
                            'Length'				=> 10,
                            'Width'					=> 10,
                            'Height'				=> 10,
                            'Unit'					=> 'cm',

                        ),

                        'ActualWeight' => array(
                            'Value'					=> 0.5,
                            'Unit'					=> 'Kg'
                        ),

                        'ProductGroup' 			=> 'EXP',
                        'ProductType'			=> 'PDX',
                        'PaymentType'			=> 'P',
                        'PaymentOptions' 		=> '',
                        'Services'				=> '',
                        'NumberOfPieces'		=> 1,
                        'DescriptionOfGoods' 	=> 'Docs',
                        'GoodsOriginCountry' 	=> 'Jo',

                        'CashOnDeliveryAmount' 	=> array(
                            'Value'					=> 0,
                            'CurrencyCode'			=> ''
                        ),

                        'InsuranceAmount'		=> array(
                            'Value'					=> 0,
                            'CurrencyCode'			=> ''
                        ),

                        'CollectAmount'			=> array(
                            'Value'					=> 0,
                            'CurrencyCode'			=> ''
                        ),

                        'CashAdditionalAmount'	=> array(
                            'Value'					=> 0,
                            'CurrencyCode'			=> ''
                        ),

                        'CashAdditionalAmountDescription' => '',

                        'CustomsValueAmount' => array(
                            'Value'					=> 0,
                            'CurrencyCode'			=> ''
                        ),

                        'Items' 				=> array(

                        )
                    ),
                ),
            ),

            'ClientInfo'  			=> array(
                'AccountCountryCode'	=> 'JO',
                'AccountEntity'		 	=> 'RUH',
                'AccountNumber'		 	=> '60497115', //20016
                'AccountPin'		 	=> '331432', //221321
                'UserName'              => 'beautygroup10@gmail.com', //vikas.k@cearsinfotech.com
                'Password'              => '!@34QWerASdf', //Haresh@05
                'Version'			 	=> '1.0'
            ),

            'Transaction' 			=> array(
                'Reference1'			=> '001',
                'Reference2'			=> '',
                'Reference3'			=> '',
                'Reference4'			=> '',
                'Reference5'			=> '',
            ),
            'LabelInfo'				=> array(
                'ReportID' 				=> 9201,
                'ReportType'			=> 'URL',
            ),
        );

        $params['Shipments']['Shipment']['Details']['Items'][] = array(
            'PackageType' 	=> 'Box',
            'Quantity'		=> 1,
            'Weight'		=> array(
                'Value'		=> 0.5,
                'Unit'		=> 'Kg',
            ),
            'Comments'		=> 'Docs',
            'Reference'		=> ''
        );

        print_r($params);

        try {
            $auth_call = $soapClient->CreateShipments($params);
            echo '<pre>';
            print_r($auth_call);
            die();
        } catch (SoapFault $fault) {
            die('Error : ' . $fault->faultstring);
        }

    }

    public function shipmentsTrackingAPI()
    {

        $soapClient = new SoapClient(asset('public/shipments-tracking-api-wsdl.wsdl'));
        echo '<pre>';
        // shows the methods coming from the service
        print_r($soapClient->__getFunctions());

        /*
            parameters needed for the trackShipments method , client info, Transaction, and Shipments' Numbers.
            Note: Shipments array can be more than one shipment.
        */
        $params = array(
            'ClientInfo' => array(
                'AccountCountryCode' => 'SA', //SA
                'AccountEntity' => 'RUH', //RUH
                'AccountNumber' => '60497115', //60497115
                'AccountPin' => '331432', //331432
                'UserName' => 'beautygroup10@gmail.com', //beautygroup10@gmail.com
                'Password' => '!@34QWerASdf', //!@34QWerASdf
                'Version' => 'v1' //v1
            ),

            'Transaction' => array(
                'Reference1' => '001'
            ),
            'Shipments' => array(
                '30499046756'
            )
        );

        // calling the method and printing results
        try {
            $auth_call = $soapClient->TrackShipments($params);
//            dd($auth_call);
            echo '<pre>';
            print_r($auth_call);
            die();
        } catch (SoapFault $fault) {
            die('Error : ' . $fault->faultstring);
        }


    }
}
