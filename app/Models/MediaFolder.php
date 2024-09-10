<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MediaFolder extends Model
{
    use HasFactory;

    protected $table = 'media_folders';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = ['folder_name','parent_id'];


    public function files() :HasMany
    {
        return $this->hasMany(MediaFile::class, 'folder_id', 'id');
    }

    public function parentFolder(): HasOne
    {
        return $this->hasOne(MediaFolder::class, 'id', 'parent');
    }

//    protected static function boot()
//    {
//        parent::boot();
//        static::deleting(function (MediaFolder $folder) {
//            if ($folder->isForceDeleting()) {
//                $files = MediaFile::where('folder_id', $folder->id)->onlyTrashed()->get();
//
//                foreach ($files as $file) {
//                    RvMedia::deleteFile($file);
//                    $file->forceDelete();
//                }
//            } else {
//                $files = MediaFile::where('folder_id', $folder->id)->withTrashed()->get();
//
//                foreach ($files as $file) {
//                    $file->delete();
//                }
//            }
//        });
//
//        static::restoring(function ($folder) {
//            MediaFile::where('folder_id', $folder->id)->restore();
//        });
//    }
}
