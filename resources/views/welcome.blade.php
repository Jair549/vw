<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Vilavolks</title>

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

</head>

<body>

    @include('sections.nav')

    @include('sections.header')

    @include('sections.carousel')

    @include('sections.whatConsortium')

    @include('sections.consortiumAdvantages')

    @include('sections.nationalVW')

    @include('sections.callAction')

    @include('sections.faq')

    @include('sections.footer')

    @vite('resources/js/app.js')
</body>

</html>
