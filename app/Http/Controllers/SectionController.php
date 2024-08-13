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
    protected $sections;

    public function __construct(FileService $fileService, FileRepository $fileRepository, Section $sections)
    {
        $this->fileService = $fileService;
        $this->fileRepository = $fileRepository;
        $this->sections = $sections;
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
        $sections = Section::all();
        $update = false;
        return view('panel.sections.create', compact('section', 'sections', 'update'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Section $section)
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
        }
        $payload = $request->all();
        unset($payload['image']);
        unset($payload['_token']);

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
        $sections = $this->sections->all();
        return view('panel.sections.index', compact('section', 'sections'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        $sections = Section::all();
        $update = true;
        return view('panel.sections.create', compact('section', 'sections', 'update'));
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
