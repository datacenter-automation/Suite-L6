<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class FileUploaded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var mixed|string
     */
    public string $file;

    /**
     * Create a new event instance.
     *
     * @param mixed $file
     *
     * @return void
     */
    public function __construct($file)
    {
        $this->file = $file;
    }
}
