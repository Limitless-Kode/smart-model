<?php

namespace Limitless\SmartQuery;

use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class SmartModel extends Model
{
    /**
     * Field to be used for sorting and date queries
     * @var mixed|string
     */
    protected string $scopeDateField = 'created_at';

    /**
     * Returns a list of allowed includes either as a string or Spatie Query Builder helper methods
     * @return array
     */
    public function getAllowedIncludes(): array
    {
        return [];
    }

    /**
     * Returns a list of allowed filters either as a string or Spatie Query Builder helper methods
     * @return array
     */
    public function getAllowedFilters(): array
    {
        return [];
    }

    /**
     * @return Model|QueryBuilder|null
     */
    public function smartQuery(): Model|QueryBuilder|null
    {
        return QueryBuilder::for($this)
            ->allowedIncludes([...$this->getAllowedIncludes()])
            ->allowedSorts([...$this->getFillable(), ...$this->getVisible(), ...$this->getHidden(), $this->scopeDateField])
            ->allowedFilters($this->getAllowedFilters());
    }

    protected function scopeCreatedAt($query, $value)
    {
        return $query->whereDate($this->scopeDateField, $value);
    }

    protected function scopeCreatedBetween($query, $from, $to)
    {
        return $query->whereDate($this->scopeDateField, '>=', $from)->whereDate($this->scopeDateField, '<=', $to);
    }
}
