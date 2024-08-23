<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'code_main_content',
        'main_content',
        'code_content_fields',
        'content_fields',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
