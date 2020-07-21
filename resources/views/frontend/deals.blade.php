@extends('frontend.layouts.app')
@section('content')
<section class="mostviewed-product-area pt--20 pb--60 pt-md--60 pb-md--50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title mb--35">
                    <h2>Deals</h2>
                </div>
            </div>
        </div>
        
        <?php $d = 1; ?>
        @foreach ($flash_deal as $key => $deals)
        <a href="{{ route('productsgroup', $deals->product_group) }}">
            <div class="dealwrap clearfix" style="padding: 0px 0px  0px 10px;">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="watch-title mb--30">{{ $deals->title }}</div>
                        <div class="watchtxt mb--40">{{ $deals->description }}</div>
                        <div id="simple-timer<?= $d; ?>"></div>                                    
                    </div>
                    <div class="col-sm-6 mobile-hide" style="padding:0">
                        <center><img src="{{ asset($deals->banner_path) }}" alt="Deal" style="height: 250px;"></center>
                    </div>
                </div>
            </div>
        </a>
        <hr>
        <?php $d++; ?>
        @endforeach
    </div>
    
    
    <div class="row">
        <div class="col-12 text-center">
            @if ($flash_deal->onFirstPage())

            @else
                <a class="btn" href="{{ $flash_deal->previousPageUrl() }}" rel="prev">&laquo; Previous</a>
            @endif
            @if ($flash_deal->hasMorePages())
                <a class="btn" href="{{ $flash_deal->nextPageUrl() }}" rel="next">Next &raquo;</a>
            @endif
        </div>
    </div>
</section>
<?php $j = 1; ?>
@foreach (\App\FlashDeal::where([['status', '=', '1']])->get() as $key => $deals)
<?php 
$date = date('Y-m-d-H-i', $deals->end_date); 
$arr  = explode("-", $date);
$y    = !empty($arr[0])?$arr[0]:0;
$month= !empty($arr[1])?$arr[1]:0;
$d    = !empty($arr[2])?$arr[2]:0;
$h    = !empty($arr[3])?$arr[3]:0;
$m    = !empty($arr[4])?$arr[4]:0;
?>
<script>
$("#simple-timer<?= $j; ?>").syotimer({
    year: <?= $y ?>,
    month: <?= $month ?>,
    day: <?= $d ?>,
    hour: 23,
    minute: 59
});
</script>
<?php $j++; ?>
@endforeach
@endsection