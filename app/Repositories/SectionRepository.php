<?php

namespace App\Repositories;

use App\Models\Section;

class SectionRepository
{
    public function all()
    {
        return Section::all();
    }
}