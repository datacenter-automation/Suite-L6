<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuPagesTable extends Migration
{

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('menu_pages');
    }

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('menu_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text')->nullable();
            $table->string('route')->nullable();
            $table->string('url')->nullable();
            $table->enum('target', ['_blank', '_self', '_parent', '_top'])->nullable();
            $table->string('icon')->nullable();
            $table->string('can')->nullable();
            $table->boolean('isTitle')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }
}
