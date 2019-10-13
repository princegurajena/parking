<?php
/** @noinspection MethodShouldBeFinalInspection */
/** @noinspection MissingParameterTypeDeclarationInspection */
namespace App\filters;


use App\filters\core\ModelFilter;
use Illuminate\Database\Eloquent\Builder;

class ParkingSpaceFilter extends ModelFilter
{

    protected  $equal = [
        'id'
    ];
    protected  $dates = [];
    protected  $range = [];
    protected  $sort = [
        'id'
    ];

    protected  $filters = [
        'search',
        'reserved',
        'occupied',
        'available'
    ];

    public function reserved(Builder $builder , $value ) : Builder {
        return $builder->whereNotNull('reserved_user_id');
    }

    public function occupied(Builder $builder , $value ) : Builder {
        return $builder->whereNotNull('occupied_user_id');
    }

    public function available(Builder $builder , $value ) : Builder {
        return $builder->whereNull(['reserved_user_id','occupied_user_id']);
    }

    /**
     * @param Builder $builder
     * @param mixed $value
     * @return Builder
     */

    public function search(Builder $builder , $value ) : Builder {

        return $builder->where(function (Builder $builder) use ($value) {

            $columns = [
                'name',
                'city',
                'road',
                'province',
                'country',
            ];

            foreach ($columns as $column)
            {
                $this->like($builder, $column, $value);
            }

        });
    }
}
