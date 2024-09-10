<?php

namespace App\Http\Controllers;

use App\Models\MediaFile;
use App\Models\MediaFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $folderId = $request->input('folder_id', 0);
        $folders = MediaFolder::where('parent_id', $folderId)->get();
        $files = MediaFile::where('folder_id', $folderId)->get();

        return Inertia::render('MediaGallery', [
            'folders' => $folders,
            'files' => $files,
            'currentFolderId' => $folderId,
        ]);
    }

    public function storeFolder(Request $request)
    {
        $request->validate([
            'folder_name' => 'required|string|max:255',
            'parent_id' => 'required|integer',
        ]);

        MediaFolder::create($request->only('folder_name', 'parent_id'));

        return redirect()->back();
    }

    public function storeFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
            'folder_id' => 'required|integer',
        ]);

        $file = $request->file('file');
        $filePath = $file->store('media_files');

        MediaFile::create([
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $filePath,
            'type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
            'folder_id' => $request->input('folder_id'),
        ]);

        return redirect()->back();
    }

    public function deleteFile(MediaFile $file)
    {
        Storage::delete($file->file_path);
        $file->delete();

        return redirect()->back();
    }

    public function deleteFolder(MediaFolder $folder)
    {
        $folder->files()->each(function ($file) {
            Storage::delete($file->file_path);
            $file->delete();
        });

        $folder->delete();

        return redirect()->back();
    }
}
