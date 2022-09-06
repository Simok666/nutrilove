<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatCekGizi extends Model
{
    protected $table = 'riwayat_cek_gizi';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nama',
        'jenis_kelamin',
        'usia',
        'tb',
        'bb',
        'email'
    ];

    public $timestamps = true;

    use HasFactory;
}
