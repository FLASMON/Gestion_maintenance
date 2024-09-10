<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'de_reviews';

    protected $fillable = [
        'account_id',
        'reviewable_id',
        'reviewable_type',
        'star',
        'comment',
        'status',
    ];

    public function reviewable()
    {
        return $this->morphTo();
    }
}
