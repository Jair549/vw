<?php

namespace App\Repositories;

use App\Models\Section;

class FileRepository
{
    public function show($sectionId, $fileId)
    {
        $section = Section::find($sectionId);
        $fields = json_decode($section->fields, true);
        $files = $fields['files'];
        foreach ($files as $file) {
            if ($file['id'] == $fileId) {
                return $file['path'];
            }
        }

        return null;
    }
}