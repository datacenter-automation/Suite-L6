<?php

namespace App\Traits;

trait Lockable
{

    public function getLockoutTime()
    {
        return $this->lockout_time;
    }

    public function hasLockoutTime()
    {
        return $this->getLockoutTime() > 0;
    }
}
