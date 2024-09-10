<?php

namespace App\Http\Controllers;

use App\Models\MediaFile;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MediaFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $file = MediaFile::where('name', 'LIKE', "%{$search}%")->paginate(10);

        return Inertia::render("Contenus/MediaGallery/index", [
            'mediaFiles' => $file,
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('media_files.create');
    }

    /**
     * Store a newly created resource in storage.
     */
//    public function store(Request $request)
//    {
//        $request->validate([
//            'file' => 'required|file',
//            'folder_id' => 'nullable|integer',
//        ]);
//
//        $file = $request->file('file');
//        $filePath = $file->store('media_files', 'public');
//
//        MediaFile::create([
//            'file_name' => $file->getClientOriginalName(),
//            'file_path' => $filePath,
//            'type' => $file->getClientMimeType(),
//            'size' => $file->getSize(),
//            'folder_id' => $request->input('folder_id'),
//        ]);
//
//        return redirect()->back()->with('success', 'Page created successfully.');
//    }



    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:2048',
//            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('file');

        // Générer un nom unique basé sur un hash
        $uniqueName = uniqid() . '.' . $file->getClientOriginalExtension();

        // Sauvegarder le fichier sous le nom unique
        $path = $file->storeAs('media_files', $uniqueName, 'public');

        // Compter les pages du document
        $pageCount = $this->getPageCount($file, $path);

        // Créer l'enregistrement en base de données
        $fileRecord = Document::create([
            'file_name' => $file->getClientOriginalName(),  // Nom original
            'file_path' => $path,  // Chemin avec le nom unique
            'type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
            'page_count' => $pageCount,
            'folder_id' => $request->input('folder_id'),
        ]);

        return redirect()->back()->with('success', 'Document ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(MediaFile $mediaFile)
    {
        //return response()->json($mediaFile);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MediaFile $mediaFile)
    {
        return view('media_files.edit', compact('mediaFile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MediaFile $mediaFile)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MediaFile $mediaFile)
    {

    }
}
