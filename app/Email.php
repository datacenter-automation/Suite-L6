<?php

namespace App;

use BeyondCode\Mailbox\InboundEmail;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Email
 *
 * @property int $id
 * @property string $message_id
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Email extends InboundEmail
{

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
