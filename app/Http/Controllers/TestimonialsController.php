<?php

namespace App\Http\Controllers;

use App\Models\Testimonials;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestimonialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $testimonials = Testimonials::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('company', 'LIKE', "%{$search}%")
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return Inertia::render("Contenus/Testimonial/index", [
            'testimonials' => $testimonials,
            'filters' => $request->only('search')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Contenus/Testimonial/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:120',
            'content' => 'required|string',
            'image' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:120',
            'status' => 'required|string|max:60',
        ]);

        Testimonials::create($request->all());
        return redirect()->back()->with('success', 'Testimonial created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonials $testimonials)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonials $testimonial)
    {
//        dd($testimonial);
        return Inertia::render('Contenus/Testimonial/Create', [
            'testimonials' => $testimonial,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:120',
            'content' => 'required|string',
            'image' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:120',
            'status' => 'required|string|max:60',
        ]);

        $testimonials = Testimonials::findOrFail($id);
        $testimonials->update($request->all());

        return redirect()->back()->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $testimonials = Testimonials::findOrFail($id);
        $testimonials->delete();
        return redirect()->back()->with('success', 'Testimonial deleted successfully.');
    }
}
