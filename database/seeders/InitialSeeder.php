<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //array com todas as seções do meu site
        $sections = [
            [
                "name" => "Logo",
                "columns" => [
                    [
                        "name" => "image",
                        "type" => "file",
                        "label" => "Logo",
                        "required" => true,
                    ]
                ]
            ],
            [
                "name" => "Header",
                "columns" => [
                    [
                        "name" => "image",
                        "type" => "file",
                        "label" => "Banner",
                        "required" => true,
                    ],
                    [
                        "name" => "title",
                        "type" => "text",
                        "label" => "Título",
                        "required" => true,
                    ],
                    [
                        "name" => "button_text",
                        "type" => "text",
                        "label" => "Texto do botão",
                        "required" => true,
                    ],
                    [
                        "name" => "button_link",
                        "type" => "url",
                        "label" => "Link do botão",
                        "required" => true,
                    ],
                ]
            ],
            [
                "name" => "Carros",
                "type" => "array",
                "columns" => [
                    [
                        "name" => "title",
                        "type" => "text",
                        "label" => "Título",
                        "required" => true,
                    ],
                    [
                        "name" => "carros",
                        "type" => "array",
                        "fields" => [
                            [
                                "name" => "title",
                                "type" => "text",
                                "label" => "Título",
                                "required" => true,
                            ],
                            [
                                "name" => "subtitle",
                                "type" => "text",
                                "label" => "Subtítulo",
                            ],
                            [
                                "name" => "price",
                                "mask" => "currency",
                                "type" => "text",
                                "label" => "Preço",
                                "required" => true,
                            ],
                            [
                                "name" => "button_text",
                                "type" => "text",
                                "label" => "Texto do botão",
                                "required" => true,
                            ],
                            [
                                "name" => "button_link",
                                "type" => "url",
                                "label" => "Link do botão",
                                "required" => true,
                            ],
                            [
                                "name" => "image",
                                "type" => "file",
                                "label" => "Imagem",
                            ],

                        ]
                    ]
                ]
            ]
        ];

        foreach ($sections as $section) {
            $payload = [
                "name" => $section["name"],
                "type" => $section["type"] ?? "object",
                "columns" => json_encode($section["columns"]),
                "slug" => \App\Models\Section::uniqSlug($section["name"]),
            ];
            \App\Models\Section::updateOrCreate($payload);
        }
    }
}
