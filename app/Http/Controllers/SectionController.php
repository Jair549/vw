<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Section $section)
    {
        // $sections = Section::all();
        return view('panel.carros.create', compact('section'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sectionId = $request['section_id'];
        unset($request['section_id']);
        $payload = $request->all();

        //buscar a seção
        $section = Section::find($sectionId);
        $section->fields =  json_encode($payload);
        $section->save();

        return redirect()->route('sections.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        return view('panel.carros.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        return view('panel.carros.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        //
    }
}
