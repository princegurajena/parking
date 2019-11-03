<?php /** @noinspection PhpUnusedParameterInspection */
/** @noinspection PhpUnusedPrivateMethodInspection */
/** @noinspection MissingParameterTypeDeclarationInspection */

/** @noinspection MethodShouldBeFinalInspection */


namespace App\filters\core;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class ModelFilter
{
    /**
     * @var Request
     */

    protected $request;

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */

    protected $filters = [];
    protected $equal = [];
    protected $dates = [];
    protected $range = [];
    protected $sort = [];
    protected $search = [];
    protected $defaults = ['sort', 'range'];

    /**
     * Create a new ThreadFilters instance.
     *
     * @param Request $request
     */

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply the filters.
     *
     * @param Builder $builder
     * @param array $overrides
     * @return Builder
     */

    public function apply(Builder $builder, array $overrides): Builder
    {

        foreach (array_merge($this->filters, $this->equal, $this->defaults) as $filter) {

            $builder = isset($overrides[$filter]) ?
                $this->run($builder, $filter, $overrides[$filter])
                : $builder;

            $builder = $this->request->get($filter) ?
                $this->run($builder, $filter, $this->request->get($filter))
                : $builder;
        }

        return $builder;
    }

    /**
     * @param Builder $builder
     * @param string $column
     * @param string $value
     * @return Builder
     */

    private function equal(Builder $builder, string $column, string $value): Builder
    {
        $split = explode('.', $column);

        if (count($split) > 1) {
            return $builder->whereHas($split[0], function (Builder $builder) use ($value, $split) {
                $builder->where($split[1], "=", $value);
            });
        }

        return $builder->where($column, "=", $value);
    }

    private function in(Builder $builder, string $column, array $value): Builder
    {
        $split = explode('.', $column);

        if (count($split) > 1) {
            return $builder->whereHas($split[0], function (Builder $builder) use ($value, $split) {
                $builder->whereIn($split[1], "=", $value);
            });
        }

        return $builder->whereIn($column, $value);
    }

    /** @noinspection MethodVisibilityInspection */
    /**
     * @param Builder $builder
     * @param $value
     * @return Builder
     */
    protected function search(Builder $builder, $value): Builder
    {
        $builder = $builder->where(function (Builder $builder) use ($value) {

            foreach ($this->search as $column)
            {
                $split = explode('.', $column);

                if (count($split) > 1)
                {
                    $builder->whereHas($split[0], function (Builder $builder) use ($value , $split) {
                        $this->like($builder , $split[1] ,$value);
                    });
                    continue;
                }

                $this->like($builder, $column, $value);
            }

        });

        return $builder;
    }

    /**
     * @param Builder $builder
     * @param string $value
     * @return mixed
     */
    private function range(Builder $builder, string $value): Builder
    {
        // full range=created,45-345
        // $value = created,45-345
//        if (is_string($value)) {
//            $d = explode(",", $value);
//            if (count($d) == 2) {
//                if (in_array($d[0] , $this->range )){
//                     // TODO : range
//                }
//            }
//        }
        return $builder;
    }

    /**
     * @param Builder $builder
     * @param string $value
     * @return Builder
     */

    private function sort(Builder $builder, $value): Builder
    {

        // $value = created_at,desc

        if (is_string($value)) {
            $d = explode(",", $value);
            if (count($d) == 2) {
                return $builder = $builder->orderBy(
                    $d[0],
                    in_array(strtolower($d[1]), ['desc', 'asc']) ? strtolower($d[1]) : 'desc'
                );
            }
        }

        return $builder;
    }

    /**
     * @param Builder $builder
     * @param string $filter
     * @param $value
     * @return Builder
     */

    private function run(Builder $builder, string $filter, $value): Builder
    {

        if ($value == null || trim($value) === '') {
            return $builder;
        }

        if (in_array($filter, $this->equal)) {
            $builder = is_array($value) ?
                $this->in($builder, $filter, $value) :
                $this->equal($builder, $filter, $value);
        }

        if (method_exists($this, $filter)) {
            $builder = $this->$filter($builder, $value);
        }

        return $builder;
    }

    /**
     * @param Builder $builder
     * @param $column
     * @param $value
     */
    public function like(Builder $builder, $column, $value): void
    {
        $builder->orWhere($column, 'like', "%{$value}%");
    }
}
