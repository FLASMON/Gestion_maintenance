<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Categorie extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name', 'description', 'status', 'icon', 'order', 'is_featured', 'is_default'
    ];

//    public function posts()
//    {
//        return $this->belongsToMany(Post::class, 'post_categories');
//    }
}
