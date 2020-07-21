<!DOCTYPE html>
@if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
    <html dir="rtl">
@else
    <html>
@endif
<head>
@php
    $seosetting = \App\SeoSetting::first();
@endphp
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="index, follow">
<meta name="description" content="{{ $seosetting->description }}">
<meta name="keywords" content="{{ $seosetting->keyword }}">
<meta name="author" content="{{ $seosetting->author }}">
<meta name="sitemap_link" content="{{ $seosetting->sitemap_link }}">
<!-- Favicons -->
<link rel="shortcut icon" href="{{ asset(\App\GeneralSetting::first()->favicon) }}" type="image/x-icon">
<link rel="apple-touch-icon" href="{{ asset(\App\GeneralSetting::first()->favicon) }}">
<!-- Title -->
<title>{{ config('app.name', 'Laravel') }}</title>

<!-- ************************* CSS Files ************************* -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/elegent-icons.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
<link id="effect" rel="stylesheet" type="text/css" media="all" href="{{ asset('frontend/assets/css/fade-down.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('frontend/assets/css/webslidemenu.css') }}" />
<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ asset('frontend/assets/css/white-gry.css') }}" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.min.css') }}">
<script src="{{ asset('frontend/assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
@if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
    <link type="text/css" href="{{ asset('frontend/css/active.rtl.css') }}" rel="stylesheet">
@endif
</head>
<body>


<!-- MAIN WRAPPER -->
<div class="main-content-wrapper">
    <!-- Header -->
    @include('frontend.inc.nav')

    @yield('content')
    <!-- modal area start-->
    <div class="modal fade added-to-cart-wrapper" id="modal_box" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" id="modal-size" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="addToCart-modal-body" class="modal_body"></div>
            </div>
        </div>
    </div>
    <!-- modal area start-->

    @include('frontend.inc.footer')
</div><!-- END: body-wrap -->

<!-- SCRIPTS -->
<a href="#" class="back-to-top btn-back-to-top"></a>

<!-- ************************* JS Files ************************* --> 

<!-- jQuery JS --> 
<script src="{{ asset('frontend/assets/js/vendor/jquery.min.js') }}"></script> 
<script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script> 
<script src="{{ asset('frontend/assets/js/plugins.js') }}"></script> 
<script src="{{ asset('frontend/assets/js/ajax-mail.js') }}"></script> 
<script type="text/javascript" src="{{ asset('frontend/assets/css/webslidemenu.js') }}"></script>
<script src="{{ asset('frontend/assets/js/main.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
.modal.show {
    z-index: 999999999;
}
    .added-to-cart-wrapper .modal-content button.close {
        position: relative;
        left: 90%;
        width: 35px;
        height: 35px;
        display: block;
        border: 1px solid #ddd;
        top: 10px;
        border-radius: 50%;
        cursor: pointer;
        z-index: 9;
    }
    .modal-content h3 {
        font-size: 30px;
        line-height: 30px;
    }
    .added-to-cart .text-success i {
        font-size: 18px;
        height: 50px;
        width: 50px;
        line-height: 48px;
        border: 2px solid #28a745;
        border-radius: 50px;
        margin-bottom: 15px;
    }
  .counter2 .title {
    color: #dd7700;
    font-size: 16px;
    font-size: 1.6rem;
    text-transform: uppercase;
    display: block;
    margin-bottom: 15px;
    font-family: 'Raleway', sans-serif;
    font-weight: 500;
}
.counter2 .sq {
    color: #dd7700;
    display: inline-block;
    text-align: center;
	float:right;
}
.counter2 .sq .bord {
    border: 1px solid #a8741a;
    padding: 16px 15px;
    margin-right: 18px;
    text-indent: 0px;
    font-size: 22px;
    font-size: 2.2rem;
    margin-bottom: 5px;
    width: 54px;
	color:#fff;
	background:#a8741a;
}
.counter2 .sq span {
    clear: both;
    display: block;
    text-indent: -15px;
    font-size: 16px;
    font-size: 1.6rem;
}
.well {
  text-align: center;
  max-width: 400px;
}
  
</style>

