<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use setasign\Fpdi\Fpdi;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $recherche = $request->input('recherche', '');
        $projets = Projet::select('nom_projet', 'id')->get();
        $documents = Document::with(['projet'])
            ->where(function ($query) use ($recherche) {
                $query->whereHas('projet', function ($query) use ($recherche) {
                    $query->where('nom_projet', 'LIKE', "%{$recherche}%");
                });
            })
            ->paginate(10);
        return Inertia::render("Apps/Documents/Index", [
            'projets' => $projets,
            'recherche' => $recherche,
            'documents' => $documents
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
//     public function store(Request $request)
//     {
// //        $validatedData = $request->validate([
// //            'projet_id' => 'required|numeric',
// //            'nom' => 'required|string',
// //            'type' => 'required',
// //        ]);
// //        Document::create($validatedData);
// //        return redirect()->back()->with('success', 'Document ajouter avec succès');

//         // $request->validate([
//         //     'projet_id' => 'required|numeric',
//         //     'nom' => 'required|string',
//         //     'type' => 'required',
//         // ]);

//         // $document = new Document();
//         // $document->projet_id = $request->id_stage;
//         // $document->type = $request->type;

//         // // Get the original filename of the uploaded file
//         // $originalFilename = $request->file('nom')->getClientOriginalName();

//         // // Store the file with the original filename
//         // $document->nom = $request->file('nom')->storeAs($originalFilename);

//         // $document->save();

//         // return Inertia::location(route('feedback.stage')); // Redirect to the index page
//         // return redirect()->back()->with('success', 'Document ajouter avec succès!');
//         $request->validate([
//             'file' => 'required|file|mimes:doc,docx|max:2048',
//         ]);

//         $file = $request->file('file');
//         $path = $file->store('uploads', 'public');

//         // Charger le document Word
//         $phpWord = IOFactory::load(storage_path('app/public/' . $path));
//         $sections = $phpWord->getSections();
//         $pageCount = count($sections); // Méthode simple pour approximer les pages

//         $fileRecord = File::create([
//             'name' => $file->getClientOriginalName(),
//             'path' => $path,
//             'type' => $file->getClientMimeType(),
//             'size' => $file->getSize(),
//             'page_count' => $pageCount,
//         ]);

//         return response()->json($fileRecord, 201);
//     }

//    public function store(Request $request)
//    {
//        $request->validate([
//            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
//        ]);
//
//        $file = $request->file('file');
//        $path = $file->store('uploads', 'public');
//
//        $pageCount = $this->getPageCount($file, $path);
//        $fileRecord = Document::create([
//            'name' => $file->getClientOriginalName(),
//            'path' => $path,
//            'type' => $file->getClientMimeType(),
//            'size' => $file->getSize(),
//            'page_count' => $pageCount,
//            'projet_id' => $request->input('projet_id'),
//        ]);
//
////        return response()->json($fileRecord, 201);
//        return redirect()->back()->with('success', 'Document ajout avec succès');
//    }
//
//    private function getPageCount($file, $path)
//    {
//        $extension = $file->getClientOriginalExtension();
//        $pageCount = null;
//
//        if ($extension === 'pdf') {
//            $pdf = new Fpdi();
//            $pageCount = $pdf->setSourceFile(storage_path('app/public/' . $path));
//        } elseif (in_array($extension, ['doc', 'docx'])) {
//            $phpWord = IOFactory::load(storage_path('app/public/' . $path));
//            $sections = $phpWord->getSections();
//            $pageCount = count($sections); // Approximation du nombre de pages
//        }
//
//        return $pageCount;
//    }
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('file');

        // Générer un nom unique basé sur un hash
        $uniqueName = uniqid() . '.' . $file->getClientOriginalExtension();

        // Sauvegarder le fichier sous le nom unique
        $path = $file->storeAs('uploads', $uniqueName, 'public');

        // Compter les pages du document
        $pageCount = $this->getPageCount($file, $path);

        // Créer l'enregistrement en base de données
        $fileRecord = Document::create([
            'name' => $file->getClientOriginalName(),  // Nom original
            'path' => $path,  // Chemin avec le nom unique
            'type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
            'page_count' => $pageCount,
            'projet_id' => $request->input('projet_id'),
        ]);

        return redirect()->back()->with('success', 'Document ajouté avec succès');
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

    public function download($id)
    {
        $document = Document::findOrFail($id);
        $filePath = storage_path('app/public/' . $document->path);
        if (file_exists($filePath)) {
            return response()->download($filePath, $document->name);
        }else{
            return response()->json(['error' => 'File not found'], 404);
        }
    }
    public function getUrl($id)
    {
        $document = Document::findOrFail($id);
        $filePath = $document->path; // Assurez-vous que c'est le bon chemin vers le fichier

        // Utilisez le disque de stockage public
        if (Storage::disk('public')->exists($filePath)) {
            $url = Storage::disk('public')->url($filePath);
            return response()->json(['url' => $url]);
        } else {
            // Affichez le chemin pour le débogage
            return response()->json(['error' => 'File not found', 'path' => $filePath], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'projet_id' => 'required|numeric',
            'nom' => 'required|string',
            'type' => 'required',
        ]);
        $document = Document::findOrFail($id);
        $document->update($validatedData);
        return redirect()->back()->with('success', 'Document modifier avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        $document->delete();
        return redirect()->back()->with('success', 'Document supprimer avec succès');
    }
}
