<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRandomStringRiwayatGizi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('riwayat_cek_gizi', function (Blueprint $table) {
            $table->string("random_string")->default("");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('riwayat_cek_gizi', function (Blueprint $table) {
            $table->dropColumn("random_string");
        });
    }
}
