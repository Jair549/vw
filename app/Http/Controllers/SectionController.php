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

        // Decodificar as colunas do JSON
        $columns = json_decode($section->columns, true);

        // Filtrar as colunas onde a chave 'fields' não está presente
        $mainColumns = array_filter($columns, function($column) {
            return !isset($column['fields']);
        });

        $fieldsColumns = array_filter($columns, function($column) {
            return isset($column['fields']);
        });

        return view('panel.sections.createOrUpdate', compact('section', 'sections', 'update', 'mainColumns', 'fieldsColumns'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Section $section)
    {
        $fields = json_decode($section->fields, true);
        //Verificar se existe image, e salvar a imagem na pasta e retornar o path
        if ($request->hasFile('image')) {
            $path = $this->fileService->store($request->file('image'));
            $request['files'] = [
                'id' => uniqid(),
                'path' => $path,
            ];
        }

        unset($request['image']);
        unset($request['_token']);

        $isMain = $request['formMain'];
        unset($request['formMain']);

        // Verificar se é pra atualizar os campos exceto fields
        if($isMain){
            $payload = $request->all();
            $payload['fields'] = isset($fields['fields']) ? $fields['fields'] : [];
        }else{
            $payload = $fields;
            $request['id'] = uniqid();
            $payload['fields'][] = $request->except(['image']);
        }
        
        $payload['id'] = isset($fields['id']) ? $fields['id'] : uniqid();

        $section->fields =  json_encode($payload);
        $section->save();
        
        session()->flash('success', 'Cadastro realizado com sucesso!');
        return redirect()->route('panel.show', $section->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        $update = false;
        $sections = $this->sections->all();

        // Decodificar as colunas do JSON
        $columns = json_decode($section->columns, true);

        // Filtrar as colunas onde a chave 'fields' não está presente
        $mainColumns = array_filter($columns, function($column) {
            return !isset($column['fields']);
        });

        $fieldsColumns = array_filter($columns, function($column) {
            return isset($column['fields']);
        });

        return view('panel.sections.index', compact('section', 'sections', 'update', 'mainColumns', 'fieldsColumns'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section, $fieldId)
    {
        $sections = Section::all();
        $update = true;

        // Decodificar as colunas do JSON
        $columns = json_decode($section->columns, true);

        // Filtrar as colunas onde a chave 'fields' não está presente
        $mainColumns = array_filter($columns, function($column) {
            return !isset($column['fields']);
        });

        $fieldsColumns = array_filter($columns, function($column) {
            return isset($column['fields']);
        });

        $fieldData = json_decode($section->fields, true);

        $currentField = array_filter($fieldData['fields'], function($field) use ($fieldId) {
            return $field['id'] == $fieldId;
        });

        return view('panel.sections.createOrUpdate', compact('section', 'sections', 'update', 'mainColumns', 'fieldsColumns', 'currentField'));
    }

    // public function editField(Section $section, $id)
    // {
    //     return view('panel.carros.editField', compact('section', 'id'));
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section, $fieldId)
    {
        $fields = json_decode($section->fields, true);
        $newImage = false;
        //Verificar se existe image, e salvar a imagem na pasta e retornar o path
        if ($request->hasFile('image')) {
            $path = $this->fileService->store($request->file('image'));
            $request['files'] = [
                'id' => uniqid(),
                'path' => $path,
            ];
            $newImage = true;
        }

        unset($request['image']);
        unset($request['_token']);
        unset($request['_method']);

        $isMain = $request['formMain'];
        unset($request['formMain']);

        // Verificar se é pra atualizar os campos exceto fields
        if($isMain){
            $payload = $request->all();
            $payload['fields'] = isset($fields['fields']) ? $fields['fields'] : [];
        }else{
            $payload = $fields;
            // Encontrar o field com base no fieldId e substituir os dados
            $fieldIndex = array_search($fieldId, array_column($fields['fields'], 'id'));
            $existingField = $fields['fields'][$fieldIndex];
    
            // Preservar os dados da imagem se uma nova imagem não foi enviada
            if (!$newImage && isset($existingField['files'])) {
                $request['files'] = $existingField['files'];
            }

            // Preservar o id do campo
            $request['id'] = $existingField['id'];
    
            $payload['fields'][$fieldIndex] = $request->except(['image']);
        }
        
        $payload['id'] = isset($fields['id']) ? $fields['id'] : uniqid();

        $section->fields =  json_encode($payload);
        $section->save();
        
        session()->flash('success', 'Cadastro atualizado com sucesso!');
        return redirect()->route('panel.show', $section->slug);

        //Verificar se existe image, se sim, deletar a imagem antiga e salvar a nova imagem na pasta e retornar o path
        // xdebug_break();
    }

    // public function updateField(Request $request, Section $section, $id)
    // {
    //     //Verificar se existe image, se sim, deletar a imagem antiga e salvar a nova imagem na pasta e retornar o path
    //     // xdebug_break();
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        //
    }
}
