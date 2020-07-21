<?php


namespace App\Http\View\Composers;


use Illuminate\View\View;

class HomeDefaultCurrencyComposer
{
    public function compose(View $view){
        $view->with('home_default_currency',\App\Currency::findOrFail(\App\BusinessSetting::where('type', 'home_default_currency')->first()->value));
    }

}
