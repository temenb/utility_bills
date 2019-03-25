<?php

namespace App\Models\Entities\Traits\Active;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class EnabledScope implements Scope
{
    /**
     * All of the extensions to be added to the builder.
     *
     * @var array
     */
    protected $extensions = ['Disable', 'Enable', 'WithDisabled', 'OnlyDisabled', 'OnlyEnabled'];

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->where($model->getQualifiedEnabledColumn(), '=', '1');
    }

    /**
     * Extend the query builder with the needed functions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    public function extend(Builder $builder)
    {
        foreach ($this->extensions as $extension) {
            $this->{"add{$extension}"}($builder);
        }
    }

    /**
     * Add the disable extension to the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    protected function addDisable(Builder $builder)
    {
        $builder->macro('disable', function (Builder $builder) {

            return $builder->update([$builder->getModel()->getQualifiedEnabledColumn() => 0]);
        });
    }

    /**
     * Add the enable extension to the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    protected function addEnable(Builder $builder)
    {
        $builder->macro('enable', function (Builder $builder) {
            $builder->withDisabled();

            return $builder->update([$builder->getModel()->getQualifiedEnabledColumn() => 1]);
        });
    }

    /**
     * Add the with-trashed extension to the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    protected function addWithDisabled(Builder $builder)
    {
        $builder->macro('withDisabled', function (Builder $builder) {
            return $builder->withoutGlobalScope($this);
        });
    }

    /**
     * Add the without-trashed extension to the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    protected function addOnlyEnabled(Builder $builder)
    {
        $callback = function (Builder $builder) {
            $model = $builder->getModel();

            $builder->withoutGlobalScope($this)->where(
                $model->getQualifiedEnabledColumn(),
                '=',
                1
            );

            return $builder;
        };
        $builder->macro('onlyEnabled', $callback);
        $builder->macro('withoutDisabled', $callback);
    }

    /**
     * Add the only-trashed extension to the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    protected function addOnlyDisabled(Builder $builder)
    {
        $callback = function (Builder $builder) {
            $model = $builder->getModel();

            $builder->withoutGlobalScope($this)->where(
                $model->getQualifiedEnabledColumn(),
                '=',
                0
            );

            return $builder;
        };
        $builder->macro('onlyDisabled', $callback);
        $builder->macro('withoutEnabled', $callback);
    }
}
