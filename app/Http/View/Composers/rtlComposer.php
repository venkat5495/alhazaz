<?php


namespace App\Http\View\Composers;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class rtlComposer
{
    public function compose(View $view){
        $view->with('lang',\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first());
    }
}
