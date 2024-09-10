<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'de_categories';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'order',
        'is_default',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
