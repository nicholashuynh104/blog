<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'cat_id',
        'title',
        'description',
        'cat_id',
        'image',
        'views'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'cat_id');
    }
}