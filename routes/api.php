<?php

use App\Exceptions\Api\ResourceNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
 * @todo tweak this route to exclude development routes.
 */
Route::get('/', fn(Router $router) => collect($router->getRoutes()->getRoutesByMethod()['GET'])->map(fn(
    $value,
    $key
) => url($key))->values());

Route::post('/stripe/webhook', '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook');

Route::get('user/invoice/{invoice}', fn(Request $request, $invoiceId) => $request->user()->downloadInvoice($invoiceId, [
    'vendor' => config('datacenter-automation-suite.company_name'),
]));

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::get('testing-api', function () {
    return ['status' => 'success'];
})->middleware(['etag']);

Route::fallback(function () {
    throw new ResourceNotFoundException();
})->name('api.fallback.404');
