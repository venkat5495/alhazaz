@extends('frontend.layouts.app')
@section('content')
    <div class="promo-box-area ptb--30 ptb-md--30">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title mb--35">
                        <h2>Top Offers</h2>
                    </div>
                </div>
            </div>
            
            <div class="row">
                @if($offers->isNotEmpty())
                    @foreach($offers as $offer)
                        @php 
                        if(!empty($offer->product_group))
                        {
                            $link = route('productsgroup', $offer->product_group);
                        } else {
                            $link = "#";
                        }
                        @endphp
                    <div class="col-md-6 mb-sm--30" style="margin-bottom: 15px">
                        <a href="{{ $link }}">
                            <img src="{{ asset($offer->banner) }}" class="img-fluid" alt="{{ $offer->banner_title_english }}">
                        </a>
                    </div>
                @endforeach
                @else
                    <div class="col-sm-12">
                        <h3> Offer not available right now.! </h3>
                    </div>
                @endif
            </div>
            
            <div class="row">
                <div class="col-12 text-center">
                    @if ($offers->onFirstPage())

                    @else
                        <a class="btn" href="{{ $offers->previousPageUrl() }}" rel="prev">&laquo; Previous</a>
                    @endif
                
                    @if ($offers->hasMorePages())
                        <a class="btn" href="{{ $offers->nextPageUrl() }}" rel="next">Next &raquo;</a>
                    @endif
    
                </div>
            </div>
        </div>
    </div>
@endsection
