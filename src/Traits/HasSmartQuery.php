<?php


namespace Claver\SmartQuery\Traits;

use Claver\SmartQuery\Helpers\QueryHelperV2;
use Claver\SmartQuery\Helpers\Resolvers\ResolveModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

trait HasSmartQuery
{
    /**
     * Get the model instance associated with the current instance of the trait.
     *
     * @return Model The model instance.
     */
    private static function getModel(): Model
    {
        if (isset(static::$model)) {
            return (new ResolveModel)(static::$model);
        }
        return (new ResolveModel)(new static());
    }

    /**
     * Resolve a collection of results based on the current query parameters.
     *
     * @return LengthAwarePaginator|ResourceCollection The resolved results as a paginator or a collection.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function resolve(): LengthAwarePaginator|ResourceCollection
    {
        $hasPages = request()->has('page');
        $paginated = request()->has('per_page');
        $perPage = request()->get('per_page', 10);

        if($paginated || $hasPages) {
            return QueryHelperV2::queryBuilder(static::getModel())->paginate($perPage);
        }
        return new ResourceCollection(
            QueryHelperV2::queryBuilder(static::getModel())->get()
        );
    }

    /**
     * Get an array of allowed filter keys for the current model.
     *
     * @return array The allowed filter keys.
     */
    public function getAllowedFilters(): array
    {
        return [];
    }

    /**
     * Get an array of allowed include relationships for the current model.
     *
     * @return array The allowed include relationships.
     */
    public function getAllowedIncludes(): array
    {
        return [];
    }

    /**
     * Get an array of allowed sort keys for the current model.
     *
     * @return array The allowed sort keys.
     */
    public function getAllowedSorts(): array
    {
        return [];
    }
}
