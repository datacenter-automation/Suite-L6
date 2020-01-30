<?php

/**
 * @see https://medium.com/@sixlive/abstracting-request-keys-78a1c0df0997
 */
Request::macro('mapKeys', function ($keyMap) {
    collect($this->all())->each(function ($attribute, $key) use ($keyMap) {
            if (array_key_exists($key, $keyMap)) {
                $this->json->set($keyMap[$key], $attribute);
            }
        });

    return $this;
});
