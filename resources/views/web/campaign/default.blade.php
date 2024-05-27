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
    <link rel="stylesheet" href="{{ asset('css/campaign/default.css') }}">

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
                    <img src="{{ asset('img/logo.webp') }}" class="me-3" width="100" height="60" alt="logo">
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

            </div>
        </section>

    </main>

    <footer id="footer">
        <section>
            <div class="container py-5">
                <div class="d-flex flex-wrap py-5">
                    <div class="col-12 col-md-4 text-center text-lg-start">
                        <img src="{{ asset('img/brand.webp') }}" alt="{{ env('APP_NAME') }}" width="284"
                            height="100" class="mb-4 mb-lg-0">
                    </div>
                    <div class="col-12 col-md-8 d-flex flex-wrap align-items-center">
                        <div class="col-12 mb-2 mb-md-4">
                            <h3 class="w-100 text-center text-md-start">
                                {{ $property->agency->alias_name ?? env('APP_NAME') }}</h3>
                        </div>
                        <div class="col-12">
                            <ul class="w-100 text-center text-md-start p-0">
                                <li class="my-2"><i class="fa fa-envelope me-2"></i> <a title="Contato por e-mail"
                                        href="{{ $property->agency->email ?? 'contato@vmdimoveis.com.br' }}"
                                        target="_blank"
                                        rel="noreferrer">{{ $property->agency->email ?? 'contato@vmdimoveis.com.br' }}</a>
                                </li>
                                @php
                                    $cell = null;
                                    if (isset($property->agency->phone)) {
                                        $cell = preg_replace('/[^0-9]/', '', $property->agency->phone);
                                    }
                                @endphp
                                <li class="my-2"><i class="fab fa-whatsapp me-2"></i> <a title="Contato por WhatApp"
                                        href="https://wa.me/{{ $cell ?? '5527996235139' }}" target="_blank"
                                        rel="noreferrer">{{ $property->agency->phone ?? '+55 (27) 99623-5139' }}</a>
                                </li>
                                <li class="my-2"><i class="fa fa-map-marked-alt me-2"></i>
                                    <span>{{ $property->agency->address ?? 'Avenida Capixaba, Sl 308, Edifício Morais Business, Bairro Divino Espírito Santo, Vila Velha-ES' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="copyright">
                <div class="container py-4 d-flex justify-content-center align-items-center">
                    <p class="m-0"><a href="{{ route('web.home') }}" title="{{ env('APP_NAME') }}"
                            target="_blank">{{ env('APP_NAME') }}</a> ® {{ date('Y') }} Todos os direitos
                        reservados.</p>
                </div>
            </div>
        </section>
    </footer>

    <button aria-label="Voltar ao topo da página" title="Voltar ao topo da página" class="button-top"><i
            class="fa fa-chevron-up"></i></button>

    <script src="{{ asset('js/button-top.js') }}"></script>
</body>

</html>