<script>
    $('body #GuestCheckout').on('click','#js_login_button', function() {
        $('.error').html('');
        my_form   = $("#GuestCheckout").find("#js_login_form");
        form_data     = my_form.serialize();
        url = $("#GuestCheckout").find("#js_login_form").attr('action');
        $.ajax({
            type:'POST',
            url : url,
            data : form_data,
            beforeSend: function(){$('.js_loader').show();},
            success : function(result){
                if (result.status) {
                    $("#js_login_div").html('');
                    $(".js_guest").hide();
                    // $("#js_otp_div").show();
                    $('#GuestCheckout').modal('hide');
                    window.location.href = "{{ route('checkout.shipping_info') }}";
                    // $("#js_span_otp").html('( '+result.otp+' )');
                }else{
                    $.each(result.errors, function( k, v ){
                        my_form.find('#'+k).parent().next('div').html(v);
                    });
                }
                $('.js_loader').hide();
            }
        });
    });
    $('body #GuestCheckout').on('click','#js_submit_otp', function() {
        $('.error').html('');
        my_form   = $("#GuestCheckout").find("#js_otp_form");
        form_data     = my_form.serialize();
        url = $("#GuestCheckout").find("#js_otp_form").attr('action');
        $.ajax({
            type:'POST',
            url : url,
            data : form_data,
            beforeSend: function(){$('.js_loader').show();},
            success : function(result){
                if (result.status) {
                    $("#GuestCheckout").modal('hide');
                    window.location.href = "{{ route('checkout.shipping_info') }}";
                }else{
                    $('#otp_error').html(result.error);
                }
                $('.js_loader').hide();
            }
        });
    });
    $(document).on("input", "input#coupon_code" , function() {
        var code = $('input#coupon_code').val();
        if(code.length > 0) {
            $('input#coupon_code').css({"border-color": "#e6e6e6"});
            $('p.coupon_error_message').html('');
        } else {
            $('input#coupon_code').css({"border-color": "#FF5D5E"});
            $('p.coupon_error_message').html('');
        }
        return false;
    });
    

    function removeFromCartView(e, key){
        e.preventDefault();
        removeFromCart(key);
    }
    function showCheckoutModal() {
        $('#GuestCheckout').modal();
    }
    
    $('#apply_cart_coupon').click(function() {
        var code = $('input#coupon_code').val();
        if(code !== undefined && code !== null && code !== "") {
            $.post('{{ route('cart.applypromo') }}', { _token:'{{ csrf_token() }}', code:code}, function(data){
                if(data.success == false) {
                    // $('#cart-summary').html(data);
                    $('p.coupon_error_message').html(data.message);
                } else {
                    $('#cart-summary').html(data);
                }
            });
        } else {
            $('input#coupon_code').css({"border-color": "#FF5D5E"});
            return false;
        }
    });


    function showFrontendAlert(type, message) {
        swal({
            position: 'top-end',
            type: type,
            title: message,
            showConfirmButton: false,
            timer: 3000,
            width:400,
        });
    }
    
    $('#option-choice-form input,#option-choice-form select').on('change', function() {
        var colorname = $(this).data('colorname');
        $('#display_colorname').text(colorname);
        getVariantPrice();
    });

    function getVariantPrice(){
        if($('#option-choice-form input[name=quantity]').val() > 0 && checkAddToCartValidity()){
            $.ajax({
                type:"POST",
                url: '{{ route('products.variant_price') }}',
                data: $('#option-choice-form').serializeArray(),
                success: function(data){
                    $('#option-choice-form #chosen_price_div').removeClass('d-none');
                    $('#option-choice-form #chosen_price_div #chosen_price').html(data.price);
                    if(data.color_image != null){
                        $('.'+data.color_image).siblings().hide();
                        $('.'+data.color_image).show();
                        $('#'+data.color_image).click();
                    }
                }
            });
        }
    }
    
    $(document).on('keyup','#search', function(){
        search($(this).val());
    });
    $(document).on('focus','#search', function(){
        search($(this).val());
    });
    function search(val){
        var search = val;
        if(search.length > 0){
            $('body').addClass("typed-search-box-shown");

            $('.typed-search-box').removeClass('d-none');
            $('.search-preloader').removeClass('d-none');
            $.post('{{ route('search.ajax') }}', { _token: '{{ @csrf_token() }}', search:search}, function(data){
                if(data == '0'){
                    $('.typed-search-box').addClass('d-none');
                    $('#search-content').html(null);
                    $('.typed-search-box .search-nothing').removeClass('d-none').html('Sorry, nothing found for <strong>"'+search+'"</strong>');
                    $('.search-preloader').addClass('d-none');

                }
                else{
                    $('.typed-search-box .search-nothing').addClass('d-none').html(null);
                    $('#search-content').html(data);
                    $('.search-preloader').addClass('d-none');
                }
            });
        }
        else {
            $('.typed-search-box').addClass('d-none');
            $('body').removeClass("typed-search-box-shown");
        }
    }
    function initialization() {
        $('.select_option').niceSelect();
        function i() {
            return !!$("html").hasClass("rtl")
        }
        $(".product_navactive").owlCarousel({
            autoplay: !0,
            loop: !0,
            nav: !0,
            rtl: i(),
            autoplayTimeout: 8e3,
            items: 4,
            dots: !1,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            responsiveClass: !0,
            responsive: {0: {items: 1}, 250: {items: 2}, 480: {items: 3}, 768: {items: 4}}
        });
        $(".product_navactive").resize();
        $(".modal").on("shown.bs.modal", function (t) {
            $(".product_navactive").resize();
        });
        $(".product_navactive a").on("click", function (t) {
            t.preventDefault();
            var i = $(this).attr("href");
            $(".product_navactive a").removeClass("active"), $(this).addClass("active"), $(".product-details-large .tab-pane").removeClass("active show"), $(".product-details-large " + i).addClass("active show")
        });
    }
    function showAddToCartModal(id,offer_id = null){
        //$('#modal-size').addClass('modal-lg');
        $('#productModal').modal();
        //$('.c-preloader').show();
        $.post('{{ route('cart.showCartModal') }}', {_token:'{{ csrf_token() }}', id:id,offer_id:offer_id}, function(data) {
            $('#addToCart-modal-body').html(data);
            initialization();
        });
    }

    function updateQuantity(key, element) {
            $.post('{{ route('cart.updateQuantity') }}', { _token:'{{ csrf_token() }}', key:key, quantity: element}, function(data){
            updateNavCart();
            $('#cart-summary').html(data);
        });
    }

    function updateNavCart() {
        $.post('{{ route('cart.nav_cart') }}', {_token:'{{ csrf_token() }}'}, function(data) {
            $('#cart_items').html(data);
            $('#cart_items_canv').html(data);
        });
    }

    function checkAddToCartValidity(){
        var names = {};
        $('#option-choice-form input:radio').each(function() { // find unique names
              names[$(this).attr('name')] = true;
        });
        var count = 0;
        $.each(names, function() { // then count them
              count++;
        });
        if($('input:radio:checked').length == count){
            return true;
        }
    }
    function cartDropdown()
    {
        $(".mini-cart__dropdown-menu").toggle();
    }
    function addToCart(){
        if(checkAddToCartValidity() && $("#quantity").val() ) {
            $('#modal_box').modal();
            $('.c-preloader').show();
            $.ajax({
               type:"POST",
               url: '{{ route('cart.addToCart') }}',
               data: $('#option-choice-form').serializeArray(),
               success: function(data){
                   $('#addToCart-modal-body').html(null);
                   $('.c-preloader').hide();
                   $('#modal-size').removeClass('modal-lg');
                   $('#addToCart-modal-body').html(data);
                   updateNavCart();
                   $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())+1);
               }
           });
        }
        else{
            showFrontendAlert('warning', 'Please choose all the options');
        }
    }

    function removeFromCart(key){
        $.post('{{ route('cart.removeFromCart') }}', {_token:'{{ csrf_token() }}', key:key}, function(data){
            updateNavCart();
            $('#cart-summary').html(data);
            showFrontendAlert('success', 'Item has been removed from cart');
            $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())-1);
        });
    }

    function addToWishList(id){
        @if (Auth::check())
        $.post('{{ route('wishlists.store') }}', {_token:'{{ csrf_token() }}', id:id}, function(data){
            if(data != 0){
                if ($('[id=add_to_whishlist_'+id+']').children().hasClass('fa fa-heart')) {
                    $('[id=add_to_whishlist_'+id+']').children().removeClass('fa fa-heart');
                    $('[id=add_to_whishlist_'+id+']').children().addClass('fa fa-heart-o');
                    // $('#add_to_whishlist_'+id).parent().parent().parent().removeClass('active');
                    showFrontendAlert('warning', 'Item has been removed from wishlist');
                }else{
                    $('[id=add_to_whishlist_'+id+']').children().removeClass('fa fa-heart-o');
                    $('[id=add_to_whishlist_'+id+']').children().addClass('fa fa-heart');
                    // $('#add_to_whishlist_'+id).parent().parent().parent().addClass('active');
                    showFrontendAlert('success', 'Item has been added to wishlist');
                }
                // $('#wishlist').html(data);
            }
            else{
                showFrontendAlert('warning', 'Please login first');
            }
        });
        @else
        showFrontendAlert('warning', 'Please login first');
        @endif
    }

    function addToCompare(id){
        if (localStorage.comparecount) {
            localStorage.comparecount = Number(localStorage.comparecount)+1;
        } else {
            localStorage.comparecount = 1;
        }
        if(localStorage.comparecount < 5) {
            $.post('{{ route('compare.addToCompare') }}', {_token:'{{ csrf_token() }}', id:id}, function(data){
                // $('#compare').html(data);
                showFrontendAlert('success', 'Item has been added to compare list');
                // $('#compare_items_sidenav').html(parseInt($('#compare_items_sidenav').html())+1);
            });
        } else {
            showFrontendAlert('warning', 'You can not add more than 3 product in compare list.');
        }
    }

    function show_purchase_history_details(order_id)
    {
        $('#order-details-modal-body').html(null);

        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }

        $.post('{{ route('purchase_history.details') }}', { _token : '{{ @csrf_token() }}', order_id : order_id}, function(data){
            $('#order-details-modal-body').html(data);
            $('#order_details').modal();
            $('.c-preloader').hide();
        });
    }

    function show_order_details(order_id)
    {
        $('#order-details-modal-body').html(null);

        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }

        $.post('{{ route('orders.details') }}', { _token : '{{ @csrf_token() }}', order_id : order_id}, function(data){
            $('#order-details-modal-body').html(data);
            $('#order_details').modal();
            $('.c-preloader').hide();
        });
    }

    function cartQuantityInitialize(){
        $('.btn-number').click(function(e) {
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());

            if (!isNaN(currentVal)) {
                if (type == 'minus') {

                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if (type == 'plus') {

                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });

        $('.input-number').focusin(function() {
            $(this).data('oldValue', $(this).val());
        });

        $('.input-number').change(function() {

            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }


        });
        $(".input-number").keydown(function(e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    }


        $("#edit-address").prop('disabled',true);
        $(".demo-select2-placeholder").select2({
            placeholder: "Select an option",
            allowClear: true
        });
        function getPaymentInfo(){
            $('#phone_error').html('');
            var isValid = true;
            $('.card-body input').each(function() {
                if ( this.value == '' ){
                    isValid = false;
                }
            });

            if($('input[name=user_address]').is(':checked')){
                var isValid = true;
            } else {
                if($('#state').val() == '') {
                    var isValid = false;
                }
                if($('#city_ids').val() == '') {
                    var isValid = false;
                }
            }
            if(isValid){
                $.ajax({
                    type:"POST",
                    url:'{{ route('checkout.payment_info') }}',
                    data: $('#shipping_form').serialize(),
                    success: function(data){
                        if(data.status == 'otp_screen') {
                            $('#Mobileverify').modal();
                        }
                        if(!data.status && data.error != null) {
                            $('#phone_error').html(data.error);
                            return false;
                        }
                        @if (\Auth::check())
                            $('#js_address_div').html(data);
                            $(".user-actions").remove();
                            get_cod_charge('cash_on_delivery');
                        @endif
                    }
                });
            }
            else{
                alert('Please fill all the fileds');
            }
        }

        $('body #Mobileverify').on('click','#js_submit_otp', function() {
            $('.error').html('');
            my_form   = $("#Mobileverify").find("#js_otp_form");
            form_data     = my_form.serialize();
            url = $("#Mobileverify").find("#js_otp_form").attr('action');
            $.ajax({
                type:'POST',
                url : url,
                data : form_data,
                beforeSend: function(){$('.js_loader').show();},
                success : function(result){
                    if (result.status) {
                        $("#Mobileverify").modal('hide');
                        $('#js_address_div').html(result.html);
                    }else{
                        $('#otp_error').html(result.error);
                    }
                    $('.js_loader').hide();
                }
            });
        });

        function get_cities(selected_city_id = null){
            var selected_city_id = selected_city_id;
            var state_id = $('#state').val();
            if (state_id !== undefined){
                $.get('{{ route('cities_list') }}',{_token:'{{ csrf_token() }}', state_id:state_id, city_id:selected_city_id}, function(data){
                    $('#city_ids').html(data);
                    // $('.demo-select2').select2();
                });
            }
        }

        $(document).on('change','#state', function() {
            get_cities();
        });



        $('.js_user_address').on('change', function() {
            address_id = $(this).val();
            // console.log(address_id);
            $('#edit-address').prop('disabled',false);
            $("#billing_details_field").hide();
            if($('input[name=user_address]').is(':checked')){
                get_cart_summary(address_id);
            }
        });
        function get_cart_summary(user_address=null) {
            var city_id = $('#city_ids').val();
            $.get('{{ route('cart_summary_ajax') }}',{_token:'{{ csrf_token() }}', city_id:city_id,user_address:user_address}, function(data){
                if(data != ''){
                    $('#js_car_summary_div').html(data);
                }
            });
        }

        $('#city_ids').on('change', function() {
            get_cart_summary();
        });

        $('body').on('click','.js_payment_option',function(){
            payment_option = $(this).val();
            if (payment_option == 'cash_on_delivery') {
                payment_option = 'cash_on_delivery';
                get_cod_charge(payment_option);
            }else{
                get_cod_charge();
            }
        })
        function get_cod_charge(payment_option=null) {
            $.get('{{ route('cod_charge_ajax') }}',{payment_option:payment_option}, function(data){
                // console.log(data);
                if(data != ''){
                    $('#js_car_summary_div').html(data);
                }
            });
        }

        $(document).on('click',"#edit-address",function () {
            var userAddressId = $("input[name='user_address']:checked").val();
            // console.log(userAddressId);
        $.get('{{route('get_address_data')}}',{user_address:userAddressId},function (data) {
                if(data != ''){
                    $("#billing_details_field").html(data);
                    $("#billing_details_field").show();
                    $('.niceselect_option').niceSelect();
                    var selected_city_id = $('input[name="selected_city_id"]').val();
                    get_cities(selected_city_id);
                }
            });
        });



        // $('.select_option').niceSelect();
        function filter(){
            $('#search-form').submit();
        }

        $("#filter").click(function (){
            var arg = $("#amount").val().split('-');
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
        });

         $(".nice-select > ul > li").click(function(e){
            var val = $(this).data('value');
            $('input[name=sort_by]').val(val);
            filter();
        });

        $("#amount").val($( "#slider-range" ).slider( "values", 0 ) + "-" + $( "#slider-range" ).slider( "values", 1 ) );

    var processing;
    $("body").on('touchmove scroll mousewheel keydown','.container',function(){
        console.log('wor');
        if (processing)
            return false;
        if ($(window).scrollTop() >= $(document).height() - $(window).height() - 700){
            processing = true;
            load_products();
        }
    })

    $(document).keydown(function (event) {
        if (event.keyCode == 40) {
            // event.preventDefault();
            if (processing)
                return false;

            if ($(window).scrollTop() >= $(document).height() - $(window).height() - 700){
                processing = true;
                load_products();
            }
        }
    });
    function load_products(){
        console.log("calling something...");
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
</body>
</html>