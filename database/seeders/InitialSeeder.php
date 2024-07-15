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

                        ]
                    ]
                ]
            ]
        ];

        foreach ($sections as $section) {
            $payload = [
                "name" => $section["name"],
                "columns" => json_encode($section["columns"]),
            ];
            \App\Models\Section::updateOrCreate($payload);
        }
    }
}
