<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatCekGizi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_cek_gizi', function (Blueprint $table) {
            $table->id();
            $table->string("user_id");
            $table->string("nama");
            $table->string("jenis_kelamin");
            $table->string("usia");
            $table->string("bb");
            $table->string("tb");
            $table->string("email");
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
        Schema::dropIfExists('riwayat_cek_gizi');
    }
}
