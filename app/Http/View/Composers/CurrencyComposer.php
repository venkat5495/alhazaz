<?php


namespace App\Http\View\Composers;


use Illuminate\View\View;

class CurrencyComposer
{
    public function compose(View $view){
        $view->with('currencies',\App\Currency::where('status', 1)->get());
        $view->with('categories',\App\Category::where('is_enable',1)->get());
    }
}
