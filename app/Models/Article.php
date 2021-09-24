<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Article extends Model
{
    use HasFactory, Notifiable;

    //protected $table = 'articles';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'filenames',
        'price',
        'category',
    ];

    function list() {
        $articles = Article::all();
        return view('articles.index', ['article' => $articles]);
    }

    function images() {
        return $this->hasMany(Image::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
