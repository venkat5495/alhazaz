<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('reports', 'HomeController@notification');
Route::get('/user/otp-screen', 'HomeController@otpscreen')->name('frontend.login_opt');
Route::post('/user/otp-verify', 'HomeController@useroptverify')->name('user.opt.verify');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes(['verify' => true]);
Route::get('/language/{locale}', 'LanguageController@changeLanguage')->name('language.change');
//Route::post('/language', 'LanguageController@changeLanguage')->name('language.change');
Route::get('/currency/{currency}', 'CurrencyController@changeCurrency')->name('currency.change');
//Route::post('/currency', 'CurrencyController@changeCurrency')->name('currency.change');
Route::get('contact-us', 'HomeController@contactus')->name('enquiry');
Route::get('dealcount', 'HomeController@dealcount')->name('dealcount');
Route::post('send-enquiry', 'HomeController@sendenquiry')->name('send.enquiry');
Route::group(['middleware' => ['checkuser']], function() {

Route::get('/social-login/redirect/{provider}', 'Auth\LoginController@redirectToProvider')->name('social.login');
Route::get('/social-login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');
Route::get('/users/login', 'HomeController@login')->name('user.login');
Route::get('/forgot/password','HomeController@forgot_pass')->name('forgot.password');
Route::post('/password/phone','HomeController@phone_pass')->name('password.phone');
Route::get('/users/registration', 'HomeController@registration')->name('user.registration');

Route::any('/users/store', 'HomeController@store')->name('user.store');

Route::post('/users/login', 'HomeController@user_login')->name('user.login.submit');
Route::post('/users/login/cart', 'HomeController@cart_login')->name('cart.login.submit');


Route::post('/subcategories/get_subcategories_by_category', 'SubCategoryController@get_subcategories_by_category')->name('subcategories.get_subcategories_by_category');
Route::post('get_subcategories', 'SubCategoryController@get_subcategories')->name('get_subcategories');
Route::post('get_attribute_title', 'ProductController@get_attribute_title')->name('get_attribute_title');

Route::post('/subsubcategories/get_subsubcategories_by_subcategory', 'SubSubCategoryController@get_subsubcategories_by_subcategory')->name('subsubcategories.get_subsubcategories_by_subcategory');
Route::post('get_subsubcategories', 'SubSubCategoryController@get_subsubcategories')->name('get_subsubcategories');

Route::post('/subsubcategories/get_brands_by_subsubcategory', 'SubSubCategoryController@get_brands_by_subsubcategory')->name('subsubcategories.get_brands_by_subsubcategory');
Route::post('get_brands', 'SubSubCategoryController@get_brands')->name('get_brands');
Route::post('get_products', 'SubSubCategoryController@get_products')->name('get_products');

Route::post('/getcategories/products', 'ProductController@getcategoriesproduct')->name('get_subsubcategories_products');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'HomeController@product')->name('product');
Route::get('/ajaxproduct', 'HomeController@ajaxproduct')->name('ajaxproduct');
Route::get('/products', 'HomeController@listing')->name('products');
Route::get('/search?category_id={category_id}', 'HomeController@search')->name('products.category');
Route::get('/search?subcategory_id={subcategory_id}', 'HomeController@search')->name('products.subcategory');
Route::get('/search?subsubcategory_id={subsubcategory_id}', 'HomeController@search')->name('products.subsubcategory');
Route::get('/search?brand_id={brand_id}', 'HomeController@search')->name('products.brand');
Route::get('/our_collection', 'HomeController@our_collection')->name('our_collection');


Route::get('/brands', 'HomeController@brands')->name('brands');
Route::get('/aboutus', 'HomeController@aboutus')->name('aboutus');
Route::get('/productsgroup/{q}', 'HomeController@productsgroup')->name('productsgroup');

Route::post('/product/variant_price', 'HomeController@variant_price')->name('products.variant_price');
Route::get('/shops/visit/{slug}', 'HomeController@shop')->name('shop.visit');
Route::get('/shops/visit/{slug}/{type}', 'HomeController@filter_shop')->name('shop.visit.type');
// Deals
Route::get('/deals', 'HomeController@deals')->name('products.deals');
Route::get('/offers', 'HomeController@offer')->name('products.offers');
Route::get('/offer-products/{id}', 'HomeController@offer_products')->name('offer_products');
Route::get('/offer-product-detail/{slug}/{offer_id}', 'HomeController@offer_product_detail')->name('offer_product_detail');
Route::get('/offer-products', 'HomeController@offer_product_search')->name('offer_product_search');

Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/cart/nav-cart-items', 'CartController@updateNavCart')->name('cart.nav_cart');
Route::any('/cart/show-cart-modal', 'CartController@showCartModal')->name('cart.showCartModal');
Route::post('/cart/addtocart', 'CartController@addToCart')->name('cart.addToCart');
Route::post('/cart/removeFromCart', 'CartController@removeFromCart')->name('cart.removeFromCart');
Route::post('/cart/updateQuantity', 'CartController@updateQuantity')->name('cart.updateQuantity');
Route::post('/cart/applypromo', 'CartController@applypromo')->name('cart.applypromo');
    Route::get('/cart_summary_ajax', 'CartController@cart_summary_ajax')->name('cart_summary_ajax');
    Route::get('/cod_charge_ajax', 'CartController@cod_charge')->name('cod_charge_ajax');
    Route::get('/get_cities', 'HomeController@get_cities')->name('cities_list');
    Route::get('/get_address_data','CartController@get_address_data')->name('get_address_data');
// Deals

Route::post('/checkout/payment', 'CheckoutController@checkout')->name('payment.checkout');
Route::get('/checkout', 'CheckoutController@get_shipping_info')->name('checkout.shipping_info');
Route::any('/checkout/payment_info', 'CheckoutController@get_payment_info')->name('checkout.payment_info');

//Paypal START
Route::get('/paypal/payment/done', 'PaypalController@getDone')->name('payment.done');
Route::get('/paypal/payment/cancel', 'PaypalController@getCancel')->name('payment.cancel');
//Paypal END

// SSLCOMMERZ Start
Route::get('/sslcommerz/pay', 'PublicSslCommerzPaymentController@index');
Route::POST('/sslcommerz/success', 'PublicSslCommerzPaymentController@success');
Route::POST('/sslcommerz/fail', 'PublicSslCommerzPaymentController@fail');
Route::POST('/sslcommerz/cancel', 'PublicSslCommerzPaymentController@cancel');
Route::POST('/sslcommerz/ipn', 'PublicSslCommerzPaymentController@ipn');
//SSLCOMMERZ END

//Stipe Start
Route::get('stripe', 'StripePaymentController@stripe');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');
//Stripe END

Route::get('/compare', 'CompareController@index')->name('compare');
Route::get('/compare/reset', 'CompareController@reset')->name('compare.reset');
Route::post('/compare/addToCompare', 'CompareController@addToCompare')->name('compare.addToCompare');

Route::resource('subscribers','SubscriberController');

Route::resource('orders','OrderController');
Route::get('/orders/destroy/{id}', 'OrderController@destroy')->name('orders.destroy');
Route::post('/orders/details', 'OrderController@order_details')->name('orders.details');
Route::post('/orders/update_status', 'OrderController@update_status')->name('orders.update_status');

Route::get('/categories', 'HomeController@all_categories')->name('categories.all');
Route::get('/more_products', 'HomeController@more_products_brand_subcategory')->name('more_products_brand_subcategory');
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/search?q={search}', 'HomeController@search')->name('suggestion.search');
Route::post('/ajax-search', 'HomeController@ajax_search')->name('search.ajax');
Route::post('/config_content', 'HomeController@product_content')->name('configs.update_status');

Route::get('/sellerpolicy', 'HomeController@sellerpolicy')->name('sellerpolicy');
Route::get('/returnpolicy', 'HomeController@returnpolicy')->name('returnpolicy');
Route::get('/supportpolicy', 'HomeController@supportpolicy')->name('supportpolicy');
Route::get('/terms', 'HomeController@terms')->name('terms');
Route::get('/privacypolicy', 'HomeController@privacypolicy')->name('privacypolicy');

// --cms--
Route::get('/cms/{slug}', 'HomeController@cms')->name('front_cms');


Route::group(['middleware' => ['user', 'verified']], function(){
	Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
	Route::get('/profile', 'HomeController@profile')->name('profile');
	Route::post('/customer/update-profile', 'HomeController@customer_update_profile')->name('customer.profile.update');
    Route::any('/customer/update-address', 'HomeController@customer_update_address')->name('customer.address.update');
    Route::any('/customer/add-address', 'HomeController@customer_add_address')->name('customer.address.add');
    Route::any('/customer/delete-address/{id}', 'HomeController@customer_destroy_address')->name('customer.address.destroy');


	Route::post('/customer/change-password','HomeController@customer_change_password')->name('customer.password.change');
	Route::post('/seller/update-profile', 'HomeController@seller_update_profile')->name('seller.profile.update');

	Route::resource('purchase_history','PurchaseHistoryController');
	Route::post('/purchase_history/details', 'PurchaseHistoryController@purchase_history_details')->name('purchase_history.details');
	Route::get('/purchase_history/destroy/{id}', 'PurchaseHistoryController@destroy')->name('purchase_history.destroy');

	Route::resource('wishlists','WishlistController');
	Route::post('/wishlists/remove', 'WishlistController@remove')->name('wishlists.remove');

	Route::post('submit-review', 'ReviewController@submitreview')->name('reviews.submit');
	Route::resource('/reviews', 'ReviewController');

	Route::get('/wallet', 'WalletController@index')->name('wallet.index');
	Route::post('/recharge', 'WalletController@recharge')->name('wallet.recharge');

	Route::get('/notification', 'ReviewController@getmynotification')->name('notification.index');
});

Route::group(['prefix' =>'seller', 'middleware' => ['seller', 'verified']], function(){
	Route::get('/products', 'HomeController@seller_product_list')->name('seller.products');
	Route::get('/product/upload', 'HomeController@show_product_upload_form')->name('seller.products.upload');
	Route::get('/product/{id}/edit', 'HomeController@show_product_edit_form')->name('seller.products.edit');
	Route::resource('payments','PaymentController');

	Route::get('/shop/apply_for_verification', 'ShopController@verify_form')->name('shop.verify');
	Route::post('/shop/apply_for_verification', 'ShopController@verify_form_store')->name('shop.verify.store');
});

Route::get('invoiceView/customer/{order_id}', 'InvoiceController@customer_invoice_view')->name('customer.invoice.view');
Route::group(['middleware' => ['auth']], function(){
	Route::post('/products/store/','ProductController@store')->name('products.store');
	Route::post('/products/update/{id}','ProductController@update')->name('products.update');
	Route::get('/products/destroy/{id}', 'ProductController@destroy')->name('products.destroy');
	Route::get('/products/duplicate/{id}', 'ProductController@duplicate')->name('products.duplicate');
	Route::post('/products/sku_combination', 'ProductController@sku_combination')->name('products.sku_combination');
	Route::post('/products/sku_combination_edit', 'ProductController@sku_combination_edit')->name('products.sku_combination_edit');
	Route::post('/products/featured', 'ProductController@updateFeatured')->name('products.featured');
	Route::post('/products/published', 'ProductController@updatePublished')->name('products.published');



	Route::get('invoice/customer/{order_id}', 'InvoiceController@customer_invoice_download')->name('customer.invoice.download');
	Route::get('invoice/seller/{order_id}', 'InvoiceController@seller_invoice_download')->name('seller.invoice.download');
	Route::get('shipping/label/{order_id}', 'InvoiceController@shipping_label_download')->name('shipping.label.download');

	Route::post('updateshippingstatus/multiplestatus', 'InvoiceController@updateAramexStatus')->name('customer.updateAramexStatus');
	Route::post('invoice/multiplecustomer', 'InvoiceController@customer_multipleinvoice_download')->name('customer.multipleinvoice.download');
	Route::post('shipping/multiplelabel', 'InvoiceController@shipping_multiplelabel_download')->name('shipping.multiplelabel.download');


	Route::resource('orders','OrderController');
	Route::get('/orders/destroy/{id}', 'OrderController@destroy')->name('orders.destroy');
	Route::post('/orders/update_delivery_status', 'OrderController@update_delivery_status')->name('orders.update_delivery_status');
	Route::post('/orders/update_payment_status', 'OrderController@update_payment_status')->name('orders.update_payment_status');

    Route::get('/orders/cancel_order/{id}', 'OrderController@cancel_order_load')->name('cancel_order_load');
    Route::post('/orders/cancel_order', 'OrderController@cancel_order')->name('cancel_order');
});

Route::resource('shops', 'ShopController');

});
Route::get('Rates-Calculator-API','AramexController@ratesCalculatorAPI');

Route::get('Shipping-Services-API','AramexController@shippingServicesAPI');

Route::get('Shipments-Tracking-API','AramexController@shipmentsTrackingAPI');
