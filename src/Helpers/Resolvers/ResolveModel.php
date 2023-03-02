<?php
namespace Claver\SmartQuery\Helpers\Resolvers;
use Illuminate\Database\Eloquent\Model;

class ResolveModel
{
    public static function resolve($model) : Model
    {
        if(gettype($model) === 'string') {
            $model = "App\Models\\".ucfirst($model);
            $model = new $model;
            return $model->getModel();
        }
        $model = get_class($model);
        $model = explode('\\', $model);
        $model = end($model);
        $model = 'App\Models\\' . $model;
        return new $model;
    }
}
