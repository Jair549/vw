<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{
    //Store
    public function store($file)
    {
        //Salvar a imagem em storage dentro da pasta images
        try{
            $fileName = time() . '_' . uniqid() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $filePath = 'images/' . $fileName;
            Storage::disk('public')->put($filePath, file_get_contents($file));
            return $filePath;
        }catch(\Exception $e){
            return null;
        }
    }

    //Delete
    public function delete($filePath)
    {
        //Deletar a imagem
        try{
            Storage::disk('public')->delete($filePath);
            return true;
        }catch(\Exception $e){
            return false;
        }
    }
}