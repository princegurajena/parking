<?php
/** @noinspection MethodShouldBeFinalInspection */
/** @noinspection MissingParameterTypeDeclarationInspection */
namespace App\filters;


use App\filters\core\ModelFilter;
use Illuminate\Database\Eloquent\Builder;

class RequestsFilter extends ModelFilter
{
    protected  $filters = [
        'search'
    ];
    protected  $equal = [
        'id',
        'user_id'
    ];
    protected  $dates = [];
    protected  $range = [];
    protected  $sort = [
        'id'
    ];

    /**
     * @param Builder $builder
     * @param mixed $value
     * @return Builder
     */

    public function search(Builder $builder , $value ) : Builder {

        return $builder->where(function (Builder $builder) use ($value) {

            $columns = [
            ];

            foreach ($columns as $column)
            {
                $this->like($builder, $column, $value);
            }

        });
    }
}
