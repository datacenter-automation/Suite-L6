<?php

namespace App;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Logger
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Logger guest()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Logger loggedIn()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Logger newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Logger newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Logger query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel whereNotState($column, $states)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel whereState($column, $states)
 * @mixin \Eloquent
 */
class Logger extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'logger';

    /**
     * The attributes that should be encrypted on save.
     *
     * @var array
     */
    protected array $encryptable = ['controller', 'method', 'action', 'origin_ip_address', 'user'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['controller', 'method', 'action', 'parameter', 'headers', 'origin_ip_address', 'user'];

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGuest(Builder $query): Builder
    {
        return $query->where('user', '=', 'Guest');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLoggedIn(Builder $query): Builder
    {
        return $query->where('user', '!=', 'Guest');
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
        return 'logger_index';
    }

    /**
     * @inheritDoc
     */
    public function toSearchableArray(): array
    {
        return $this->toArray();
    }
}
