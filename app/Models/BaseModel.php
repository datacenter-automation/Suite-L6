<?php

namespace App\Models;

use Altek\Eventually\Eventually;
use App\Traits\Encryptable;
use Envant\EloquentLockable\Lockable;
use Envant\Fireable\FireableAttributes;
use Illuminate\Database\Eloquent\Model;
//use Illuminatech\DbSafeDelete\SafeDeletes;
use Laravel\Scout\Searchable;
use Spatie\ModelStates\HasStates;

/**
 * App\Models\BaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel query()
 * @mixin \Eloquent
 */
abstract class BaseModel extends Model
{

    use Encryptable, Eventually, FireableAttributes, HasStates, Lockable, Searchable;

    /**
     * The attributes that should be encrypted on save.
     *
     * @var array
     */
    protected array $encryptable = [];

    /**
     * @var array
     * @see https://github.com/envant/fireable
     */
    protected array $fireableAttributes = [];

    // Add the $table->lockable() to model migration

    /**
     * When is force-deleting allowed?
     *
     * @return bool
     */
    public function forceDeleteAllowed(): bool
    {
        return false;
    }

    abstract protected function registerStates(): void;

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    abstract public function searchableAs(): string;

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    abstract public function toSearchableArray(): array;
}
