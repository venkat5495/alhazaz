<?php


namespace App\Http\View\Composers;


use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class LanguageComposer
{
    public function compose(View $view){
//        dd(Cache::get('Currency'));
        $view->with('languages',Cache::get('Language')); //LanguageComposer
        $view->with('home_default_currency',Cache::get('Currency')->find(Cache::get('BusinessSetting')->where('type', 'home_default_currency')->first()->value)); //HomeDefaultCurrencyComposer
        $view->with('currencies',Cache::get('Currency')->where('status', 1)); //CurrencyComposer
        $view->with('categories',Cache::get('Category')->where('is_enable',1)); //CategoryComposer
        $view->with('brands',Cache::get('Brand')->where('is_enable',1)); //make BrandsComposer
        $view->with('generalsetting',Cache::get('GeneralSetting')->first()); //make BrandsComposer
    }
}
