<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
    ];

//    public function posts()
//    {
//        return $this->belongsToMany(Post::class, 'post_tag');
//    }
}
