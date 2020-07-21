<?php


namespace App\Http\View\Composers;


use Illuminate\View\View;

class CategoryComposer
{
    public function compose(View $view){
        $view->with('categories',\App\Category::where('is_enable',1)->get());
    }

}
