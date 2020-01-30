<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

trait Encryptable
{

    public static function bootEncryptable()
    {
        static::retrieved(function (Model $model) {
            foreach ($model->encryptable as $key) {
                $value = $model->getAttribute($key);
                $model[$key] = Crypt::decrypt($value);
            }
        });

        static::saving(function ($model) {
            foreach ($model->encryptable as $key) {
                $value = $model->getAttribute($key);
                $model[$key] = Crypt::encrypt($value);
            }
        });
    }
}
