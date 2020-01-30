<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuPageSubMenuPagePivotTable extends Migration
{

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_page_sub_menu_page');
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_page_sub_menu_page', function (Blueprint $table) {
            $table->integer('menu_page_id')->unsigned()->index();
            $table->integer('sub_menu_page_id')->unsigned()->index();

            $table->foreign('menu_page_id')->references('id')->on('menu_pages')->onDelete('cascade');
            $table->foreign('sub_menu_page_id')->references('id')->on('sub_menu_pages')->onDelete('cascade');

            $table->primary(['menu_page_id', 'sub_menu_page_id']);
        });
    }
}
