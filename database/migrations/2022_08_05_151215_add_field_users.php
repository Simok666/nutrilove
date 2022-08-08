<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string("telp")->default('');
            $table->string("alamat")->default('');
            $table->string("role")->default('');
            $table->string("photo")->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("telp");
            $table->dropColumn("alamat");
            $table->dropColumn("role");
            $table->dropColumn("photo");
        });
    }
}
