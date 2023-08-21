<?php

namespace App\Providers;

use App\Modules\Services\Guardian\Guardian;
use App\Modules\Services\NewsAPI\NewsAPI;
use App\Modules\Services\NewYorkTimes\NewYorkTimes;
use Illuminate\Support\ServiceProvider;

class ApisServiceProvider extends ServiceProvider {

    public function boot()
    {
        // 
    }

    public function register()
    {
        $this->app->singleton('newsapi', function()
        {
            return new NewsAPI();
        });

        $this->app->singleton('guardian', function()
        {
            return new Guardian();
        });

        $this->app->singleton('new_york_times', function()
        {
            return new NewYorkTimes();
        });
    }

}