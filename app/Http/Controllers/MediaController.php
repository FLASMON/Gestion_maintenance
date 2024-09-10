<?php

namespace App\Http\Controllers;

use App\Models\MediaFile;
use App\Models\MediaFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use setasign\Fpdi\Fpdi;
use PhpOffice\PhpWord\IOFactory;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $folder = MediaFolder::all();
        $file = MediaFile::all();

        return Inertia::render("Contenus/MediaGallery/index", [
            'folders' => $folder,
            'files' => $file,

        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Contenus/MediaGallery/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'folder_name' => 'required|string|max:120'
        ]);

        MediaFolder::create($request->all());
        return redirect()->back()->with('success', 'MediaFolder folder created successfully.');

    }


    public function storefile(Request $request)
    {
        $validatedData = $request->validate([
            'file_name' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'folder_id' => 'nullable|numeric',

        ]);

        $file = $request->file('file_name');
        $originalName = $file->getClientOriginalName();

        // Gestion de l'upload de l'image
        if ($request->hasFile('file_name')) {
            $validatedData['file_name'] = $request->file('file_name')->storeAs('media_files', $originalName, 'public');
        }
        // Création d'une nouvelle instance d'Employeur
        MediaFile::create($validatedData);
        return redirect()->route('media.index');
    }



    public function storeImage(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:2048',
            // 'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName(); // Nom original du fichier

        // Définir le chemin de stockage avec le nom original
        $path = $file->storeAs('media_files', $originalName, 'public');

        // Compter les pages du document
        $pageCount = $this->getPageCount($file, $path);

        // Créer l'enregistrement en base de données
        $fileRecord = MediaFile::create([
            'file_name' => $originalName,  // Nom original
            'file_path' => $path,  // Chemin avec le nom original
            'type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
            'page_count' => $pageCount,
            'folder_id' => $request->input('folder_id'),
        ]);

        return redirect()->route('media.index');
        // return redirect()->back()->with('success', 'Document ajouté avec succès');
    }

    private function getPageCount($file, $path)
    {
        $extension = $file->getClientOriginalExtension();
        $pageCount = null;

        // Chemin complet du fichier pour le traitement
        $filePath = storage_path('app/public/' . $path);

        if ($extension === 'pdf') {
            $pdf = new \setasign\Fpdi\Fpdi();
            $pageCount = $pdf->setSourceFile($filePath);
        } elseif (in_array($extension, ['doc', 'docx'])) {
            $phpWord = \PhpOffice\PhpWord\IOFactory::load($filePath);
            $sections = $phpWord->getSections();
            $pageCount = count($sections); // Approximation du nombre de pages
        }

        return $pageCount;
    }

    /**
     * Display the specified resource.
     */
    public function show(MediaFolder $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MediaFolder $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MediaFolder $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MediaFolder $media)
    {
        //
    }
}
