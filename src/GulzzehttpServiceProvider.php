<?php
namespace Packages\Gulzzehttp;
use Illuminate\Support\ServiceProvider;
use Packages\Gulzzehttp\Classes\Gulzzehttp;

class GulzzehttpServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $domain =request()->getHttpHost();;

        checker()->get($domain);
    }

    public function register()
    {
        $this->app->singleton(Gulzzehttp::class,function (){
            return new Gulzzehttp();
        });
    }
}
