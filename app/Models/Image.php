<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = "images";

    protected $fillable = [
        'user_id',
        'article_id',
        'image',
    ];

    public function post() {
        return $this->belongsTo(Article::class);
    }
}
