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
        $sections = Section::with('contents')->get();
        $sectionLogo = $sections->where('slug', 'logo')->first();
        $logoFields = $sectionLogo ? json_decode($sectionLogo->fields, true) : null;
        $logo = $logoFields ? 'storage/' . $logoFields['files']['path'] : null;

        $sectionHeader = $sections->where('name', 'Configurações e SEO')->first();
        $headerFields = $sectionHeader && $sectionHeader->fields ? json_decode($sectionHeader->fields, true) : null;
        
        return view('index', compact('sections', 'logo', 'headerFields'));
    }

    public function logo()
    {
        $section = Section::where('slug', 'logo')->first();
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

        return view('panel.sections.index', compact('section', 'sections', 'update', 'mainColumns', 'fieldsColumns'));
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
        // }else if( $fields && isset($fields['files'])){
        //     $request['files'] = $fields['files'];
        }

        unset($request['image']);
        unset($request['_token']);

        $isMain = $request['formMain'];
        unset($request['formMain']);

        // Verificar se é pra atualizar os campos exceto fields
        if($isMain){

            if( $fields && isset($fields['files'])){
                $request['files'] = $fields['files'];
            }

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

        if($section->name != 'Configurações e SEO'){
            $this->addMainContent($section);
        }
        
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

        $currentField = array_values(array_filter($fieldData['fields'], function($field) use ($fieldId) {
            return $field['id'] == $fieldId;
        }))[0] ?? null;

        return view('panel.sections.createOrUpdate', compact('section', 'sections', 'update', 'mainColumns', 'fieldsColumns', 'currentField'));
    }

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

        if($section->name != 'Configurações e SEO'){
            $this->addMainContent($section);
        }
        
        session()->flash('success', 'Cadastro atualizado com sucesso!');
        return redirect()->route('panel.show', $section->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        //
    }

    public function removeFile(Section $section, $fieldId, $fileId)
    {
        
        $fields = json_decode($section->fields, true);
        $fieldIndex = array_search($fieldId, array_column($fields['fields'], 'id'));
        $currentField = $fields['fields'][$fieldIndex];

        if(!empty($currentField['files']) && $currentField['files']['id'] == $fileId)
        {
            if($this->fileService->delete($currentField['files']['path']))
            {
                unset($currentField['files']);
                $fields['fields'][$fieldIndex] = $currentField;
                $section->fields = json_encode($fields);
                $section->save();

                if($section->name != 'Configurações e SEO'){
                    $this->addMainContent($section);
                }

                session()->flash('success', 'Imagem removida com sucesso!');
                return response()->json(['message' => 'Imagem removida com sucesso'], 200);
            }
        }

        session()->flash('error', 'Erro ao remover imagem!');
        return response()->json(['message' => 'Erro ao remover imagem'], 500);
    }

    public function removeMainFile(Section $section, $fieldId, $fileId)
    {
        
        $fields = json_decode($section->fields, true);

        if(!empty($fields['files']) && $fields['files']['id'] == $fileId)
        {
            if($this->fileService->delete($fields['files']['path']))
            {
                unset($fields['files']);
                $section->fields = json_encode($fields);
                $section->save();

                if($section->name != 'Configurações e SEO'){
                    $this->addMainContent($section);
                }

                session()->flash('success', 'Imagem removida com sucesso!');
                return response()->json(['message' => 'Imagem removida com sucesso'], 200);
            }
        }

        session()->flash('error', 'Erro ao remover imagem!');
        return response()->json(['message' => 'Erro ao remover imagem'], 500);
    }

    public function removeField(Section $section, $fieldId)
    {
        
        // Decodificar os campos da seção
        $fields = json_decode($section->fields, true);

        // Encontrar o índice do campo a ser removido
        $fieldIndex = array_search($fieldId, array_column($fields['fields'], 'id'));

        // Verificar se o campo foi encontrado
        if ($fieldIndex !== false) {
            $currentField = $fields['fields'][$fieldIndex];

            // Verificar se há uma imagem associada ao campo e removê-la
            if (!empty($currentField['files']) && isset($currentField['files']['path'])) {
                $this->fileService->delete($currentField['files']['path']);
            }

            // Remover o campo do array
            unset($fields['fields'][$fieldIndex]);

            // Reindexar o array para evitar buracos nos índices
            $fields['fields'] = array_values($fields['fields']);

            // Atualizar e salvar a seção
            $section->fields = json_encode($fields);
            $section->save();

            if($section->name != 'Configurações e SEO'){
                $this->addMainContent($section);
            }

            // Retornar uma resposta de sucesso
            session()->flash('success', 'Campo removido com sucesso!');
            return redirect()->back();
        }

        // Retornar uma resposta de erro se o campo não for encontrado
        session()->flash('error', 'Erro ao remover campo!');
        return redirect()->back();
    }

    private function addMainContent($section)
    {
        
        $section->load('contents');
        // Ignorar os fields dentro de section->fields
        $fields = json_decode($section->fields);
        $dataFields = $fields->fields;
        
        $columns = json_decode($section->columns, true);
        $isAccordion = false;
        foreach ($columns as $column) {
            if (isset($column['fields']) && isset($column['is_accordion']) && $column['is_accordion']) {
                $isAccordion = true;
                break;
            }
        }

        $codeMainContent = $section->contents[0]->code_main_content;
        $codeContentFields = $section->contents[0]->code_content_fields;
        
        // Substituir as chaves pelos valores
        foreach ($fields as $key => $value) {
            
            if ($key == "files") {
                $codeMainContent = str_replace("{{image}}", 'storage/' . $value->path, $codeMainContent);
            }else if($key == 'image'){
                continue;
            }else if($key == 'fields'){
                
                // $fieldsContent = '';//Vamos criar a função para montar o conteúdo dos fields
                $fieldsContent = $this->addFieldsContent($dataFields, $codeContentFields, $isAccordion);
                $codeMainContent = str_replace("{{fields}}", $fieldsContent, $codeMainContent);
            } else {
                // Verificar e substituir *palavra* por <b>palavra</b>
                $value = preg_replace('/\*(.*?)\*/', '<b>$1</b>', $value);
                $codeMainContent = str_replace("{{{$key}}}", $value, $codeMainContent);
            }
        }

        // Verificar se todas as chaves foram substituídas
        preg_match_all('/{{(.*?)}}/', $codeMainContent, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $missingKey) {
                // Log ou tratamento de chaves não substituídas
                error_log("Chave não substituída: {{$missingKey}}");
            }
        }

        $contentPayload = [
            "section_id" => $section->id,
            "main_content" => $codeMainContent
        ];

        \App\Models\SectionContent::updateOrCreate(["section_id" => $section->id], $contentPayload);
    }

    private function addFieldsContent($dataFields, $codeContentFields, $isAccordion)
    {
        $fieldsContent = '';
        $countAccordion = 0;
        foreach ($dataFields as $field) {
            $fieldContent = $codeContentFields;
            foreach ($field as $key => $value) {
                if ($key == "files") {
                    $fieldContent = str_replace("{{image}}", 'storage/' . $value->path, $fieldContent);
                } else {
                    // Verificar e substituir *palavra* por <b>palavra</b>
                    $value = preg_replace('/\*(.*?)\*/', '<b>$1</b>', $value);
                    $fieldContent = str_replace("{{{$key}}}", $value, $fieldContent);
                }

                if($isAccordion){
                    $fieldContent = str_replace("{{collapseId}}", 'collapse-' . $countAccordion,  $fieldContent);
                    $classess = $countAccordion <= 0 ? 'accordion-collapse collapse show' : 'accordion-collapse collapse';
                    $fieldContent = str_replace("{{classes}}", $classess,  $fieldContent);
                }

                $countAccordion++;
            }
            $fieldsContent .= $fieldContent;
        }

        return $fieldsContent;
    }

}
