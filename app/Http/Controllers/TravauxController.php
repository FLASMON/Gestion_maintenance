<?php

namespace App\Http\Controllers;

use App\Models\Travaux;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TravauxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Contenus/Travaux_Panes/Travaux/index");
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
    public function show(Travaux $travaux)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Travaux $travaux)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Travaux $travaux)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Travaux $travaux)
    {
        //
    }
}
