
    <table class="table table-bordered">
        <thead>
            <tr>
                {{-- <th>{{__('Id')}}</th> --}}
                <th>{{__('Product Image')}}</th>
                <th>{{__('Product Name')}}</th>                                                
                <th>{{__('Comment')}}</th>
                <th width="15%">{{__('Rating')}}</th>
                <th width="13%">{{__('Order Date')}}</th>
            </tr>
        </thead>
        <tbody>
            @if (count($products) > 0)
                @foreach ($products as $key => $product)
                    <tr>
                        {{-- <td>{{ $product->product_id }}</td> --}}
                        <td><img src="{{ $product->thumbnail_img }}" width="50px"></td>
                        <td>{{ $product->name }}</td>                                                    
                        <td>
                            @if($product->rating > 0)
                                {{ $product->comment }}
                            @else 
                                <a href="javascript:void()">Review Pending</a>
                            @endif
                        </td>
                        <td>
                            @if($product->rating > 0)
                                @for ($i = 1; $i <= $product->rating; $i++)
                                    <i class="fa fa-star" aria-hidden="true" style="color:#FF5D5D"></i>
                                @endfor
                            @else
                                <a href="javascript:void()" 
                                    class="addrating"
                                    data-toggle="modal" 
                                    data-product-id="{{ $product->product_id }}" 
                                    data-product-name="{{ $product->name }}"
                                    data-target="#addrating">Add Review</a>
                            @endif
                        </td>
                        <td>{{ date('d-m-Y', strtotime($product->created_at)) }}</td>                                                    
                    </tr>
                @endforeach
                <div class="modal fade" id="addrating" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form action="{{route('reviews.submit')}}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="title">Submit Your Review</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <input type="hidden" name="hidden_product_id" id="hidden_product_id" value="" />
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="product">Product Name : </label>
                                        <input type="text" class="form-control" id="product" aria-describedby="product">
                                    </div>
                                    <div class="form-group">
                                        <label for="rating">Select Rating : </label>
                                        <select class="form-control" name="rating" id="rating">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="review">Enter Your Review : </label>
                                        <textarea class="form-control" name="review" id="review" rows="3" placeholder="Enter Your Review" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="submit_review">Save Review</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <tr>
                    <td colspan="7">{{__('No items found.')}}</td>
                </tr>
            @endif
        </tbody>
    </table>

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('.addrating').click(function() {
            $('input#product').val($(this).data('product-name'));
            $('input#hidden_product_id').val($(this).data('product-id'));
        });
    });
</script>
@endsection