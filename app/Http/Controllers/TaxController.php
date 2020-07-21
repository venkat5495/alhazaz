<?php

namespace App\Http\Controllers;

use App\TaxSetting;
use Illuminate\Http\Request;

class TaxController extends Controller
{

    public function index()
    {
        $taxsetting = TaxSetting::first();
        return view('tax_settings.index', compact("taxsetting"));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $taxsetting = TaxSetting::find($id);
        $taxsetting->tax_setting = $request->tax_setting;

        if($taxsetting->save()){
            flash(__('Tax Setting has been updated successfully'))->success();
            return redirect()->route('taxsetting.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    public function destroy($id)
    {
        //
    }
}
