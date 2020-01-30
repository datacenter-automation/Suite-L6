<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoggerTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logger', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('method');
            $table->string('controller');
            $table->string('action');
            $table->json('parameter');
            $table->json('headers');
            $table->string('origin_ip_address');
            $table->string('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logger');
    }
}
