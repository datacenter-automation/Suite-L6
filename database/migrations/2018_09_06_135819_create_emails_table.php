<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration
{

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emails');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('message_id');
            $table->string('recipients');
            $table->json('sender');
            $table->json('from');
            $table->json('x_envelope_from');
            $table->json('subject');
            $table->json('body_plain');
            $table->json('stripped_text');
            $table->json('stripped_signature');
            $table->json('body_html');
            $table->json('stripped_html');
            $table->json('attachments');
            $table->json('message_headers');
            $table->json('content_id_map');
            $table->timestamp('attachments_synced')->nullable();
            $table->timestamps();

            $table->unique(['message_id', 'recipients']);
        });
    }
}
