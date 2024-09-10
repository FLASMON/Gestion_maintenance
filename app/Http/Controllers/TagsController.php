<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tags = Tags::where('name', 'LIKE', "%{$search}%")->paginate(10);
//        $page= Page::all();
//        dd($page);
        return Inertia::render("Contenus/Blogs/Tags/index", [
            'tags' => $tags,
            'search' => $search
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Contenus/Blogs/Tags/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:120',
            'slug' => 'required|string|unique:tags,slug',
            'description' => 'nullable|string|max:400',
            'status' => 'required|string|max:60',
        ]);

        Tags::create($request->all());
        return redirect()->back()->with('success', 'Tags created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tags $tags)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tags $tag)
    {
        return Inertia::render('Contenus/Blogs/Tags/Create', [
            'tags' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:120',
            'slug' => 'required|string|unique:tags,slug',
            'description' => 'nullable|string|max:400',
            'status' => 'required|string|max:60',
        ]);

        $tags = Tags::findOrFail($id);
        $tags->update($request->all());

        return redirect()->back()->with('success', 'Tag updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tags = Tags::findOrFail($id);
        $tags->delete();
        return redirect()->back()->with('success', 'Tag deleted successfully.');
    }
}
