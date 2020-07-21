@extends('frontend.layouts.app')
@section('content')
<section class="mostviewed-product-area pt--20 pb--60 pt-md--60 pb-md--50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title mb--35">
                    <h2>Brands</h2>
                </div>
            </div>
        </div>
        <div class="row">        
        @foreach ($brands as $key => $brand)
            <div class="col-3">
                <a href="{{ route('products.brand',$brand->id) }}">
                    <div class="mirora-product collction-product">
                        <div class="product-img">
                            <img src="{{ asset($brand->banner) }}" alt="product"/>
                        </div>
                        <div class="product-content text-center">
                            <h4 style="color:#fff">{{ $brand->name }}</h4>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
        </div>
        <div class="row">
            <div class="col-12 text-center">
                @if ($brands->onFirstPage())
                    
                @else
                    <a class="btn" href="{{ $brands->previousPageUrl() }}" rel="prev">&laquo; Previous</a>
                @endif
            
                @if ($brands->hasMorePages())
                    <a class="btn" href="{{ $brands->nextPageUrl() }}" rel="next">Next &raquo;</a>
                @endif

            </div>
        </div>
    </div>
</section>
@endsection
