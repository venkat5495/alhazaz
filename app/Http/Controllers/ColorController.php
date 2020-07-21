<?php

namespace App\Http\Controllers;

use App\Color;
use App\FlashDeal;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::latest()->get();
        return  view('colors.index',compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('colors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->rule($request);
        $insert = [
            'name' => preg_replace('/\s+/', '', $request->name),
            'code' => $request->code
        ];
        $insert = Color::create($insert);

         if ($insert){
             flash(__('colors has been inserted successfully'))->success();
             return  redirect()->route('colors.index');
         }else{
             flash(__('something went wrong'))->error();
             return back();
         }
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
        $editColor = Color::findOrFail(decrypt($id));
        return view('colors.edit',compact('editColor'));
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

        $this->rule($request,$id);
        $update = [
            'name' => preg_replace('/\s+/', '', $request->name),
            'code' => $request->code
        ];
        $updateColor = Color::where('id',$id)->update($update);

        if ($updateColor){
            flash(__('color has been updated successfully'))->success();
            return redirect()->route('colors.index');
        }else{
            flash(__('something went wrong'))->error();
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return back();
    }

    public function rule($request,$id = null){
       return  $request->validate([
                'name' => 'required|unique:colors,name,'.$id,
                'code' => 'required|unique:colors,code,'.$id
            ]);
    }
}
