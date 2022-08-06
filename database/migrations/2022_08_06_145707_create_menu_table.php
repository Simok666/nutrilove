<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id')->first();
            $table->char('title',255);
            $table->char('name',50);
            $table->char('icon',50);
            $table->char('function',50);
            $table->char('color',50);
            $table->char('url',50)->unsigned()->nullable();
            $table->char('view',50);
            $table->boolean('newtab')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
