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
                    ]
                ]
            ],
            [
                "name" => "Header",
                "columns" => [
                    [
                        "name" => "banner",
                        "type" => "file",
                    ],
                    [
                        "name" => "title",
                        "type" => "text",
                    ],
                    [
                        "name" => "button_text",
                        "type" => "text",
                    ],
                    [
                        "name" => "button_link",
                        "type" => "url",
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
                    ],
                    [
                        "name" => "carros",
                        "type" => "array",
                        "fields" => [
                            [
                                "name" => "title",
                                "type" => "text",
                            ],
                            [
                                "name" => "subtitle",
                                "type" => "text",
                            ],
                            [
                                "name" => "price",
                                "mask" => "currency",
                                "type" => "text",
                            ],
                            [
                                "name" => "button_text",
                                "type" => "text",
                            ],
                            [
                                "name" => "button_link",
                                "type" => "url",
                            ],
                            [
                                "name" => "image",
                                "type" => "file",
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
