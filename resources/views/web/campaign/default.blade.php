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

    <div class="shadow-lg sticky-top bg-light" id="header">
        <div class="container">
            <header class="d-flex flex-wrap justify-content-center py-3 mb-4">
                <h1 class="d-none">{{ env('APP_NAME') . ' - ' . env('APP_DESCRIPTION') }}</h1>
                <a href="{{ route('web.home') }}"
                    class="d-flex align-items-center mb-0 mb-md-2 mb-lg-0 m-md-auto m-lg-0 me-lg-auto text-decoration-none">
                    <img src="{{ asset('img/black_icon_transparent_background.webp') }}" class="bi me-3" width="55"
                        height="60" alt="logo">
                    <span class="fs-2 fw-bold">{{ $property->title }}</span>
                </a>
                <ul class="nav nav-pills d-none d-md-flex align-items-center">
                    <li class="nav-item"><a href="#differentials" class="nav-link">DIFERENCIAIS</a></li>
                    <li class="nav-item"><a href="#footer" class="nav-link">CONTATO</a></li>
                </ul>
            </header>
        </div>
    </div>

    <main>

        <section id="hero">
            <div class="container">
                <div class="col-xxl-8 px-4 py-5">
                    <div class="row align-items-center g-5 py-5">
                        <div class="col-12 col-lg-6 text-center">
                            <img src="{{ asset('img/white_logo_transparent_background.webp') }}"
                                alt="{{ $property->title }}" class="mb-4" width="350" height="350">
                            <h2 class="display-5 fw-bold lh-1 mb-3">{{ $property->title }}</h2>
                            <p class="lead">{{ $property->headline }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer id="footer" class="pt-5 pb-4 text-light">
        <section>
            <div class="container">
                <header>
                    <h2 class="text-center text-lg-start mt-4">CONTATO</h2>
                </header>
                <div class="d-flex flex-wrap py-5">
                    <div class="col-12 col-md-4 text-center text-lg-start">
                        <img src="{{ asset('img/logo.gif') }}" alt="{{ $property->title }}" width="350"
                            height="299" class="mb-4 mb-lg-0">
                    </div>
                    <div class="col-12 col-md-8 d-flex align-items-center">
                        <ul class="w-100 text-center text-md-start">
                            <li class="my-2"><img src="{{ asset('img/icons/envelope-regular.svg') }}" width="20"
                                    height="20" alt="e-mail" class="me-2"> <a title="Contato por e-mail"
                                    href="mailto:odysseyservicos@proton.me"
                                    rel="noreferrer">odysseyservicos@proton.me</a></li>
                            <li class="my-2"><img src="{{ asset('img/icons/whatsapp.svg') }}" width="20"
                                    height="20" alt="whatsapp" class="me-2"> <a title="Contato por WhatApp"
                                    href="https://wa.me/5521970882353" target="_blank" rel="noreferrer">+55 21 97088
                                    2353</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="copyright">
                <div class="container text-center pt-2">
                    <p>{{ env('APP_NAME') }} ® {{ date('Y') }} Todos os direitos reservados.</p>
                </div>
            </div>
        </section>
    </footer>

    <button aria-label="Voltar ao topo da página" title="Voltar ao topo da página" class="smoothScroll-top"><img
            src="{{ asset('img/icons/chevron-up-solid.svg') }}" width="20" height="20" alt="top"
            class="mb-2"></button>

    <script src="{{ asset('js/button-top.js') }}"></script>
</body>

</html>
