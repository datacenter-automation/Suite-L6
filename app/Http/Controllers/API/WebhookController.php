<?php

namespace App\Http\Controllers\API;

use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class WebhookController extends CashierController
{
    /**
     * @return bool
     */
    public function __invoke()
    {
        return false;
    }
}
