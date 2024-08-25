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
                ],
                "code_main_content" => '
                    <nav id="main-nav" class="navbar navbar-expand-lg navbar-light bg-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">Início</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Features</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Pricing</a>
                                </li>
                            </ul>
                        </div>
                        <a class="navbar-brand" href="#">
                            <img src="{{image}}" alt="">
                        </a>
                    </nav>
                ',
                "code_content_fields" => '',
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
                ],
                "code_main_content" => '
                    <header class="header-page">
                        <div class="banner-header">
                            <div class="content-header">
                                <img src="{{image}}" alt="">
                            </div>
                        </div>
                        <div class="container-header">
                            <div class="bg-description-header"></div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="content-description-header">
                                            <h1 class="title-header">{{title}}</h1>
                                            <a href="{{button_link}}" class="btn btn-page">{{button_text}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>',
                "code_content_fields" => '',

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
                ],
                "code_main_content" => '
                    <section class="section-consortium">
                        <h1 class="title-section">{{title}}</h1>
                        <div class="container-fluid">
                            <div class="carousel-cars">
                                {{fields}}
                            </div>
                        </div>
                    </section>
                ',
                "code_content_fields" => '
                    <div class="item-carousel">
                        <a href="{{button_link}}" class="content-carousel">
                            <div class="header-carousel-cars">
                                <h1 class="title-car">{{title}}</h1>
                                <h1 class="text-desciprion-car">{{subtitle}}</h1>
                                <span class="text-desciprion-car">{{price}}</span>
                                <div class="box-image-car">
                                    <img src="{{image}}" alt="">
                                </div>
                            </div>
                            <span class="button-simulator">{{button_text}}</span>
                        </a>
                    </div>
                '
            ],
            [
                "name" => "O que é consórcio",
                "type" => "array",
                "columns" => [
                    [
                        "name" => "title",
                        "type" => "text",
                        "label" => "Título",
                        "multicolor" => true,
                        "required" => true,
                    ],
                    [
                        "name" => "image",
                        "type" => "file",
                        "label" => "Imagem",
                        "required" => true,
                    ],
                    [
                        "name" => "descricao_consorcio",
                        "type" => "array",
                        "fields" => [
                            [
                                "name" => "text",
                                "type" => "text",
                                "label" => "Título",
                                "required" => true,
                            ],
                            [
                                "name" => "image",
                                "type" => "file",
                                "label" => "Imagem",
                            ]
                        ]
                    ]
                ],
                "code_main_content" => '
                    <section class="whatConsortium">
                        <div class="bg-whatConsortium">
                            <img src="{{image}}" alt="">
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="content-describe-consortium">
                                        <h1 class="title-consortium">{{title}}</h1>
                                        {{fields}}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>
                ',
                "code_content_fields" => '
                    <div class="item-info-consortium">
                        <img src="{{image}}" alt="">
                        <p class="text-description">{{text}}</p>
                    </div>
                ',
            ],
            [
                "name" => "Vantagens",
                "type" => "array",
                "columns" => [
                    [
                        "name" => "title",
                        "type" => "text",
                        "label" => "Título",
                        "required" => true,
                    ],
                    [
                        "name" => "nossas_vantagens",
                        "type" => "array",
                        "fields" => [
                            [
                                "name" => "image",
                                "type" => "file",
                                "label" => "Imagem",
                            ],
                            [
                                "name" => "title",
                                "type" => "text",
                                "label" => "Título",
                                "multicolor" => true,
                                "required" => true,
                            ],
                            [
                                "name" => "text",
                                "type" => "text",
                                "label" => "Texto",
                                "required" => true,
                            ]
                        ]
                    ]
                ],
                "code_main_content" => '
                <section class="consortiumAdvantages">
                    <h1 class="title-strong">{{title}}</h1>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="box-card-advantages">
                                    {{fields}}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                ',
                "code_content_fields" => '
                <div class="item-advantages">
                    <img src="{{image}}" alt="">
                    <h3 class="title-advantages">{{title}}</h3>
                    <div class="description-advantages">
                        <p>{{text}}</p>
                    </div>
                </div>
                ',
            ],
            [
                "name" => "Por que escolher a gente",
                "type" => "array",
                "code_main_content" => '
                    <section class="nationalVW">
                        <h1 class="title-strong">{{title}}</h1>
                        <div class="container">
                            {{fields}}
                        </div>
                    </section>
                ',
                "code_content_fields" => '
                    <div class="align-box-national">
                        <figure>
                            <img src="{{image}}" alt="">
                        </figure>
                        <div class="box-description-nationalVW">
                            <p>{{text}}</p>
                        </div>
                    </div>
                ',
                "columns" => [
                    [
                        "name" => "title",
                        "type" => "text",
                        "label" => "Título",
                        "required" => true,
                    ],
                    [
                        "name" => "items",
                        "type" => "array",
                        "fields" => [
                            [
                                "name" => "text",
                                "type" => "text",
                                "label" => "Texto",
                                "required" => true,
                            ],
                            [
                                "name" => "image",
                                "type" => "file",
                                "label" => "Imagem",
                            ]
                        ]
                    ],
                ],
            ],
            [
                "name" => "Simulador",
                "columns" => [
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
                ],
                "code_main_content" => '
                    <section class="callAction">
                        <div class="container">
                            <div class="content-callAction">
                                <h4 class="sup-title">{{title}}</h4>
                                <h1 class="title-callAction">{{subtitle}}</h1>
                                <a href="{{button_link}}" class="btn btn-page">{{button_text}}</a>
                            </div>
                        </div>
                    </section>
                ',
                "code_content_fields" => '',
            ],
            [
                "name" => "Faq",
                "type" => "array",
                "columns" => [
                    [
                        "name" => "title",
                        "type" => "text",
                        "label" => "Título",
                        "required" => true,
                    ],
                    [
                        "name" => "text",
                        "type" => "text",
                        "label" => "Texto",
                        "required" => true,
                    ],
                    [
                        "name" => "faqs",
                        "type" => "array",
                        "fields" => [
                            [
                                "name" => "question",
                                "type" => "text",
                                "label" => "Pergunta",
                                "required" => true,
                            ],
                            [
                                "name" => "answer",
                                "type" => "text",
                                "label" => "Resposta",
                                "required" => true,
                            ],
                        ]
                    ]
                ],
            ]
        ];

        foreach ($sections as $section) {
            $payload = [
                "name" => $section["name"],
                "type" => $section["type"] ?? "object",
                "columns" => json_encode($section["columns"]),
                "slug" => \App\Models\Section::uniqSlug($section["name"]),
            ];
            
            $newSection = \App\Models\Section::updateOrCreate($payload);

            $fieldPayload = [
                "section_id" => $newSection->id,
                "code_main_content" => $section["code_main_content"] ?? null,
                "code_content_fields" => $section["code_content_fields"] ?? null,
            ];
            
            \App\Models\SectionContent::updateOrCreate($fieldPayload);
        }
    }
}
