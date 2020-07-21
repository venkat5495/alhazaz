@extends('frontend.layouts.app')

@section('content')

    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area other_bread">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-area">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h1 class="page-title">Compare</h1>
                                    <ul class="breadcrumb justify-content-center">
                                        <li><a href="{!! route('home') !!}">{!! __('Home') !!}</a></li>
                                        <li class="current">{!! __('Compare') !!}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <section class="gry-bg py-4">
        <div class="container container_compare">
            <div class="row">
                <div class="col">
                    <div class="card mb-4">
                        <div class="card-header text-center p-2">
                            <h3 style="float: left; line-height: 50px;">{{__('Comparison')}}</h4>
                            <a href="javascript:void(0)" style="text-decoration: none;" class="btn btn-default btn-base-5 btn-sm pull-right" onclick="clearcomparelist()">{{__('Reset Compare List')}}</a>
                        </div>
                        @if(Session::has('compare'))
                            @if(count(Session::get('compare')) > 0)
                                <div class="card-body">
                                    
                                    <div class="row">
                                        @foreach (Session::get('compare') as $key => $item)
                                        <div class="col-sm-4">
                                            <table class="table table-bordered">
                                                <tr><td><a href="{{ route('product', \App\Product::find($item)->slug) }}">{{ \App\Product::find($item)->name }}</a> </td></tr>
                                                <tr><td><img src="{{ asset(\App\Product::find($item)->thumbnail_img) }}" alt="Product Image" class="img-fluid py-4"></td></tr>
                                                <tr><td>{{ single_price(\App\Product::find($item)->unit_price) }}</td></tr>
                                                <tr><td>{{ \App\Product::find($item)->brand->name }}</td></tr>
                                                <tr><td><?php echo \App\Product::find($item)->description; ?></td></tr>
                                                <tr><td class="text-center py-4"><a class="btn btn-medium btn-style-2 add-to-cart" href="{{ route('product', \App\Product::find($item)->slug) }}">{{__('Add to cart')}}</a> </td></tr>
                                            </table>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="card-body">
                                <p class="text-center">{{__('Your comparison list is empty')}}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- modal area start-->
    <div class="modal fade" id="modal_box" tabindex="-1" role="dialog"  aria-hidden="true">
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

@endsection

@section('script')
    <script type="text/javascript">

    function clearcomparelist() {
        localStorage.removeItem("comparecount");
        window.location.href = '{{ route('compare.reset') }}';
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

    function showAddToCartModal(id){
        $('#modal-size').addClass('modal-lg');
        $('#modal_box').modal();
        $('.c-preloader').show();
        $.post('{{ route('cart.showCartModal') }}', {_token:'{{ csrf_token() }}', id:id}, function(data){
            $('#addToCart-modal-body').html(data);
            initialization();
        });
    }

    function updateNavCart(){
        $.post('{{ route('cart.nav_cart') }}', {_token:'{{ csrf_token() }}'}, function(data){
            $('#cart_items').html(data);
        });
    }

    function addToCart(){
        $('.c-preloader').show();
        $.ajax({
           type:"POST",
           url:'{{ route('cart.addToCart') }}',
           data:$('#option-choice-form').serialize(),
           success: function(data){
               $('.c-preloader').hide();
               $('#modal-size').removeClass('modal-lg');
               $('#addToCart-modal-body').html(data);
               updateNavCart();
           }
       });
    }
    </script>
@endsection
