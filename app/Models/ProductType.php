<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $table = 'de_products_types';

    protected $fillable = [
        'name',
        'slug',
        'order',
    ];
}
