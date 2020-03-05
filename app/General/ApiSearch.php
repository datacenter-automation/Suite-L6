<?php

namespace App\General;

use Illuminate\Http\Request;
use App\Contracts\SearchContract;
use Illuminate\Support\Collection;

class ApiSearch implements SearchContract
{

    /**
     * @inheritDoc
     */
    public function fields(Request $request): Collection
    {
        // TODO: Implement fields() method.
    }

    /**
     * @inheritDoc
     */
    public function filter(Request $request): Collection
    {
        // TODO: Implement filter() method.
    }

    /**
     * @inheritDoc
     */
    public function paginate(Request $request): Collection
    {
        // TODO: Implement paginate() method.
    }

    /**
     * @inheritDoc
     */
    public function query(Request $request): Collection
    {
        // TODO: Implement query() method.
    }

    /**
     * @inheritDoc
     */
    public function sort(Request $request): Collection
    {
        // TODO: Implement sort() method.
    }

    /**
     * @inheritDoc
     */
    public function state(Request $request): Collection
    {
        // TODO: Implement state() method.
    }
}
