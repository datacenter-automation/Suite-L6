<?php

namespace App\Models\Website;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Website\SubMenuPage
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Website\MenuPage[] $menus
 * @property-read int|null $menus_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website\SubMenuPage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website\SubMenuPage newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Website\SubMenuPage onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website\SubMenuPage query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel whereNotState($column, $states)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel whereState($column, $states)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Website\SubMenuPage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Website\SubMenuPage withoutTrashed()
 * @mixin \Eloquent
 */
class SubMenuPage extends BaseModel
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text',
        'route',
        'url',
        'target',
        'icon',
        'can',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(MenuPage::class);
    }

    /**
     * Return resource path.
     *
     * @return string
     */
    public function path(): string
    {
        return null;
    }

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs(): string
    {
        return 'submenupage_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray(): array
    {
        return $this->toArray();
    }

    protected function registerStates(): void
    {
        ;
    }
}
