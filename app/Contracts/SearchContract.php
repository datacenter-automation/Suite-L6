<?php

namespace App\Contracts;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface SearchContract
{

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Support\Collection
     */
    public function sort(Request $request): Collection;

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Support\Collection
     */
    public function filter(Request $request): Collection;

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Support\Collection
     */
    public function state(Request $request): Collection;

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Support\Collection
     */
    public function query(Request $request): Collection;

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Support\Collection
     */
    public function fields(Request $request): Collection;

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Support\Collection
     */
    public function paginate(Request $request): Collection;
}
