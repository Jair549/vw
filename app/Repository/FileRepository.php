<?php

namespace App\Repository;

use App\Models\Section;

class SectionRepository
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