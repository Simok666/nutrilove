<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $table = 'articles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "kode",
        "title",
        "desc_content",
        "file",
        "posted_by"
    ];

    public $timestamps = true;
    use HasFactory;
}
