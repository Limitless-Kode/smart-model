<?php

namespace Claver\SmartQuery\Helpers;

use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class QueryHelperV2{

    /**
     * Create a new QueryBuilder instance for the specified model or class name.
     *
     * @param string|Model $class The model class name as a string or an existing model instance.
     *
     * @return Model|QueryBuilder|null The created QueryBuilder instance or null if the class is invalid.
     */
    public static function queryBuilder(Model|string $class): Model|QueryBuilder|null
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
