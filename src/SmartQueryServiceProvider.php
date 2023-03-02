<?php

namespace Claver\SmartQuery;

use Illuminate\Foundation\AliasLoader;

class SmartQueryServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        AliasLoader::getInstance()->alias('SmartModel', \Claver\SmartQuery\Facades\SmartModelFacade::class);
    }
    public function register()
    {
        $this->app->bind('smart-model', function () {
            return new SmartModel();
        });
    }
}
