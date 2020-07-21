<?php
function conn() {
    $conn = mysqli_connect("localhost","okema_new","okema_new","okema_new");
    return $conn;
}

function aramex_account() {
    $query  = mysqli_query(conn(), "SELECT * FROM `business_settings` WHERE type='aramex_setting'");
    $business_settings      = mysqli_fetch_array($query);

    $aramex_setting         = json_decode($business_settings['value'],true);
    $aramex_username        = $aramex_setting['aramex_username'] ?? '';
    $aramex_password        = $aramex_setting['aramex_password'] ?? '';
    $aramex_entity          = $aramex_setting['aramex_entity'] ?? '';
    $aramex_country_code    = $aramex_setting['aramex_country_code'] ?? '';
    $aramex_pin             = $aramex_setting['aramex_pin'] ?? '';
    $aramex_number          = $aramex_setting['aramex_number'] ?? '';

    return array(
        'AccountCountryCode'    => $aramex_country_code, //SA
        'AccountEntity'         => $aramex_entity, //RUH
        'AccountNumber'         => $aramex_number, //60497115
        'AccountPin'            => $aramex_pin, //331432
        'UserName'              => $aramex_username, //beautygroup10@gmail.com
        'Password'              => $aramex_password, //!@34QWerASdf
        'Version'               => 'v1' //v1
    );
}

function shipmentsTracking($shipment_id = 30499148470) {
    $soapClient = new SoapClient('public/shipments-tracking-api-wsdl.wsdl');
    $params     = array(
        'ClientInfo'                => aramex_account(), 
        'Transaction'               => array('Reference1' => '001'), 
        'Shipments'                 => array($shipment_id),
    );
    
    $shipmentsTracking = $soapClient->TrackShipments($params);
    if ($shipmentsTracking->HasErrors == false) {
        $shipmentData = $shipmentsTracking->TrackingResults->KeyValueOfstringArrayOfTrackingResultmFAkxlpY->Value->TrackingResult ?? null;
    } else {
        $shipmentData = "";
    }
    
    return $shipmentData;
}

$shipment_code_array = array("SH005","SH006","SH006","SH018","SH034","SH069","SH070","SH071","SH236","SH237","SH280","SH293","SH301","SH380","SH404","SH407","SH408","SH414","SH422","SH422","SH459","SH463","SH473","SH475","SH496","SH514","SH534","SH439");

#aramex_id !='' AND OrderStatus !='Delivered'
$query= mysqli_query(conn(), "SELECT * FROM `orders` WHERE ForwardToAramex='TRUE' AND FinalStatus !='TRUE'");
if(mysqli_num_rows($query) > 0)
{
    while($arr = mysqli_fetch_array($query))
    {
        if(!empty($arr['aramex_id']))
        {
            $aramex_id  = $arr['aramex_id'];
            $shipments = shipmentsTracking($aramex_id);
            if(!empty($shipments)) 
            {
                $order_status = $shipments->UpdateDescription;
                if(in_array($shipments->UpdateCode, $shipment_code_array))
                {
                    $finalstatus = "TRUE";                    
                } else {
                    $finalstatus = "FALSE";                    
                }
                mysqli_query(conn(), "UPDATE `orders` SET `OrderStatus`='$order_status', `FinalStatus`='FALSE' WHERE `aramex_id`='$aramex_id' AND FinalStatus='$finalstatus'");
                echo "Success";
            }
        }
    }
} else {
    echo "Error";
}
?>