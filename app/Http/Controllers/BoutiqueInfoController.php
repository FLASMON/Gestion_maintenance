<?php

namespace App\Http\Controllers;

use App\Models\BoutiqueInfo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BoutiqueInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Contenus/BoutiqueInfo/index");
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BoutiqueInfo $boutiqueInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BoutiqueInfo $boutiqueInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BoutiqueInfo $boutiqueInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BoutiqueInfo $boutiqueInfo)
    {
        //
    }
}
