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
                        "name" => "logo",
                        "type" => "file",
                        "label" => "Logo",
                    ]
                ]
            ],
            [
                "name" => "Header",
                "columns" => [
                    [
                        "name" => "banner",
                        "type" => "file",
                        "label" => "Banner",
                    ],
                    [
                        "name" => "title",
                        "type" => "text",
                        "label" => "Título",
                    ],
                    [
                        "name" => "button_text",
                        "type" => "text",
                        "label" => "Texto do botão",
                    ],
                    [
                        "name" => "button_link",
                        "type" => "url",
                        "label" => "Link do botão",
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
                    ],
                    [
                        "name" => "carros",
                        "type" => "array",
                        "fields" => [
                            [
                                "name" => "title",
                                "type" => "text",
                                "label" => "Título",
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
                            ],
                            [
                                "name" => "button_text",
                                "type" => "text",
                                "label" => "Texto do botão",
                            ],
                            [
                                "name" => "button_link",
                                "type" => "url",
                                "label" => "Link do botão",
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
