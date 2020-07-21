<?php
$brand = (\App\Brand::whereid($product->brand_id)->first());
?>
<div class="row">
    <div class="col-lg-5 col-md-6 mb-sm--20">
        <div class="tab-content product-thumb-large">
            <div id="thumb" class="tab-pane active show fade"> <img src="{!! asset($product->thumbnail_img) !!}" alt=""> </div>
        </div>
        <!--<div class="product-thumbnail">
            <div class="thumb-menu" id="modal-thumbmenu">
                <div class="thumb-menu-item"> <a href="#thumb1" data-toggle="tab" class="nav-link active"> <img src="{{ asset('frontend/assets/img/products/1-1-450x450.jpg')}}" alt="product thumb"> </a> </div>
                <div class="thumb-menu-item"> <a href="#thumb2" data-toggle="tab" class="nav-link"> <img src="{{ asset('frontend/assets/img/products/2-2-450x450.jpg')}}" alt="product thumb"> </a> </div>
                <div class="thumb-menu-item"> <a href="#thumb3" data-toggle="tab" class="nav-link"> <img src="{{ asset('frontend/assets/img/products/10-10-450x450.jpg')}}" alt="product thumb"> </a> </div>
                <div class="thumb-menu-item"> <a href="#thumb4" data-toggle="tab" class="nav-link"> <img src="{{ asset('frontend/assets/img/products/11-11-450x450.jpg')}}" alt="product thumb"> </a> </div>
                <div class="thumb-menu-item"> <a href="#thumb5" data-toggle="tab" class="nav-link"> <img src="{{ asset('frontend/assets/img/products/12-12-450x450.jpg')}}" alt="product thumb"> </a> </div>
                <div class="thumb-menu-item"> <a href="#thumb6" data-toggle="tab" class="nav-link"> <img src="{{ asset('frontend/assets/img/products/13-13-450x450.jpg')}}" alt="product thumb"> </a> </div>
            </div>
        </div>-->
    </div>
  
    <div class="col-lg-7 col-md-6">
        <div class="modal-box product">
            <h3 class="product-title">{{ $product->name }}</h3>
            <div class="ratings mb--20"> <i class="fa fa-star rated"></i> <i class="fa fa-star rated"></i> <i class="fa fa-star rated"></i> <i class="fa fa-star rated"></i> <i class="fa fa-star"></i> </div>
            <ul class="product-detail-list list-unstyled mb--20">
                <li>Brand: <a href=""><?= $brand->name ?></a></li>
                <?php if(!empty($product->rp_reward_points)) { ?>
                <li>Reward Points: <?= $product->rp_reward_points ?></li>
                <?php }
                if(!empty($product->rp_reward_points))
                { ?>
                <li>Availability: <?= $product->out_of_stock_status ?></li>
                <?php } ?>
            </ul>
            <div class="product-price border-bottom pb--20 mb--20"> <span class="regular-price">SAR{{ $product->unit_price }}</span> <span class="sale-price">SAR{{ $product->purchase_price }}</span> </div>
            <form id="option-choice-form">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="offer_id" value="{{ $offer_id }}">
                <div class="product-options mb--20">
                    <h3>Available Options</h3>
                    <div class="form-group">
                        <label><sup>*</sup>Color Switch</label>
                        <select id="option-choice-form">
                            <option value=""> --- Please Select --- </option>
                            @foreach (json_decode($product->colors) as $key => $color)
                                <option value="{{ $color }}" data-colorname="{{json_decode($product->colorname)[$key]}}">{{json_decode($product->colorname)[$key]}}</option>
                            @endforeach
                        </select>
                        <p id="display_colorname" class="mb-0"></p>
                    </div>
                </div>
                <div class="product-action-wrapper mb--20">
                    <div class="product-action-top d-flex align-items-center mb--20">
                        <div class="quantity"> <span>Qty: </span>
                            <input id="quantity" class="quantity-input"  min="{{ generalsettingdata('min_qty') }}" max="{{ generalsettingdata('max_qty') }}" name="quantity" step="1" value="1" type="number">
                        </div>
                        <button type="button" class="btn btn-medium btn-style-2 add-to-cart" onclick="addToCart()"> Add To Cart </button>
                    </div>
                    <div class="product-action-bottom"> <a href="#">+Add to wishlist</a> <a href="compare.html">+Add to compare</a> </div>
                </div>
                <p class="product-tags"> Tags: <a href="#">Sport</a>, <a href="#">Luxury</a> </p>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    cartQuantityInitialize();
    $('#option-choice-form').on('change', function(){
        var colorname = $(this).data('colorname');
        $('#display_colorname').text(colorname);
        getVariantPrice();
    });
</script>
