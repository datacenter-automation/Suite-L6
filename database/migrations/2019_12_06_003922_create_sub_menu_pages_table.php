<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubMenuPagesTable extends Migration
{

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_menu_pages');
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_menu_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text')->nullable();
            $table->string('route')->nullable();
            $table->string('url')->nullable();
            $table->enum('target', ['_blank', '_self', '_parent', '_top'])->nullable();
            $table->string('icon')->nullable();
            $table->string('can')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }
}
