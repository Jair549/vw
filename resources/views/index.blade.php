<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="storage/{{ $headerFields['files']['path'] ?? '' }}" type="image/x-icon">

    <meta property="og:title" content="Vilavolks">
    <meta property="og:description" content="O carro que você sempre sonhou, com parcelas que você nunca imaginou.">
    <meta property="og:image" content="{{ $logo ?? '' }}">
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:type" content="website">


    <title>{{ $headerFields['title'] ?? 'Vilavolks' }}</title>

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    {!! $headerFields['scripts'] ?? '' !!}

</head>

<body>
    
    @foreach($sections as $section)
        @if(isset($section->contents[0]->main_content))
            {!! $section->contents[0]->main_content !!}
        @endif
    @endforeach

    @vite('resources/js/app.js')

</body>

</html>