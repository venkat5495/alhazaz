@extends('frontend.layouts.app')

@section('content')
    <!--wishlist area start -->
    <div class="wishlist_area">
        <div class="container">
            <form action="#">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc wishlist">
                            <div  class="cart_page table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="product_remove">{!! __('Delete') !!}</th>
                                        <th class="product_thumb">{!! __('Image') !!}</th>
                                        <th class="product_name">{!! __('Product') !!}</th>
                                        <th class="product-price">{!! __('Price') !!}</th>
                                        {{--                                        <th class="product_quantity">Stock Status</th>--}}
                                        <th class="product_total">{!! __('Add to cart') !!}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="wishlist">
                                        @include('frontend.partials.wishlist')
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <div class="row">
                <div class="col-12">
                    <div class="wishlist_share">
                        <h4>{{__('Share on')}}:</h4>
                        <div id="share"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--wishlist area end -->
@endsection

@section('script')
    <script type="text/javascript">
        function removeFromWishlist(id){
            $.post('{{ route('wishlists.remove') }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
                $('#wishlist').html(data);
                // $('#wishlist_'+id).hide();
                showFrontendAlert('success', 'Item has been removed from wishlist');
            });
        }
        $(document).ready(function() {
            $('#share').share({
                networks: ['facebook','googleplus','twitter','linkedin'/*,'tumblr','in1','stumbleupon','digg'*/],
                theme: 'square'
            });
        });
    </script>
@endsection
