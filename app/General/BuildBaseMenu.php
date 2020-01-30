<?php

namespace App\General;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class BuildBaseMenu extends ProcessMenu implements MenuBuilder
{

    /**
     * @var string
     */
    protected static string $baseIconSet = 'minus-square';

    /**
     * Output menu.
     *
     * @return array
     */
    public static function build(): array
    {
        return static::buildMenu()->toArray();
    }

    /**
     * Build menu structure.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function buildMenu(): Collection
    {
        $routes = static::filterRoutes(static::getAllUris());

        $routeTitles = static::unchunkRoutes($routes);

        static::$menu = static::prepareMenu($routeTitles, $routes);
        $menuWithoutIcons = static::rArrayMergeDistinct(self::buildTextForMenu(), self::buildUrlsForMenu());

        $icons = array_pad([], sizeof($routes), ['icon' => static::$baseIconSet]);

        return collect(static::rArrayMergeDistinct($menuWithoutIcons, $icons))->filter(fn ($value) => Arr::exists($value, 'id') ? $value : null);
    }
}
