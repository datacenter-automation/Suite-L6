<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Directory where generated files will be written
     |--------------------------------------------------------------------------
     |
     | SECURITY: For obvious reasons, setting this option to any path within your
     | public_path() directory will be a really bad idea.
     |
     | Default: app_path('database/schema')
     |
     */
    'output'     => base_path('database/schema'),

    /*
     |--------------------------------------------------------------------------
     | Base command to run schemaSpy.jar on your system
     |--------------------------------------------------------------------------
     |
     | Do not provide SchemaSpy parameters here, instead use the 'parameters' array below!
     |
     | Default: java -jar schemaSpy.jar
     |
     */
    'command'    => 'java -jar schemaSpy_5.0.0.jar',

    /*
    |--------------------------------------------------------------------------
    | Extra parameters to pass to the command
    |--------------------------------------------------------------------------
    |
    | Database connection settings will be read form Laravel's database config
    | file but they can be overridden here.
    |
    | Full list of possible parameters: http://schemaspy.sourceforge.net/
    |
    */
    'parameters' => [
        '-t'  => 'mysql',
        '-dp' => '/home/alexrenner/Code/dcas-l6',
        '-u'  => config('database.connections.mysql.username'),
        '-p'  => config('database.connections.mysql.password'),
        '-db' => config('database.connections.mysql.database'),
        '-hq' => null,
    ],
];
