<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingGizi extends Model
{
    protected $table = 'setting_gizi';

    protected $fillable = [
        'nilai_rumus',
        'keterangan',
        'pesan'
    ];

    public $timestamps = true;

    use HasFactory;
}
