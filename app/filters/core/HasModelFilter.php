<?php
/** @noinspection PhpUnused */
namespace App\filters\core;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait HasModelFilter
 * @method static Builder filter( ModelFilter $filter, array $overrides )
 */

trait HasModelFilter
{
    /** @noinspection MethodShouldBeFinalInspection */
    /**
     * @param Builder $query
     * @param ModelFilter $filters
     * @param array $overrides
     * @return Builder
     */
    public function scopeFilter(Builder $query, ModelFilter $filters, array $overrides = [] ): Builder
    {
        return $filters->apply($query, $overrides);
    }
}
