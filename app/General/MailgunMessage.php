<?php

namespace App\General;

class MailgunMessage
{

    protected $message_id;

    protected $recipients;

    protected $sender;

    protected $from;

    protected $x_envelope_from;

    protected $subject;

    protected $body_plain;

    protected $stripped_text;

    protected $stripped_signature;

    protected $body_html;

    protected $stripped_html;

    protected $attachments;

    protected $message_headers;

    protected $content_id_map;

    /**
     * MailgunMessage constructor.
     *
     * @param $message_id
     * @param $recipients
     * @param $sender
     * @param $from
     * @param $x_envelope_from
     * @param $subject
     * @param $body_plain
     * @param $stripped_text
     * @param $stripped_signature
     * @param $body_html
     * @param $stripped_html
     * @param $attachments
     * @param $message_headers
     * @param $content_id_map
     */
    public function __construct(
        $message_id,
        $recipients,
        $sender,
        $from,
        $x_envelope_from,
        $subject,
        $body_plain,
        $stripped_text,
        $stripped_signature,
        $body_html,
        $stripped_html,
        $attachments,
        $message_headers,
        $content_id_map
    ) {
        $this->message_id = $message_id;
        $this->recipients = $recipients;
        $this->sender = $sender;
        $this->from = $from;
        $this->x_envelope_from = $x_envelope_from;
        $this->subject = $subject;
        $this->body_plain = $body_plain;
        $this->stripped_text = $stripped_text;
        $this->stripped_signature = $stripped_signature;
        $this->body_html = $body_html;
        $this->stripped_html = $stripped_html;
        $this->attachments = $attachments;
        $this->message_headers = $message_headers;
        $this->content_id_map = $content_id_map;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'message_id'         => $this->message_id,
            'recipients'         => json_encode($this->recipients),
            'sender'             => json_encode($this->sender),
            'from'               => json_encode($this->from),
            'x_envelope_from'    => json_encode($this->x_envelope_from),
            'subject'            => json_encode($this->subject),
            'body_plain'         => json_encode($this->body_plain),
            'stripped_text'      => json_encode($this->stripped_text),
            'stripped_signature' => json_encode($this->stripped_signature),
            'body_html'          => json_encode($this->body_html),
            'stripped_html'      => json_encode($this->stripped_html),
            'attachments'        => json_encode($this->attachments),
            'message_headers'    => json_encode($this->message_headers),
            'content_id_map'     => json_encode($this->content_id_map),
        ];
    }
}
