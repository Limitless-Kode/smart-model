<?php


namespace Claver\SmartQuery\Traits;

use Claver\SmartQuery\Helpers\QueryHelperV2;
use Claver\SmartQuery\Helpers\Resolvers\ResolveModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

trait HasSmartQuery
{
    private function getModel(): Model
    {
        if (isset($this->model)) {
            return ResolveModel::resolve($this->model);
        }
        return ResolveModel::resolve($this);
    }


    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function resolve(): \Illuminate\Contracts\Pagination\LengthAwarePaginator|ResourceCollection
    {
        $hasPages = request()->has('page');
        $paginated = request()->has('per_page');
        $perPage = request()->get('per_page', 10);

        if($paginated || $hasPages) {
            return QueryHelperV2::queryBuilder($this->getModel())->paginate($perPage);
        }
        return new ResourceCollection(
            QueryHelperV2::queryBuilder($this->getModel())->get()
        );
    }

    public function getAllowedFilters(): array
    {
        return [];
    }

    public function getAllowedIncludes(): array
    {
        return [];
    }
}

