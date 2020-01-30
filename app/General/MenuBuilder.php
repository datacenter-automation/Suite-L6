<?php

namespace App\General;

use Illuminate\Support\Collection;

interface MenuBuilder
{

    /**
     * Output menu.
     *
     * @return array
     */
    public static function build(): array;

    /**
     * Build menu structure.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function buildMenu(): Collection;
}
