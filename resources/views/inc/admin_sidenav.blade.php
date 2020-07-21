<nav id="mainnav-container">
    <div id="mainnav">
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">
                    <div id="mainnav-shortcut" class="hidden">
                        <ul class="list-unstyled shortcut-wrap">
                            <li class="col-xs-3" data-content="My Profile">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-mint">
                                    <i class="demo-pli-male"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Messages">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-warning">
                                    <i class="demo-pli-speech-bubble-3"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Activity">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-success">
                                    <i class="demo-pli-thunder"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Lock Screen">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
                                    <i class="demo-pli-lock-2"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--================================-->
                    <!--End shortcut buttons-->


                    <ul id="mainnav-menu" class="list-group">

                        <!--Category name-->
                        {{-- <li class="list-header">Navigation</li> --}}

                        <!--Menu list item-->
                        <li class="{{ areActiveRoutes(['admin.dashboard'])}}">
                            <a class="nav-link" href="{{route('admin.dashboard')}}">
                                <i class="fa fa-home"></i>
                                <span class="menu-title">{{__('Dashboard')}}</span>
                            </a>
                        </li>

                        <!-- Product Menu -->
                        @if(Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions)))
                            <li>
                                <a href="#">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="menu-title">{{__('Products')}}</span>
                                    <i class="arrow right"></i>
                                </a>

                                <!--Submenu-->
                                <ul class="collapse">
                                    <li class="{{ areActiveRoutes(['brands.index', 'brands.create', 'brands.edit'])}}">
                                        <a class="nav-link" href="{{route('brands.index')}}"><i class="fa fa-angle-double-right"></i> {{__('Brand')}}</a>
                                    </li>
                                    <!--<li class="{{ areActiveRoutes(['feature-brands.index', 'feature-brands.create', 'feature-brands.edit'])}}">
                                        <a class="nav-link" href="{{route('feature-brands.index')}}"><i class="fa fa-angle-double-right"></i> {{__('Feature Brand')}}</a>
                                    </li>-->
                                    <li class="{{ areActiveRoutes(['categories.index', 'categories.create', 'categories.edit'])}}">
                                        <a class="nav-link" href="{{route('categories.index')}}"><i class="fa fa-angle-double-right"></i> {{__('Category')}}</a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['subcategories.index', 'subcategories.create', 'subcategories.edit'])}}">
                                        <a class="nav-link" href="{{route('subcategories.index')}}"><i class="fa fa-angle-double-right"></i> {{__('Subcategory')}}</a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['subsubcategories.index', 'subsubcategories.create', 'subsubcategories.edit'])}}">
                                        <a class="nav-link" href="{{route('subsubcategories.index')}}"><i class="fa fa-angle-double-right"></i> {{__('Sub Subcategory')}}</a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['products.admin', 'products.create', 'products.admin.edit'])}}">
                                        <a class="nav-link" href="{{route('products.admin')}}"><i class="fa fa-angle-double-right"></i> {{__('Products')}}</a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['coupons.index', 'coupons.create', 'coupons.edit'])}}">
                                        <a class="nav-link" href="{{route('coupons.index')}}"><i class="fa fa-angle-double-right"></i> {{__('Coupons')}}</a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['media.index'])}}">
                                        <a class="nav-link" href="{{route('media.index')}}"><i class="fa fa-angle-double-right"></i> {{__('Media')}}</a>
                                    </li>

                                    @if(\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                        <li class="{{ areActiveRoutes(['products.seller', 'products.seller.edit'])}}">
                                            <a class="nav-link" href="{{route('products.seller')}}"><i class="fa fa-angle-double-right"></i> {{__('Seller Products')}}</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif

                        @if(Auth::user()->user_type == 'admin' || in_array('2', json_decode(Auth::user()->staff->role->permissions)))

                        <li>
                            <a href="#"> <i class="fa fa-object-group"></i><span class="menu-title">{{__('Products Setting')}}</span><i class="arrow right"></i> </a>
                            <ul class="collapse">
                                <li class="{{ areActiveRoutes(['productgroup.index', 'productgroup.create', 'productgroup.edit'])}}">
                                    <a class="nav-link" href="{{ route('productgroup.index') }}">
                                        <i class="fa fa-angle-double-right"></i>
                                        <span class="menu-title">{{__('Product Group')}}</span>
                                    </a>
                                </li>
                                
                                <li class="{{ areActiveRoutes(['productgroup.productdiscount'])}}">
                                    <a class="nav-link" href="{{ route('productgroup.productdiscount') }}">
                                        <i class="fa fa-angle-double-right"></i>
                                        <span class="menu-title">{{__('Products Discount')}}</span>
                                    </a>
                                </li>

                                <li class="{{ areActiveRoutes(['productgroup.productreport'])}}">
                                    <a class="nav-link" href="{{ route('productgroup.productreport') }}">
                                        <i class="fa fa-angle-double-right"></i>
                                        <span class="menu-title">{{__('Products Report')}}</span>
                                    </a>
                                </li>
                                
                                <li class="{{ areActiveRoutes(['productgroup.bulkupload'])}}">
                                    <a class="nav-link" href="{{ route('productgroup.bulkupload') }}">
                                        <i class="fa fa-angle-double-right"></i>
                                        <span class="menu-title">{{__('Bulk Product')}}</span>
                                    </a>
                                </li>


                            </ul>
                        </li>
                        



                        @if(Auth::user()->user_type == 'admin' || in_array('10', json_decode(Auth::user()->staff->role->permissions)))
                            <li>
                                <a href="#">
                                    <i class="fa fa-flag"></i><span class="menu-title">{{__('Section Setting')}}</span><i class="arrow right"></i>
                                </a>
                                <ul class="collapse">
                                    <li class="<?= (isset($_GET['id']) && $_GET['id'] == 1)?"active-link":"" ?>">
                                        <a class="nav-link" href="{{route('dynamicbanner.index', 'id=1')}}">
                                            <i class="fa fa-angle-double-right"></i>
                                            <span class="menu-title">{{__('Banner')}}</span>
                                        </a>
                                    </li>

                                    <li class="<?= (isset($_GET['id']) && $_GET['id'] == 2)?"active-link":"" ?>">
                                        <a class="nav-link" href="{{ route('dynamicbanner.index', 'id=2') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            <span class="menu-title">{{__('Section A')}}</span>
                                        </a>
                                    </li>

                                    <li class="<?= (isset($_GET['id']) && $_GET['id'] == 3)?"active-link":"" ?>">
                                        <a class="nav-link" href="{{ route('dynamicbanner.index', 'id=3') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            <span class="menu-title">{{__('Collection Section')}}</span>
                                        </a>
                                    </li>

                                    <li class="{{ areActiveRoutes(['products.newarrival', 'products.createnewarrival'])}}">
                                        <a class="nav-link" href="{{ route('products.newarrival') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            <span class="menu-title">{{__('New Arrival')}}</span>
                                        </a>
                                    </li>

                                    <li class="{{ areActiveRoutes(['flash_deals.index', 'flash_deals.create', 'flash_deals.edit'])}}">
                                        <a class="nav-link" href="{{ route('flash_deals.index') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            <span class="menu-title">{{__('Flash Deal')}}</span>
                                        </a>
                                    </li>
                                    
                                    <li class="<?= (isset($_GET['id']) && $_GET['id'] == 8)?"active-link":"" ?>">
                                        <a class="nav-link" href="{{ route('dynamicbanner.index', 'id=8') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            <span class="menu-title">{{__('Section B')}}</span>
                                        </a>
                                    </li>

                                    <li class="<?= (isset($_GET['id']) && $_GET['id'] == 9)?"active-link":"" ?>">
                                        <a class="nav-link" href="{{ route('dynamicbanner.index', 'id=9') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            <span class="menu-title">{{__('Section C')}}</span>
                                        </a>
                                    </li>

                                    <li class="<?= (isset($_GET['id']) && $_GET['id'] == 6)?"active-link":"" ?>">
                                        <a class="nav-link" href="{{ route('dynamicbanner.index', 'id=6') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            <span class="menu-title">{{__('Feature Product ')}}</span>
                                        </a>
                                    </li>

                                    <li class="<?= (isset($_GET['id']) && $_GET['id'] == 7)?"active-link":"" ?>">
                                        <a class="nav-link" href="{{ route('dynamicbanner.index', 'id=7') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            <span class="menu-title">{{__('Most View')}}</span>
                                        </a>
                                    </li>

                                    <li class="{{ areActiveRoutes(['feature-brands.index', 'feature-brands.create', 'feature-brands.edit'])}}">
                                        <a class="nav-link" href="{{route('feature-brands.index')}}">
                                            <i class="fa fa-angle-double-right"></i> 
                                            <span class="menu-title">{{__('Popular Brands')}}</span>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        @endif


                        <li class="{{ areActiveRoutes(['specifications.index', 'specifications.create', 'specifications.edit'])}}">
                            <a class="nav-link" href="{{ route('specifications.index') }}">
                                <i class="fa fa-list"></i>
                                <span class="menu-title">{{__('Product Specification')}}</span>
                            </a>
                        </li>

                        @endif
                        
                         @if(Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions)))
							 
						  <li class="{{ areActiveRoutes(['geofence.manage','geofence.create'])}}">
                            <a class="nav-link" href="{{ route('geofence.manage') }}">
                                <i class="fa fa-bookmark-o fa-fw"></i>
                                <span class="menu-title"> {{__('Geofence')}}</span>
                            </a>
                        </li>
						 
						 
						 @endif
						
                        
                         @if(Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions)))
							 
						  <li class="{{ areActiveRoutes(['deliveryboy.manage','deliveryboy.create','deliveryboy.edit'])}}">
                            <a class="nav-link" href="{{ route('deliveryboy.manage') }}">
                                <i class="fa fa-male"></i>
                                <span class="menu-title"> {{__('Manage Delivery Boy')}}</span>
                            </a>
                        </li>
						 
						 
						 @endif

                        @if(Auth::user()->user_type == 'admin' || in_array('3', json_decode(Auth::user()->staff->role->permissions)))
                            @php
                                $orders = DB::table('orders')
                                            ->orderBy('code', 'desc')
                                            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                                            ->where('orders.viewed', 0)
                                            ->select('orders.id')
                                            ->distinct()
                                            ->count();
                            @endphp
                        <li class="{{ areActiveRoutes(['orders.index.admin','orders.show'])}}">
                            <a class="nav-link" href="{{ route('orders.index.admin') }}">
                                <i class="fa fa-shopping-basket"></i>
                                <span class="menu-title">{{__('Orders')}} @if($orders > 0)<span class="pull-right badge badge-info">{{ $orders }}</span>@endif</span>
                            </a>
                        </li>
                        @endif

                        @if(Auth::user()->user_type == 'admin' || in_array('4', json_decode(Auth::user()->staff->role->permissions)))
                        <li class="{{ areActiveRoutes(['sales.index', 'sales.show'])}}">
                            <a class="nav-link" href="{{ route('sales.index') }}">
                                <i class="fa fa-money"></i>
                                <span class="menu-title">{{__('Total sales')}}</span>
                            </a>
                        </li>
                        @endif

                        @if((Auth::user()->user_type == 'admin' || in_array('5', json_decode(Auth::user()->staff->role->permissions))) && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                        <li>
                            <a href="#">
                                <i class="fa fa-user-plus"></i>
                                <span class="menu-title">{{__('Sellers')}}</span>
                                <i class="arrow right"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="{{ areActiveRoutes(['sellers.index', 'sellers.create', 'sellers.edit'])}}">
                                    @php
                                        $sellers = \App\Seller::where('verification_status', 0)->where('verification_info', '!=', null)->count();
                                    @endphp
                                    <a class="nav-link" href="{{route('sellers.index')}}">{{__('Seller list')}} @if($sellers > 0)<span class="pull-right badge badge-info">{{ $sellers }}</span> @endif</a>
                                </li>
                                <li class="{{ areActiveRoutes(['seller_verification_form.index'])}}">
                                    <a class="nav-link" href="{{route('seller_verification_form.index')}}">{{__('Seller verification form')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['business_settings.vendor_commission'])}}">
                                    <a class="nav-link" href="{{ route('business_settings.vendor_commission') }}">{{__('Seller Commission')}}</a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if(Auth::user()->user_type == 'admin' || in_array('6', json_decode(Auth::user()->staff->role->permissions)))
                        <li>
                            <a href="#">
                                <i class="fa fa-user-plus"></i>
                                <span class="menu-title">{{__('Customers')}}</span>
                                <i class="arrow right"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="{{ areActiveRoutes(['customers.index'])}}">
                                    <a class="nav-link" href="{{ route('customers.index') }}"><i class="fa fa-angle-double-right"></i> {{__('Customer list')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['customers.inquiry'])}}">
                                    <a class="nav-link" href="{{ route('customers.inquiry') }}"><i class="fa fa-angle-double-right"></i> {{__('Customers Enquiries')}}</a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        <li>
                            <a href="#">
                                <i class="fa fa-file"></i>
                                <span class="menu-title">{{__('Reports')}}</span>
                                <i class="arrow right"></i>
                            </a>
                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="{{ areActiveRoutes(['stock_report.index'])}}">
                                    <a class="nav-link" href="{{ route('stock_report.index') }}"><i class="fa fa-angle-double-right"></i> {{__('Stock Report')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['in_house_sale_report.index'])}}">
                                    <a class="nav-link" href="{{ route('in_house_sale_report.index') }}"><i class="fa fa-angle-double-right"></i> {{__('Sale Report')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['order_wise_report.index'])}}">
                                    <a class="nav-link" href="{{ route('order_wise_report.index') }}"><i class="fa fa-angle-double-right"></i> {{__('Order Wise Report')}}</a>
                                </li>
                                <li class="{{areActiveRoutes(['report.report_whosonline'])}}">
                                    <a class="nav-link" href="{{route('report.report_whosonline')}}"><i class="fa fa-angle-double-right"></i> {{__("Who's Online")}}</a>
                                </li>
                                <li class="{{areActiveRoutes(['report.report_statistics'])}}">
                                    <a class="nav-link" href="{{route('report.report_statistics')}}"><i class="fa fa-angle-double-right"></i> {{__('Statistics')}}</a>
                                </li>
                            </ul>
                        </li>

                        @if(Auth::user()->user_type == 'admin' || in_array('7', json_decode(Auth::user()->staff->role->permissions)))
                        <li>
                            <a href="#">
                                <i class="fa fa-envelope"></i>
                                <span class="menu-title">{{__('Messaging')}}</span>
                                <i class="arrow right"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="{{ areActiveRoutes(['newsletters.index'])}}">
                                    <a class="nav-link" href="{{route('newsletters.index')}}"><i class="fa fa-angle-double-right"></i> {{__('Newsletters')}}</a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if(Auth::user()->user_type == 'admin' || in_array('8', json_decode(Auth::user()->staff->role->permissions)))
                        <li>
                            <a href="#">
                                <i class="fa fa-briefcase"></i>
                                <span class="menu-title">{{__('Business Settings')}}</span>
                                <i class="arrow right"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="{{ areActiveRoutes(['activation.index'])}}">
                                    <a class="nav-link" href="{{route('activation.index')}}"><i class="fa fa-angle-double-right"></i> {{__('Activation')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['payment_method.index'])}}">
                                    <a class="nav-link" href="{{ route('payment_method.index') }}"><i class="fa fa-angle-double-right"></i> {{__('Payment method')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['smtp_settings.index'])}}">
                                    <a class="nav-link" href="{{ route('smtp_settings.index') }}"><i class="fa fa-angle-double-right"></i> {{__('SMTP Settings')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['google_analytics.index'])}}">
                                    <a class="nav-link" href="{{ route('google_analytics.index') }}"><i class="fa fa-angle-double-right"></i> {{__('Google Analytics')}}</a>
                                </li>
                                <!-- <li class="{{ areActiveRoutes(['facebook_chat.index'])}}">
                                    <a class="nav-link" href="{{ route('facebook_chat.index') }}"><i class="fa fa-angle-double-right"></i> {{__('Facebook Chat')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['social_login.index'])}}">
                                    <a class="nav-link" href="{{ route('social_login.index') }}"><i class="fa fa-angle-double-right"></i> {{__('Social Media Login')}}</a>
                                </li> -->
                                <li class="{{ areActiveRoutes(['currency.index'])}}">
                                    <a class="nav-link" href="{{route('currency.index')}}"><i class="fa fa-angle-double-right"></i> {{__('Currency')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['languages.index', 'languages.create', 'languages.store', 'languages.show', 'languages.edit'])}}">
                                    <a class="nav-link" href="{{route('languages.index')}}"><i class="fa fa-angle-double-right"></i> {{__('Languages')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['sms.index'])}}">
                                    <a class="nav-link" href="{{route('sms.index')}}"><i class="fa fa-angle-double-right"></i> {{__('SMS Setting')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['aramex.index'])}}">
                                    <a class="nav-link" href="{{route('aramex.index')}}"><i class="fa fa-angle-double-right"></i> {{__('Aramex Setting')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['generalsettings.invoice']) }}">
                                    <a class="nav-link" href="{{ route('generalsettings.invoice') }}"><i class="fa fa-angle-double-right"></i> {{__('Invoice Settings')}} </a>
                                </li>

                            </ul>
                        </li>
                        @endif

                        @if(Auth::user()->user_type == 'admin' || in_array('9', json_decode(Auth::user()->staff->role->permissions)))
                        <li>
                            <a href="#">
                                <i class="fa fa-desktop"></i>
                                <span class="menu-title">{{__('Frontend Settings')}}</span>
                                <i class="arrow right"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <!-- <li class="{{ areActiveRoutes(['home_settings.index', 'home_banners.index', 'sliders.index', 'home_categories.index', 'home_banners.create', 'home_categories.create', 'home_categories.edit', 'sliders.create'])}}">
                                    <a class="nav-link" href="{{route('home_settings.index')}}"><i class="fa fa-angle-double-right"></i> {{__('Home')}}</a>
                                </li> -->
                                <?php /*
                                <li>
                                    <a href="#">
                                        <span class="menu-title">{{__('Policy Pages')}}</span>
                                        <i class="arrow right"></i>
                                    </a>

                                    <!--Submenu-->
                                    <ul class="collapse">

                                        <li class="{{ areActiveRoutes(['sellerpolicy.index'])}}">
                                            <a class="nav-link" href="{{route('sellerpolicy.index', 'seller_policy')}}">{{__('Seller Policy')}}</a>
                                        </li>
                                        <li class="{{ areActiveRoutes(['returnpolicy.index'])}}">
                                            <a class="nav-link" href="{{route('returnpolicy.index', 'return_policy')}}">{{__('Return Policy')}}</a>
                                        </li>
                                        <li class="{{ areActiveRoutes(['supportpolicy.index'])}}">
                                            <a class="nav-link" href="{{route('supportpolicy.index', 'support_policy')}}">{{__('Support Policy')}}</a>
                                        </li>
                                        <li class="{{ areActiveRoutes(['terms.index'])}}">
                                            <a class="nav-link" href="{{route('terms.index', 'terms')}}">{{__('Terms & Conditions')}}</a>
                                        </li>
                                        <li class="{{ areActiveRoutes(['privacypolicy.index'])}}">
                                            <a class="nav-link" href="{{route('privacypolicy.index', 'privacy_policy')}}">{{__('Privacy Policy')}}</a>
                                        </li>
                                    </ul>

                                </li> */ ?>
                                <li class="{{ areActiveRoutes(['cms.index', 'cms.create', 'cms.edit'])}}">
                                    <a class="nav-link" href="{{route('cms.index')}}"><i class="fa fa-angle-double-right"></i> {{__('CMS Setting')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['links.index', 'links.create', 'links.edit'])}}">
                                    <a class="nav-link" href="{{route('links.index')}}"><i class="fa fa-angle-double-right"></i> {{__('Useful Link')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['generalsettings.index'])}}">
                                    <a class="nav-link" href="{{route('generalsettings.index')}}"><i class="fa fa-angle-double-right"></i> {{__('General Settings')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['generalsettings.logo'])}}">
                                    <a class="nav-link" href="{{route('generalsettings.logo')}}"><i class="fa fa-angle-double-right"></i> {{__('Logo Settings')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['generalsettings.color'])}}">
                                    <a class="nav-link" href="{{route('generalsettings.color')}}"><i class="fa fa-angle-double-right"></i> {{__('Color Settings')}}</a>
                                </li>
                            </ul>
                        </li>

                        @endif

                        @if(Auth::user()->user_type == 'admin' || in_array('11', json_decode(Auth::user()->staff->role->permissions)))
                        <li class="{{ areActiveRoutes(['seosetting.index'])}}">
                            <a class="nav-link" href="{{ route('seosetting.index') }}">
                                <i class="fa fa-search"></i>
                                <span class="menu-title">{{__('SEO Setting')}}</span>
                            </a>
                        </li>
                        <li class="{{ areActiveRoutes(['colors.index', 'colors.create', 'colors.edit']) }}">
                            <a class="nav-link" href="{{ route('colors.index') }}">
                                <i class="fa fa-codiepie"></i>
                                <span class="menu-title">{{__('Color')}}</span>
                            </a>
                        </li>
                        <li class="{{ areActiveRoutes(['delivery_managment', 'delivery_create', 'delivery_edit']) }}">
                            <a class="nav-link" href="{{ route('delivery_managment') }}">
                                <i class="fa fa-codiepie"></i>
                                <span class="menu-title">{{__('Delivery Management')}}</span>
                            </a>
                        </li>
                        @endif

                        @if(Auth::user()->user_type == 'admin' || in_array('11', json_decode(Auth::user()->staff->role->permissions)))
                            <li class="{{ areActiveRoutes(['taxsetting.index'])}}">
                                <a class="nav-link" href="{{ route('taxsetting.index') }}">
                                    <i class="fa fa-search"></i>
                                    <span class="menu-title">{{__('Tax Setting')}}</span>
                                </a>
                            </li>
                        @endif

                        @if(Auth::user()->user_type == 'admin' || in_array('10', json_decode(Auth::user()->staff->role->permissions)))
                            <li class="{{ areActiveRoutes(['offer.index', 'offer.create', 'offer.edit'])}}">
                                <a class="nav-link" href="{{ route('offer.index') }}">
                                    <i class="fa fa-gift"></i>
                                    <span class="menu-title">{{__('Offer')}}</span>
                                </a>
                            </li>
                        @endif

                        @if(Auth::user()->user_type == 'admin' || in_array('10', json_decode(Auth::user()->staff->role->permissions)))
                        <li>
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span class="menu-title">{{__('Staffs')}}</span>
                                <i class="arrow right"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="{{ areActiveRoutes(['staffs.index', 'staffs.create', 'staffs.edit'])}}">
                                    <a class="nav-link" href="{{ route('staffs.index') }}"><i class="fa fa-angle-double-right"></i> {{__('All staffs')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['roles.index', 'roles.create', 'roles.edit'])}}">
                                    <a class="nav-link" href="{{route('roles.index')}}"><i class="fa fa-angle-double-right"></i> {{__('Staff permissions')}}</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                    
                    <div id="stats">
                        <ul>
                            <li>
                                <div>Orders Completed <span class="pull-right">0%</span></div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"> <span class="sr-only">0%</span></div>
                                </div>
                            </li>
                            <li>
                                <div>Orders Processing <span class="pull-right">0%</span></div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"> <span class="sr-only">0%</span></div>
                                </div>
                            </li>
                            <li>
                                <div>Other Statuses <span class="pull-right">0%</span></div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"> <span class="sr-only">0%</span></div>
                                </div>
                            </li>
                        </ul>
                    </div>
<style>
#stats {
    border-radius: 2px;
    color: #808b9c;
    background: #2e3a47;
    margin: 15px 20px;
    padding: 5px 0;
}
#stats ul, #stats li {
    padding: 0;
    margin: 0;
    list-style: none;
}
#stats li {
    font-size: 11px;
    color: #9d9d9d;
    padding: 5px 10px;
    border-bottom: 1px dotted #373737;
}
#stats div:first-child {
    margin-bottom: 4px;
}
#stats .progress {
    height: 3px;
    margin-bottom: 0;
}
#stats div:first-child {
    margin-bottom: 4px;
}
</style>


                </div>
            </div>
        </div>
        <!--================================-->
        <!--End menu-->

    </div>
</nav>
