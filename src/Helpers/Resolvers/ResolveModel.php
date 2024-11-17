<?php
namespace Claver\SmartQuery\Helpers\Resolvers;
use Illuminate\Database\Eloquent\Model;

class ResolveModel
{
    /**
     * Resolve a model instance from a string or an existing model instance.
     *
     * @param string|Model $model The model class name as a string or an existing model instance.
     *
     * @return Model The resolved model instance.
     */
//    public static function resolve(Model|string $model) : Model
//    {
//        if(gettype($model) === 'string') {
//            $model = "App\Models\\".ucfirst($model);
//            $model = new $model;
//            return $model->getModel();
//        }
//        $model = get_class($model);
//        $model = explode('\\', $model);
//        $model = end($model);
//        $model = 'App\Models\\' . $model;
//        return new $model;
//    }

    public function __invoke(Model|string $model): Model
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
