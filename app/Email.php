<?php

namespace App;

//use BeyondCode\Mailbox\InboundEmail;
use App\General\MailgunRetrieveAttachments;
use App\General\MailgunRetrieveMessages;
use App\Traits\ManipulateEmailData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Email
 *
 * @method static Builder|Email newModelQuery()
 * @method static Builder|Email newQuery()
 * @method static Builder|Email query()
 * @mixin \Eloquent
 */
class Email extends Model
{

    use ManipulateEmailData;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected array $attachment = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'recipients'         => 'array',
        'sender'             => 'array',
        'from'               => 'array',
        'x_envelope_from'    => 'array',
        'subject'            => 'array',
        'body_plain'         => 'array',
        'stripped_text'      => 'array',
        'stripped_signature' => 'array',
        'body_html'          => 'array',
        'stripped_html'      => 'array',
        'attachments'        => 'array',
        'message_headers'    => 'array',
        'content_id_map'     => 'array',
    ];

    /**
     * @return \App\Email|null
     */
    public function attachments()
    {
        if (empty(json_decode($this->attachments, true))) {
            return null;
        }

        $this->attachment = [
            'id'           => $this->id,
            'name'         => json_decode($this->attachments, true)[0]["name"],
            'url'          => json_decode($this->attachments, true)[0]["url"],
            'size'         => round(((integer) json_decode($this->attachments, true)[0]["size"]) / 1024, 2),
            'content-type' => json_decode($this->attachments, true)[0]["content-type"],
        ];

        return new self($this->attachment);
    }

    public static function importEmailAndAttachments()
    {
        MailgunRetrieveMessages::get()->messages()->convert()->sendToDatabase();

        MailgunRetrieveAttachments::get();
    }
}
