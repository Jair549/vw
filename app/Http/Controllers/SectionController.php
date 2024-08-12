<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Services\FileService;
use App\Repositories\FileRepository;

class SectionController extends Controller
{
    protected $fileService;
    protected $fileRepository;

    public function __construct(FileService $fileService, FileRepository $fileRepository)
    {
        $this->fileService = $fileService;
        $this->fileRepository = $fileRepository;
    }

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
        $section = Section::find($request->section_id);
        unset($request['section_id']);
        $fields = json_decode($section->fields, true);

        //Verificar se existe image, e salvar a imagem na pasta e retornar o path
        if ($request->hasFile('image')) {
            $path = $this->fileService->store($request->file('image'));
            $request['files'] = [
                'id' => uniqid(),
                'path' => $path,
            ];
            unset($request['image']);
        }
        $payload = $request->all();

        //Verificar se o tipo do campo é array ou objeto
        if($section->type == 'array'){
            $fields[] = [
                'id' => uniqid(),
                'fields' => $payload
            ];
        }else{
            $fields = $payload;
        }

        $section->fields =  json_encode($fields);
        $section->save();

        return redirect()->route('sections.create', $section->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        return view('panel.sections.index', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        return view('panel.carros.edit', compact('section'));
    }

    public function editField(Section $section, $id)
    {
        return view('panel.carros.editField', compact('section', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        //Verificar se existe image, se sim, deletar a imagem antiga e salvar a nova imagem na pasta e retornar o path
        // xdebug_break();
    }

    public function updateField(Request $request, Section $section, $id)
    {
        //Verificar se existe image, se sim, deletar a imagem antiga e salvar a nova imagem na pasta e retornar o path
        // xdebug_break();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        //
    }
}
