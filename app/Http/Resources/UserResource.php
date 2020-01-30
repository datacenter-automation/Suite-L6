<?php

namespace App\Http\Resources;

use Spatie\ResourceLinks\HasLinks;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    use HasLinks;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'                    => $this->id,
            'name'                  => $this->name,
            'email'                 => $this->email,
            'is_verified'           => (bool) $this->email_verified_at,
            'account_creation_date' => $this->created_at,
            'links'                 => $this->links(UserController::class),
        ];
    }

    //Route::get('/user/{user}', function ($user) {
    //    return new UserResource(User::findOrFail($user));
    //});
}
