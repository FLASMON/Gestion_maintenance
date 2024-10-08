<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    use HasFactory;

    protected $table= 'media_files';
    protected $fillable = ['file_name', 'folder_id'];

    public function folder()
    {
        return $this->belongsTo(MediaFolder::class, 'folder_id');
    }
}
