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
    @endphp
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title"><?= $page_title ?></h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="#">Home</a></li>
                    <li class="current"><a href="#">Shop List</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb area End -->

<!-- Main Content Wrapper Start -->
<div class="main-content-wrapper">
    <div class="shop-area pt--40 pb--80 pt-md--30 pb-md--60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="shop-toolbar">
                        <div class="product-view-mode" data-default="list">
                            <a class="grid-2" data-target="gridview-2" data-toggle="tooltip" data-placement="top" title="2"></a>
                            <a class="grid-3" data-target="gridview-3" data-toggle="tooltip" data-placement="top" title="3"></a>
                            <a class="grid-4" data-target="gridview-4" data-toggle="tooltip" data-placement="top" title="4"></a>
                            <a class="grid-5 active" data-target="gridview-5" data-toggle="tooltip" data-placement="top" title="5"></a>
                        </div>

                        <form id="search-form" action="{{ route('productsgroup', $query) }}">
                            <input type="hidden" name="q" value="{{ isset($query) ? $query : '' }}">
                            <div class="product-short">
                                <label class="select-label">Sort By:</label>
                                <select name="orderby" id="sort" class="form-control" style="font-size: 14px;height: 40px;width: 150px;">
                                    <option disabled="">{{__('Sort By')}}</option>
                                    <option value="1" {{isset ($sort_by) && $sort_by ==1 ? 'selected' : '' }}>Newness</option>
                                    <option value="2" {{isset ($sort_by) && $sort_by ==2 ? 'selected' : '' }}>Oldest</option>
                                    <option value="3" {{isset ($sort_by) && $sort_by ==3 ? 'selected' : '' }}>Price: low to high</option>
                                    <option value="4" {{isset ($sort_by) && $sort_by ==4 ? 'selected' : '' }}>Price: high to low</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    @if(count($products) > 0)
                    <div class="shop-product-wrap row no-gutters grid gridview-5">
                        @foreach ($products as $product)
                            @if(!empty($product))
                                @php $brand = (\App\Brand::whereid($product->brand_id)->first()); @endphp
                                <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                                    @include('frontend.single_product')
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-sm-12 text-center">
                        <!--<button class="btn load_products" type="button">Load More</button>-->
                    </div>
                    @else
                        <div class="shop-product-wrap gridview-4 row no-gutters"><p>{{__('No items found.')}}</p></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#sort").change(function() {
        $("#search-form").submit();
    });
    var processing;
    $(".load_products").click(function(){
        load_products();
    })
    function load_products(){
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
</script>
@endsection