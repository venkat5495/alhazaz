@extends('frontend.layouts.app')
@section('content')
    @php
    if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
    {
        $current_language="arabic";
        $page_title = "متجر";
    } else {
        $current_language="english";
        $page_title = "Shop";
    }
    $brands = array();
    @endphp
<style type="text/css">
    .product-loader {
        color: #333;
        content: "";
        padding: 15px;
        background: #fff;
        z-index: 9999;
        display: inline-block;
        width: 100%;
        text-align: center;
    }
    .product-loader i {
        font-size: 30px;
    }
</style>

<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title"><?= $page_title ?></h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                    <li><a href="{{ route('products') }}">{{__('Shop')}}</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Wrapper Start -->
<div class="main-content-wrapper">
    <div class="shop-area pt--40 pb--80 pt-md--30 pb-md--60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <!-- Shop Toolbar Start -->
                            <div class="shop-toolbar">
                                <div class="product-view-mode" data-default="list">
                                   
                                </div>
                                <!--<span class="product-pages"><p>Showing  {{($products->currentpage()-1)*$products->perpage()+1}} - {{$products->currentpage()*$products->perpage()}} of  {{$products->total()}} results</p></span>-->
                                <form id="search-form" method="get">
                                        <input type="hidden" name="q" value="{{ isset($query) ? $query : '' }}">
                                        <div class="product-short">
                                            <label class="select-label">Sort By:</label>
                                            <select name="orderby" onchange="filter()" id="sort" class="form-control" style="font-size: 14px;height: 40px;width: 150px;">
                                                <option disabled="">{{__('Sort By')}}</option>
                                                <option value="1" {{isset ($_GET['orderby']) && $_GET['orderby'] == 1 ? 'selected' : '' }}>Newness</option>
                                                <option value="2" {{isset ($_GET['orderby']) && $_GET['orderby'] == 2 ? 'selected' : '' }}>Oldest</option>
                                                <option value="3" {{isset ($_GET['orderby']) && $_GET['orderby'] == 3 ? 'selected' : '' }}>Price: low to high</option>
                                                <option value="4" {{isset ($_GET['orderby']) && $_GET['orderby'] == 4 ? 'selected' : '' }}>Price: high to low</option>
                                            </select>
                                        </div>
                                    </form>
                            </div>
                            <!-- Shop Toolbar End -->
                        </div>
                    </div>
    
                    <div class="col-xl-12">
                        @if(count($products) > 0)
                        <div id="js_produc_list_div">
                            <div class="shop-product-wrap row no-gutters grid gridview-5">
                               @include('frontend.partials.product_list')
                            </div>
                        </div>
                        <div class="row">
                            <div class="product-loader" style="display: none;"><i class="fa fa-spin fa-spinner"></i></div>
                        </div>
                        @else
                            <div class="products-box-bar p-3 bg-white"><p>{{__('No items found.')}}</p></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function filter() {
        $('#search-form').submit();
    }
    var processing;
    function load_products() {
        if($('#js_produc_list_div > .row').find('a').hasClass('next_page_url')){
            $('.product-loader').show();
            append_in = $('#js_produc_list_div').find('.row');
            next_page_link = $('#js_produc_list_div').find('.next_page_url');
            next_url = next_page_link.attr('href');
            next_page_link.remove();
            $.get(next_url, function(data){
                html = $.parseHTML(data);
                $.each(html, function( index, value ) {
                    append_in.append(value);   
                });
                processing = false;
                $('.product-loader').hide();
            });
        }
    }
    $("body").on('click','.next_page_url',function(e){
        e.preventDefault();
        load_products();
    })
</script>
@endsection