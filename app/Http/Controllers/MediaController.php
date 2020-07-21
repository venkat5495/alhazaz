<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Device;
use App\Media;
use App\Jobs\SendNotification;
use App\Order;
use App\OrderDetail;
use App\Product;
use Response;
use ImageOptimizer;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->file_name))
        {
            $media = Media::where('name', 'like', '%'.$request->file_name.'%')->orderBy('id','desc')->orWhere('media_img', 'like', '%'.$request->file_name.'%')->paginate(10);
        } else {
            $media = Media::orderBy('id','desc')->paginate(10);
        }
        return view('media.index', compact('media'));
    }

    public function store(Request $request)
    {
        $s = "";
        if (isset($request['media_img'])) {
            foreach($request->media_img as $img) {
                $current_image  = $img->store('uploads/media');
                $name           = $img->getClientOriginalName();
                ImageOptimizer::optimize(base_path('public/').$current_image);
                $s = Media::insert(['name'=> $name, 'media_img'=> $current_image]);
            }
        }
        if($s) {
            flash(__('Inserted successfully'))->success();
            return redirect()->route('media.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        if(Media::destroy($id)) {
            flash(__('Deleted successfully'))->success();
            return redirect()->route('media.index');
        } else {
            flash(__('Something went wrong'))->error();
            return back();
        }
    }
}