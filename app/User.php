<?php

namespace App;

use App\Traits\Lockable;
use Biscolab\LaravelAuthLog\Traits\AuthLoggable;
use DateTime;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Cashier\Billable;
use Laravel\Scout\Searchable;
use Spatie\Permission\Traits\HasRoles;
use Thomasjohnkane\Snooze\Traits\SnoozeNotifiable;
use williamcruzme\FCM\Traits\HasDevices;

/**
 * App\User
 *
 * @property-read \Biscolab\LaravelAuthLog\Models\AuthLog $current_auth_log
 * @property-read \Illuminate\Database\Eloquent\Collection|\williamcruzme\FCM\Device[] $devices
 * @property-read int|null $devices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Biscolab\LaravelAuthLog\Models\AuthLog[] $forced_logouts
 * @property-read int|null $forced_logouts_count
 * @property-read string $created_at
 * @property-read mixed $session_is_active
 * @property-read \Illuminate\Database\Eloquent\Collection|\Biscolab\LaravelAuthLog\Models\AuthLog[] $logins
 * @property-read int|null $logins_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Biscolab\LaravelAuthLog\Models\AuthLog[] $logouts
 * @property-read int|null $logouts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Biscolab\LaravelAuthLog\Models\AuthLog[] $logs
 * @property-read int|null $logs_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Cashier\Subscription[] $subscriptions
 * @property-read int|null $subscriptions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User role($roles, $guard = null)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{

    use AuthLoggable, Billable, HasDevices, HasRoles, Impersonate, Lockable, Notifiable, Searchable, SnoozeNotifiable;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'blocked_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'password',
        'api_token',
        'remember_token',
    ];

    /**
     * @param mixed $value
     *
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format(DateTime::ISO8601);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
