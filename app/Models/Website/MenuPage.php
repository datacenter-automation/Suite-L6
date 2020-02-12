<?php

namespace App\Models\Website;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Website\MenuPage
 *
 * @property int $id
 * @property string|null $text
 * @property string|null $route
 * @property string|null $url
 * @property string|null $target
 * @property string|null $icon
 * @property string|null $can
 * @property bool $isTitle
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Website\SubMenuPage[] $submenus
 * @property-read int|null $submenus_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website\MenuPage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website\MenuPage newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Website\MenuPage onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website\MenuPage query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website\MenuPage whereCan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website\MenuPage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website\MenuPage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website\MenuPage whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website\MenuPage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website\MenuPage whereIsTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel whereNotState($column, $states)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website\MenuPage whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel whereState($column, $states)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website\MenuPage whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website\MenuPage whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website\MenuPage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website\MenuPage whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Website\MenuPage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Website\MenuPage withoutTrashed()
 * @mixin \Eloquent
 */
class MenuPage extends BaseModel
{

    use SoftDeletes;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'isTitle' => 'bool',
    ];

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
        'isTitle',
    ];

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
        return 'menupage_index';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function submenus(): BelongsToMany
    {
        return $this->belongsToMany(SubMenuPage::class);
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
