<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $recherche = $request->input('search');
        $statusSel = $request->input('statusSel');
        $page = Page::where('name', 'LIKE', "%{$recherche}%")->where('status', 'LIKE', "%{$statusSel}%")->paginate(10);
//        $page= Page::all();
//        dd($page);
        return Inertia::render("Contenus/Pages/index", [
            'pages' => $page,
            'search' => $recherche
        ]);

//        return response()->json($page);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Contenus/Pages/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:120',
            'content' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'template' => 'nullable|string|max:60',
            'description' => 'nullable|string|max:400',
            'status' => 'required|string|max:60',
        ]);

        Page::create($request->all());
        return redirect()->back()->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return Inertia::render('Contenus/Pages/Create', [
            'pages' => $page
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)

    {
        $request->validate([
            'name' => 'required|string|max:120',
            'content' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'template' => 'nullable|string|max:60',
            'description' => 'nullable|string|max:400',
            'status' => 'required|string|max:60',
        ]);

        $pages = Page::findOrFail($id);
        $pages->update($request->all());

        return redirect()->back()->with('success', 'Page updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pages = Page::findOrFail($id);
        $pages->delete();
        return redirect()->back()->with('success', 'Page deleted successfully.');
    }
}
