<?php

namespace App\Blog;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'blog_images';

    protected $fillable = ['title', 'thumbnail', 'original'];
}
