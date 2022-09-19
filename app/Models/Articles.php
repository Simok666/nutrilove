<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ArticleCategory;
use App\Models\User;

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
        "user_id",
        "id_category"
    ];

    public $timestamps = true;
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class, "id_category", "id");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->belongsTo(ArticleCategory::class, "id_category", "id");
    }
}
