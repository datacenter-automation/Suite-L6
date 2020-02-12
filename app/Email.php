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
 * @property int $id
 * @property string $message_id
 * @property array $recipients
 * @property array $sender
 * @property array $from
 * @property array $x_envelope_from
 * @property array $subject
 * @property array $body_plain
 * @property array $stripped_text
 * @property array $stripped_signature
 * @property array $body_html
 * @property array $stripped_html
 * @property array $attachments
 * @property array $message_headers
 * @property array $content_id_map
 * @property string|null $attachments_synced
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereAttachments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereAttachmentsSynced($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereBodyHtml($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereBodyPlain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereContentIdMap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereMessageHeaders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereRecipients($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereSender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereStrippedHtml($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereStrippedSignature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereStrippedText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereXEnvelopeFrom($value)
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
