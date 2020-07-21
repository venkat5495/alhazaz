<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Policy;
use Validator;

class PolicyController extends Controller
{

    // public function index($type)
    // {
    //     $policy = Policy::where('name', $type)->first();
    //     return view('policies.index', compact('policy'));
    // }

    // //updates the policy pages
    // public function store(Request $request){
    //     $policy = Policy::where('name', $request->name)->first();
    //     $policy->name = $request->name;
    //     $policy->content = $request->content;
    //     $policy->save();

    //     flash($request->name.' updated successfully');
    //     return back();
    // }


    public function index()
    {
        $policies = Policy::get();
        return view('cms.index', compact('policies'));
    }

    //updates the policy pages
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:policies,name|regex:/^[\pL\s\-]+$/u',
        ]);

        $policy = new Policy();
        $policy->name = $request->name;
        $policy->slug = str_slug($request->name);
        $policy->content = $request->content;
        $policy->sa_content = $request->sa_content;
        $policy->save();

        flash('CMS created successfully');
        return redirect()->route('cms.index');
    }

    public function create(){
        return view('cms.create');
    }

    public function edit($id)
    {
        $policy = Policy::findOrFail(decrypt($id));
        return view('cms.edit', compact('policy'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|regex:/^[\pL\s\-]+$/u|unique:policies,name,'.$id.',id',
        ]);
        $policy = Policy::findOrFail($id);
        $policy->name = $request->name;
        $policy->content = $request->content;
        $policy->sa_content = $request->sa_content;
        if($policy->save()){
            flash('CMS has been updated successfully')->success();
            return redirect()->route('cms.index');
        }
        flash('Something went wrong')->error();
        return back();
    }

    public function destroy($id)
    {
        $policy = Policy::findOrFail($id);
        if(Policy::destroy($id)){
            flash('CMS has been deleted successfully')->success();
            return redirect()->route('cms.index');
        }
        flash('Something went wrong')->error();
        return back();
    }
}
