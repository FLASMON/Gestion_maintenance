<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MediaFile extends Model
{
    use HasFactory;

    protected $table = 'media_files';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = ['file_name', 'file_path', 'type', 'size', 'folder_id'];

    public function folder(): BelongsTo
    {
        return $this->belongsTo(MediaFolder::class, 'id', 'folder_id');
    }
}
