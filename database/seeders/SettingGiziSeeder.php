<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingGiziSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting_gizi')->insert([
            [
                "nilai_rumus"   => "0",
                "keterangan"    => "Berat badan kurang (underweight)",
                "pesan"         => "Besti....berat badan kamu kurang nih! Yuk tingkatkan dengan konsumsi makanan bergizi
                seimbang sesuai isi piringku"
            ],
            [
                "nilai_rumus"   => "18.5",
                "keterangan"    => "Berat badan normal",
                "pesan"         => "Berat badan kamu normal, Besti! Pertahankan ya!"
            ],
            [
                "nilai_rumus"   => "23",
                "keterangan"    => "Kelebihan berat badan (overweight) dengan risiko",
                "pesan"         => "Hati-hati...berat badan kamu berisiko berlebih nih! Perhatikan pola makanmu ya!"
            ],
            [
                "nilai_rumus"   => "25",
                "keterangan"    => "Obesitas I",
                "pesan"         => "Besti, kamu sudah tergolong obesitas tingkat 1....perbaiki pola makan dan hubungi ahli
                gizi ya untuk membantumu mengatur pola makan!"
            ],
            [
                "nilai_rumus"   => "30",
                "keterangan"    => "BObesitas II",
                "pesan"         => "Besti, kamu sudah tergolong obesitas tingkat 2....perbaiki pola makan dan hubungi ahli
                gizi ya untuk membantumu mengatur pola makan!"
            ]
        ]);

    }
}
