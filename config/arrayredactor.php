<?php

return [

    /**
     * The array keys to redact
     */
    'keys' => [
        'password',
        'api_key',
    ],

    /*
     * What you will replace redacted content with
     */
    'ink'  => '[REDACTED]',

];
