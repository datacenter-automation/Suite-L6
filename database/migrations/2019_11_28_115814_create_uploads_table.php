<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadsTable extends Migration
{

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uploads');
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->uuid('filename_uniqid');
            $table->bigIncrements('user_id');
            $table->string('filename');
            $table->json('file_attributes');
            $table->timestamp('encrypted_at')->nullable();
            $table->ipAddress('uploader_ip_address');
            $table->timestamps();
        });
    }
}
