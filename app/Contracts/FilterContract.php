<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface FilterContract
{

    /**
     * Apply a given search value to the builder instance.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param                                       $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function apply(Builder $builder, $value): Builder;
}
