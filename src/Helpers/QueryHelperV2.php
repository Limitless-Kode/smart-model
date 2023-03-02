<?php

namespace Claver\SmartQuery\Helpers;

use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class QueryHelperV2{

    public static function queryBuilder($class): Model|QueryBuilder|null
    {
        $model = false;
        if(gettype($class) === 'string'){
            $model = new $class;
        } elseif(gettype($class) === 'object'){
            $model = $class;
        }
        return QueryBuilder::for($class)
            ->allowedIncludes($model ? [...$model->getAllowedIncludes()] : [])
            ->allowedSorts($model ?
                [...$model->getFillable(), ...$model->getVisible(), ...$model->getHidden(), ...$model->getAllowedSorts(), 'created_at'] : [])
            ->allowedFilters($model ? $model->getAllowedFilters() : []);
    }
}
