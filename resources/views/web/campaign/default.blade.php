<!--
@born April 16, 2024
@author Rodrigo Brito <contato@rodrigobrito.dev.br>
-->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @metas

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/webp" href="{{ asset('img/logo.webp') }}" />

    {!! $property->header_pixel !!}

</head>

<body>
    {!! $property->body_pixel !!}

    <h1>Padrão</h1>
    {{ $property }}
</body>

</html>
