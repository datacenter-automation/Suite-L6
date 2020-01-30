<?php

namespace App\General;

class ClickTracker
{

    /**
     * ClickTracker constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @return static
     */
    public static function run()
    {
        return new static;
    }
}
