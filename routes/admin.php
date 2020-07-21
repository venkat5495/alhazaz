<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::get('/admin', 'HomeController@admin_dashboard')->name('admin.dashboard')->middleware(['auth', 'admin']);
    Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::resource('categories','CategoryController');
    Route::get('/categories/destroy/{id}', 'CategoryController@destroy')->name('categories.destroy');
    Route::post('/categories/featured', 'CategoryController@updateFeatured')->name('categories.featured');

    Route::resource('subcategories','SubCategoryController');
    Route::get('/subcategories/destroy/{id}', 'SubCategoryController@destroy')->name('subcategories.destroy');

    Route::resource('subsubcategories','SubSubCategoryController');
    Route::get('/subsubcategories/destroy/{id}', 'SubSubCategoryController@destroy')->name('subsubcategories.destroy');

    Route::resource('brands','BrandController');
    Route::get('/brands/destroy/{id}', 'BrandController@destroy')->name('brands.destroy');

    Route::resource('specifications','SpecificationsController');
    Route::get('/specifications/destroy/{id}', 'SpecificationsController@destroy')->name('specifications.destroy');

    Route::resource('dynamicbanner','DynamicbannerController');
    Route::get('/dynamicbanner/destroy/{id}', 'DynamicbannerController@destroy')->name('dynamicbanner.destroy');

    Route::resource('productgroup','ProductGroupController');
    Route::get('/productgroup/destroy/{id}', 'ProductGroupController@destroy')->name('productgroup.destroy');
    Route::get('/productgroup/view_product', 'ProductGroupController@view_product')->name('productgroup.view_product');
    Route::get('/products/newarrival','ProductController@newarrival')->name('products.newarrival');
    Route::get('/products/createnewarrival','ProductController@createnewarrival')->name('products.createnewarrival');
    Route::any('/products/updatenewarrival','ProductController@updatenewarrival')->name('products.updatenewarrival');
    Route::any('/products/destroynewarrival/{id}','ProductController@destroynewarrival')->name('products.destroynewarrival');
    
    Route::any('/productdiscount','ProductGroupController@productdiscount')->name('productgroup.productdiscount');
    Route::any('/productreport','ProductGroupController@productreport')->name('productgroup.productreport');
    Route::any('/downloadproductreport','ProductGroupController@downloadproductreport')->name('productgroup.downloadproductreport');
    Route::any('/updateproductdiscount','ProductGroupController@updateproductdiscount')->name('productgroup.updateproductdiscount');
    Route::any('/bulkupload','ProductGroupController@bulkupload')->name('productgroup.bulkupload');
    Route::any('/savebulkupload','ProductGroupController@savebulkupload')->name('productgroup.savebulkupload');
    Route::any('/session_product','ProductGroupController@session_product')->name('productgroup.session_product');
    Route::any('/edit_ajax_list','ProductGroupController@edit_ajax_list')->name('productgroup.edit_ajax_list');
    Route::get('/edit_redirect/{id}','ProductGroupController@edit_redirect')->name('productgroup.edit_redirect');    

    Route::resource('media','MediaController');
    Route::get('/media/destroy/{id}', 'MediaController@destroy')->name('media.destroy');

    Route::resource('coupons','CouponController');
    Route::get('/coupons/destroy/{id}', 'CouponController@destroy')->name('coupons.destroy');

    Route::resource('adverts','AdvertBannerController');
    Route::get('/adverts/destroy/{id}', 'AdvertBannerController@destroy')->name('adverts.destroy');

    Route::resource('offer', 'OfferController');
    Route::get('/offer/destroy/{id}', 'OfferController@destroy')->name('offer.destroy');

    Route::resource('advertcategory','BannerCategoryController');
    Route::get('advertise-banner/category/destroy/{id}', 'BannerCategoryController@destroy')->name('advertcategory.destroy');

    Route::resource('feature-brands','FeatureBrandController');
    Route::get('/feature-brands/destroy/{id}', 'FeatureBrandController@destroy')->name('feature.brands.destroy');
    
    
    Route::resource('delivery-boy','DeliveryBoyController');
    Route::get('/delivery-boy', 'DeliveryBoyController@index')->name('deliveryboy.manage');
    Route::get('/delivery-boy/delete/{id}', 'DeliveryBoyController@delete')->name('deliveryboy.delete');
    Route::post('/deliveryboystatus', 'DeliveryBoyController@updatestatus')->name('deliveryboy.status');
    Route::get('/createdeliveryboy','DeliveryBoyController@create')->name('deliveryboy.create');
    Route::get('/editdeliveryboy/{id}','DeliveryBoyController@edit')->name('deliveryboy.edit');
    Route::post('/processdeliveryboy','DeliveryBoyController@store')->name('deliveryboy.add');
    Route::post('/updatedeliveryboy','DeliveryBoyController@update')->name('deliveryboy.update');
    
    /// geofence
    Route::resource('geofence','GeofenceController');
    Route::get('/geofencelist', 'GeofenceController@index')->name('geofence.manage');
    Route::get('/geofencedel/delete/{id}', 'GeofenceController@delete')->name('geofence.delete');
    Route::get('/creategeofence','GeofenceController@create')->name('geofence.create');
    Route::post('geofence-city', 'GeofenceController@getCities')->name('geofence.city');
    Route::post('geofence-district', 'GeofenceController@getDistricts')->name('geofence.district');
    
    
    

    Route::get('/products/admin','ProductController@admin_products')->name('products.admin');
    Route::get('/products/seller','ProductController@seller_products')->name('products.seller');
    Route::get('/products/create','ProductController@create')->name('products.create');
    Route::get('/products/admin/{id}/edit','ProductController@admin_product_edit')->name('products.admin.edit');
    Route::get('/products/seller/{id}/edit','ProductController@seller_product_edit')->name('products.seller.edit');
    Route::post('/products/todays_deal', 'ProductController@updateTodaysDeal')->name('products.todays_deal');
    Route::post('/products/get_products_by_subsubcategory', 'ProductController@get_products_by_subsubcategory')->name('products.get_products_by_subsubcategory');
    Route::post('/products/get_attribute_title', 'ProductController@get_attribute_title')->name('products.get_attribute_title');

    Route::resource('sellers','SellerController');
    Route::get('/sellers/destroy/{id}', 'SellerController@destroy')->name('sellers.destroy');
    Route::get('/sellers/view/{id}/verification', 'SellerController@show_verification_request')->name('sellers.show_verification_request');
    Route::get('/sellers/approve/{id}', 'SellerController@approve_seller')->name('sellers.approve');
    Route::get('/sellers/reject/{id}', 'SellerController@reject_seller')->name('sellers.reject');
    Route::post('/sellers/payment_modal', 'SellerController@payment_modal')->name('sellers.payment_modal');

    Route::get('/customers/enquiries', 'CustomerController@allenquiries')->name('customers.inquiry');
    Route::resource('customers','CustomerController');
    Route::get('/customers/destroy/{id}', 'CustomerController@destroy')->name('customers.destroy');

    Route::get('/newsletter', 'NewsletterController@index')->name('newsletters.index');
    Route::post('/newsletter/send', 'NewsletterController@send')->name('newsletters.send');

    Route::resource('profile','ProfileController');

    Route::post('/business-settings/update', 'BusinessSettingsController@update')->name('business_settings.update');
    Route::post('/business-settings/update/activation', 'BusinessSettingsController@updateActivationSettings')->name('business_settings.update.activation');
    Route::get('/activation', 'BusinessSettingsController@activation')->name('activation.index');
    Route::get('/payment-method', 'BusinessSettingsController@payment_method')->name('payment_method.index');
    Route::get('/social-login', 'BusinessSettingsController@social_login')->name('social_login.index');
    Route::get('/smtp-settings', 'BusinessSettingsController@smtp_settings')->name('smtp_settings.index');
    Route::get('/google-analytics', 'BusinessSettingsController@google_analytics')->name('google_analytics.index');
    Route::get('/facebook-chat', 'BusinessSettingsController@facebook_chat')->name('facebook_chat.index');
    Route::post('/env_key_update', 'BusinessSettingsController@env_key_update')->name('env_key_update.update');
    Route::post('/payment_method_update', 'BusinessSettingsController@payment_method_update')->name('payment_method.update');
    Route::post('/google_analytics', 'BusinessSettingsController@google_analytics_update')->name('google_analytics.update');
    Route::post('/facebook_chat', 'BusinessSettingsController@facebook_chat_update')->name('facebook_chat.update');
    Route::get('/currency', 'CurrencyController@currency')->name('currency.index');
    Route::post('/currency/update', 'CurrencyController@updateCurrency')->name('currency.update');
    Route::post('/your-currency/update', 'CurrencyController@updateYourCurrency')->name('your_currency.update');
    Route::get('/verification/form', 'BusinessSettingsController@seller_verification_form')->name('seller_verification_form.index');
    Route::post('/verification/form', 'BusinessSettingsController@seller_verification_form_update')->name('seller_verification_form.update');
    Route::get('/vendor_commission', 'BusinessSettingsController@vendor_commission')->name('business_settings.vendor_commission');
    Route::post('/vendor_commission_update', 'BusinessSettingsController@vendor_commission_update')->name('business_settings.vendor_commission.update');

    // ---Sms setting
    Route::get('/sms-setting', 'BusinessSettingsController@sms_setting')->name('sms.index');
    Route::post('/sms-setting', 'BusinessSettingsController@sms_setting_update')->name('sms_setting.update');

    Route::resource('/languages', 'LanguageController');
    Route::post('/languages/update_rtl_status', 'LanguageController@update_rtl_status')->name('languages.update_rtl_status');
    Route::get('/languages/destroy/{id}', 'LanguageController@destroy')->name('languages.destroy');
    Route::get('/languages/{id}/edit', 'LanguageController@edit')->name('languages.edit');
    Route::post('/languages/{id}/update', 'LanguageController@update')->name('languages.update');
    Route::post('/languages/key_value_store', 'LanguageController@key_value_store')->name('languages.key_value_store');

    Route::get('/frontend_settings/home', 'HomeController@home_settings')->name('home_settings.index');
    Route::get('/sellerpolicy/{type}', 'PolicyController@index')->name('sellerpolicy.index');
    Route::get('/returnpolicy/{type}', 'PolicyController@index')->name('returnpolicy.index');
    Route::get('/supportpolicy/{type}', 'PolicyController@index')->name('supportpolicy.index');
    Route::get('/terms/{type}', 'PolicyController@index')->name('terms.index');
    Route::get('/privacypolicy/{type}', 'PolicyController@index')->name('privacypolicy.index');

    Route::resource('cms','PolicyController');
    Route::get('/cms/destroy/{id}', 'PolicyController@destroy')->name('cms.destroy');


    //Policy Controller
    Route::post('/policies/store', 'PolicyController@store')->name('policies.store');

    Route::group(['prefix' => 'frontend_settings'], function(){
        Route::resource('sliders','SliderController');
        Route::get('/sliders/destroy/{id}', 'SliderController@destroy')->name('sliders.destroy');

        Route::resource('home_banners','BannerController');
        Route::get('/home_banners/destroy/{id}', 'BannerController@destroy')->name('home_banners.destroy');

        Route::resource('home_categories','HomeCategoryController');
        Route::get('/home_categories/destroy/{id}', 'HomeCategoryController@destroy')->name('home_categories.destroy');
        Route::post('/home_categories/update_status', 'HomeCategoryController@update_status')->name('home_categories.update_status');
        Route::post('/home_categories/get_subsubcategories_by_category', 'HomeCategoryController@getSubSubCategories')->name('home_categories.get_subsubcategories_by_category');
        Route::post('/home_categories/get_productsubsubcategories_by_category', 'HomeCategoryController@getProductSubSubCategories')->name('home_categories.get_productsubsubcategories_by_category');
    });

    Route::resource('roles','RoleController');
    Route::get('/roles/destroy/{id}', 'RoleController@destroy')->name('roles.destroy');

    Route::resource('staffs','StaffController');
    Route::get('/staffs/destroy/{id}', 'StaffController@destroy')->name('staffs.destroy');

    Route::resource('colors','ColorController');
    Route::resource('flash_deals','FlashDealController');
    Route::get('/flash_deals/destroy/{id}', 'FlashDealController@destroy')->name('flash_deals.destroy');
    Route::post('/flash_deals/update_status', 'FlashDealController@update_status')->name('flash_deals.update_status');
    Route::post('/flash_deals/product_discount', 'FlashDealController@product_discount')->name('flash_deals.product_discount');
    Route::post('/flash_deals/product_discount_edit', 'FlashDealController@product_discount_edit')->name('flash_deals.product_discount_edit');

    Route::get('/orders', 'OrderController@admin_orders')->name('orders.index.admin');
    Route::get('/orders/{id}/show', 'OrderController@show')->name('orders.show');
    Route::get('/sales/{id}/show', 'OrderController@sales_show')->name('sales.show');
    Route::get('/customer/{id}/orders', 'OrderController@customerorders')->name('customer.orders');
    Route::get('/orders/destroy/{id}', 'OrderController@destroy')->name('orders.destroy');
    Route::get('/sales', 'OrderController@sales')->name('sales.index');
    
     // delivery boy
    Route::post('/processassigndelivery','OrderController@assigndeliveryboy')->name('orders.deliveryboy');

    Route::resource('links','LinkController');
    Route::get('/links/destroy/{id}', 'LinkController@destroy')->name('links.destroy');

    Route::resource('generalsettings','GeneralSettingController');
    Route::get('/logo','GeneralSettingController@logo')->name('generalsettings.logo');
    Route::post('/logo','GeneralSettingController@storeLogo')->name('generalsettings.logo.store');
    Route::get('/color','GeneralSettingController@color')->name('generalsettings.color');
    Route::post('/color','GeneralSettingController@storeColor')->name('generalsettings.color.store');
    Route::get('/invoice','GeneralSettingController@invoice')->name('generalsettings.invoice');
    Route::post('/invoice','GeneralSettingController@storeInvoice')->name('generalsettings.invoice.store');

    Route::resource('seosetting','SEOController');
    Route::resource('taxsetting','TaxController');

    Route::post('/pay_to_seller', 'CommissionController@pay_to_seller')->name('commissions.pay_to_seller');

    //Reports
    Route::get('/stock_report', 'ReportController@stock_report')->name('stock_report.index');
    
    Route::get('/report_sales', 'ReportController@report_sales')->name('report.report_sales');
    Route::get('/report_whosonline', 'ReportController@report_whosonline')->name('report.report_whosonline');
    Route::get('/report_statistics', 'ReportController@report_statistics')->name('report.report_statistics');
    Route::get('/report_products_viewed', 'ReportController@report_products_viewed')->name('report.report_products_viewed');
    Route::get('/report_returns', 'ReportController@report_returns')->name('report.report_returns');
    Route::get('/report_product_purchase', 'ReportController@report_product_purchase')->name('report.report_product_purchase');
    Route::get('/report_customer_order', 'ReportController@report_customer_order')->name('report.report_customer_order');
    Route::get('/report_coupon', 'ReportController@report_coupon')->name('report.report_coupon');

    Route::get('/in_house_sale_report', 'ReportController@in_house_sale_report')->name('in_house_sale_report.index');
    Route::get('/seller_report', 'ReportController@seller_report')->name('seller_report.index');
    Route::get('/seller_sale_report', 'ReportController@seller_sale_report')->name('seller_sale_report.index');
    Route::get('/wish_report', 'ReportController@wish_report')->name('wish_report.index');
    Route::get('/order_wise_report', 'ReportController@order_wise_report')->name('order_wise_report.index');
    Route::get('/product_wise_report', 'ReportController@product_wise_report')->name('product_wise_report.index');


    //custom rout for brand Enable or disable
    Route::get('/enable-brand/{id}', 'BrandController@enableBrand')->name('brands.enable');

    //custom rout for Category Enable or disable
    Route::get('/enable-category/{id}', 'CategoryController@enableCategory')->name('category.enable');

    //custom rout for feature brand Enable or disable
    Route::get('/enable-feature-brand/{id}', 'FeatureBrandController@enableFeatureBrand')->name('feature.brand.enable');

    Route::get('/delivery','DeliveryController@index')->name('delivery_managment');
    Route::get('/delivery/create','DeliveryController@create')->name('delivery_create');
    Route::post('/delivery/store','DeliveryController@store')->name('delivery_store');
    Route::get('/delivery/{id}/edit','DeliveryController@edit')->name('delivery_edit');
    Route::get('/get_cities','DeliveryController@get_cities')->name('get_cities');
    
    Route::get('/aramex-setting', 'BusinessSettingsController@aramex_setting')->name('aramex.index');
    Route::post('/aramex-setting', 'BusinessSettingsController@aramex_setting_update')->name('aramex_setting.update');
    
	Route::get('/products/import','ProductController@import')->name('products.import');
    Route::any('/products/importproduct','ProductController@importproduct')->name('products.importproduct');
    
    Route::get('/export_products','ProductController@export_products')->name('export_products');
});

