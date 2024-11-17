<?php

namespace Claver\SmartQuery\Providers;

use Claver\SmartQuery\Traits\HasSmartQuery;
use Illuminate\Support\ServiceProvider;
use Claver\SmartQuery\Helpers\Resolvers\ResolveModel;

class SmartQueryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        foreach ($this->getModelClasses() as $modelClass) {
            $this->app->singleton($modelClass . 'Resolver', function ($app) use ($modelClass) {
                return ResolveModel::resolve(new $modelClass);
            });
        }
    }

    public function register()
    {
        //
    }

    protected function getModelClasses(): array
    {
        $classes = [];

        foreach (get_declared_classes() as $class) {
            if (in_array(HasSmartQuery::class, class_uses($class))) {
                $classes[] = $class;
            }
        }

        return $classes;
    }
}
