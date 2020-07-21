<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use App\OrderDetail;
use App\Review;
use App\Order;
use Validator;
use Redirect;
use Auth;
use DB; 

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = OrderDetail::select('order_details.id', 'order_details.product_id', 'order_details.delivery_status', 'products.name', 'products.thumbnail_img', 'order_details.created_at',
                    DB::raw("(SELECT rating from reviews where reviews.product_id = order_details.product_id AND reviews.user_id = '".Auth::user()->id."') as rating"),
                    DB::raw("(SELECT comment from reviews where reviews.product_id = order_details.product_id AND reviews.user_id = '".Auth::user()->id."') as comment"))
                    ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
                    ->where('delivery_status', 'delivered')
                    ->whereIn('order_id', Order::where('user_id', Auth::user()->id)->pluck('id'))
                    ->get();
                    
        return view('review.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $review = new Review;
        $review->product_id = $request->product_id;
        $review->user_id = Auth::user()->id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        if($review->save()){
            flash('Review has been submitted successfully')->success();
            return back();
        }
        flash('Something went wrong')->error();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function submitreview(Request $request) {
        $validator = Validator::make(
            $request->all(), [
                'hidden_product_id' => 'required',
                'rating'     => 'required',
                'review'     => 'required'
            ]
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $reviews = Review::where('product_id', $request->hidden_product_id)->where('user_id', Auth::user()->id)->count();
            if($reviews > 0) {
                flash('Review has been submitted successfully. Thank you')->success();
                return back();
            }
            $review = new Review;
            $review->product_id = $request->hidden_product_id;
            $review->user_id = Auth::user()->id;
            $review->rating = $request->rating;
            $review->comment = $request->review;
            if($review->save()){
                flash('Review has been submitted successfully. Thank you')->success();
                return back();
            }
            flash('Something went wrong')->error();
            return back();
        }
    }

    public function getmynotification(Request $request) {
        $notifications = Notification::where('created_at','>', Auth::user()->notification_read)->whereNull('user_id')->orWhere('user_id', Auth::user()->id)->paginate(10);
        $result = \App\User::where('id', Auth::user()->id)->update(['notification_read' => date('Y-m-d H:i:s')]);
        return view('notification.index', compact('notifications'));
    }
}
