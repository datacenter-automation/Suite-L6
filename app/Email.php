<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Email
 *
 * @property int $id
 * @property string $subject
 * @property string $sender
 * @property string $to
 * @property string|null $cc
 * @property string|null $bcc
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereBcc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereCc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereSender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Email extends Model
{

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
