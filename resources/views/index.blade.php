<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>VW</title>

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

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