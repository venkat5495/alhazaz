<?php

namespace App\Providers;

use App\BusinessSetting;
use App\Currency;
use App\Http\View\Composers\CategoryComposer;
use App\Http\View\Composers\CurrencyComposer;
use App\Http\View\Composers\HomeDefaultCurrencyComposer;
use App\Http\View\Composers\LanguageComposer;
use App\Http\View\Composers\rtlComposer;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
//use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Schema::defaultStringLength(191);
      Session::put('locale', 'sa');

      //indexpage(---AdvertBanner,Product,FlashDeal,FlashDealProduct---),header(---BusinessSetting,Language,Brand,Category,Currency,FeatureBrand---)
      //footer(---GeneralSetting,Policy ---)
      Cache::forget('BusinessSetting'); // use in helper function
      $BusinessSetting = Cache::rememberForever('BusinessSetting',function () {
          return BusinessSetting::all();
      });
//      $this->app['config']->set('global.BusinessSetting', Cache::get('BusinessSetting'));

      Cache::forget('Language'); // use in helper function
      $Language = Cache::rememberForever('Language',function () {
          return \App\Language::all();
      });
//      $this->app['config']->set('global.languages', Cache::get('Language'));

      Cache::forget('Currency'); // use in helper function
      $Currency = Cache::rememberForever('Currency',function () {
          return Currency::all();
      });
//      $this->app['config']->set('global.Currency', Cache::get('Currency'));
      Cache::forget('Category'); // use in helper function
      $Category = Cache::rememberForever('Category',function () {
          return \App\Category::with('subcategories.subsubcategories')->orderBy('orders','ASC')->get();
      });

      Cache::forget('Brand'); // use in helper function
      $Brand = Cache::rememberForever('Brand',function () {
          return \App\Brand::get();
      });

      Cache::forget('GeneralSetting'); // use in helper function
      $GeneralSetting = Cache::rememberForever('GeneralSetting',function () {
          return \App\GeneralSetting::get();
      });

      Cache::forget('Policy'); // use in helper function
      $Policy = Cache::rememberForever('Policy',function () {
          return \App\Policy::get();
      });

      Cache::forget('FeatureBrand'); // use in helper function
      $FeatureBrand = Cache::rememberForever('FeatureBrand',function () {
          return \App\FeatureBrand::orderBy('orders')->get();
      });

      View::composer('frontend/layouts/app',LanguageComposer::class);

  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
      //option 2
      /*if (!$this->app->isLocal()) {
          \Debugbar::disable();
      }*/
  }
}
