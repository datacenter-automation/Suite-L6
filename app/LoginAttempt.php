<?php

namespace App;

use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * App\LoginAttempt
 *
 * @property int $id
 * @property string $email
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoginAttempt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoginAttempt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoginAttempt query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoginAttempt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoginAttempt whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoginAttempt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel whereNotState($field, $states)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel whereState($field, $states)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoginAttempt whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoginAttempt whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LoginAttempt extends BaseModel
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'token',
    ];

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->hasOne(User::class, 'email', 'email');
    }

    /**
     * @param $token
     *
     * @return mixed|null
     */
    public static function userFromToken($token)
    {
        $query = self::where('token', $token)->where('created_at', '>', Carbon::parse('-15 minutes'))->first();

        return $query->user ?? null;
    }

    protected function registerStates(): void
    {
        return;
    }

    /**
     * @inheritDoc
     */
    public function searchableAs(): string
    {
        return 'login_attempt_index';
    }

    /**
     * @inheritDoc
     */
    public function toSearchableArray(): array
    {
        return $this->toArray();
    }
}
