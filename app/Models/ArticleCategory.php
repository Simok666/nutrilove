<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $table = 'article_category';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "kode",
        "nama",
        "is_show_navbar"
    ];

    public $timestamps = true;
    use HasFactory;

    function articles()
    {
        return $this->hasMany(\App\Models\Articles::class, 'id_category', 'id');
    }
}
