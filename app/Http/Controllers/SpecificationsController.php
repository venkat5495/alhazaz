<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specifications;
use Validator;
use Redirect;

class SpecificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specifications = Specifications::all();
        return view('specifications.index', compact('specifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('specifications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function niceNames(){
        $niceNames = array(
            'specifications_title' => __('Specifications Title'),
            'specifications_name_english' => __('Specifications Name (English)'),
            'specifications_name_arabic' => __('Specifications Name (Arabic)'),
            'specifications_description_english' => __('Specifications Description (English)'),
            'specifications_description_arabic' => __('Specifications Description (Arabic)'),
        );
        return $niceNames;
    }

    public function store(Request $request)
    {
        $request->validate([
            'specifications_title' 					=> 'required|unique:specifications,specifications_title',
            'specifications_name_english' 			=> 'required',
            'specifications_name_arabic' 			=> 'required',
            'specifications_description_english' 	=> 'required',
            'specifications_description_arabic' 	=> 'required',
        ]);
        $specifications = new Specifications;
        $all_attr[] = [
            'specifications_title'               => $request->specifications_title,
            'specifications_name_english'        => $request->specifications_name_english,
            'specifications_name_arabic'         => $request->specifications_name_arabic,
            'specifications_description_english' => $request->specifications_description_english,
            'specifications_description_arabic'  => $request->specifications_description_arabic,
        ];
        if(Specifications::insert($all_attr)) {
            flash(__('Specifications has been inserted successfully'))->success();
            return redirect()->route('specifications.index');
        }
        else{
            flash(__('Something went wrong'))->error();
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
        $specifications = Specifications::findOrFail(decrypt($id));
        return view('specifications.edit', compact('specifications'));
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
        $request->validate([
            'specifications_title' 					=> 'required',
            'specifications_name_english' 			=> 'required',
            'specifications_name_arabic' 			=> 'required',
            'specifications_description_english' 	=> 'required',
            'specifications_description_arabic' 	=> 'required',
        ]);

        $specifications = Specifications::findOrFail($id);

        $specifications->specifications_title 				= $request->specifications_title;
        $specifications->specifications_name_english 		= $request->specifications_name_english;
        $specifications->specifications_name_arabic 		= $request->specifications_name_arabic;
        $specifications->specifications_description_english = $request->specifications_description_english;
        $specifications->specifications_description_arabic 	= $request->specifications_description_arabic;
        if($specifications->save()) {
            flash(__('Specifications has been updated successfully'))->success();
            return redirect()->route('specifications.index');
        }
        else{
            flash(__('Something went wrong'))->error();
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

        if(Specifications::destroy($id)){
            flash(__('Specifications has been deleted successfully'))->success();
            return redirect()->route('specifications.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }


    public function enableSpecifications($id){

        $specifications = Specifications::find(decrypt($id));
        $specifications = $specifications->is_enable == 1 ? 0 : 1;

        $specifications->is_enable = $specifications;
        $specifications->save();

        return redirect()->back()->with('msg','Status changed');

    }
}
