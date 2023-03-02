<?php
namespace App\Helpers\Resolvers;
use Illuminate\Database\Eloquent\Model;

class ResolveModelFromRepository
{
    // extract model name from repository class name
    public static function resolve($repository) : Model
    {
        if(gettype($repository) === 'string') {
            $model = "App\Models\\".ucfirst($repository);
            $repository = new $model;
            return $repository->getModel();
        }
        $repository = get_class($repository);
        $repository = explode('\\', $repository);
        $repository = end($repository);
        $repository = str_replace('Repository', '', $repository);
        $repository = 'App\Models\\' . $repository;
        return new $repository;
    }
}
