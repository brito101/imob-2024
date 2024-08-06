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

    <main class="container py-5">

        @if ($property->differentials_resume)
            <section id="differentials">
                <h3>Caracterísiticas do imóvel</h3>
                <div>
                    {!! $property->differentials_resume !!}
                </div>
            </section>
        @endif

        @if ($property->images->count() > 0 && $property->video)
            <section class="pt-5 pb-3">
                <div class="col-12 col-lg-8">
                    <div id="carouselProperty" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @if (count($property->images) > 0)
                                @foreach ($property->images as $image)
                                    <li data-target="#carouselProperty" data-slide-to="{{ $loop->iteration - 1 }}"
                                        {!! $loop->iteration == 1 ? 'class="active"' : '' !!}></li>
                                @endforeach
                            @endif
                        </ol>

                        <div class="carousel-inner">
                            @if (count($property->images) > 0)
                                @foreach ($property->images->sortBy('order') as $image)
                                    <div class="carousel-item {{ $loop->iteration == 1 ? 'active' : '' }}">

                                        @if ($image->type == 'cover')
                                            <a href="{{ url('storage/properties/' . $image->location) }}"
                                                data-toggle="lightbox" data-gallery="property-gallery" data-type="image"
                                                target="_blank">
                                                <img src="{{ url('storage/properties/' . $image->location) }}"
                                                    class="d-block w-100" alt="{{ $property->title }}">
                                            </a>
                                        @else
                                            <a href="{{ url('storage/properties/album/' . $image->location) }}"
                                                data-toggle="lightbox" data-gallery="property-gallery" data-type="image"
                                                target="_blank">
                                                <img src="{{ url('storage/properties/album/' . $image->location) }}"
                                                    class="d-block w-100" alt="{{ $property->title }}">
                                            </a>
                                        @endif

                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <a class="carousel-control-prev" href="#carouselProperty" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselProperty" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Próximo</span>
                        </a>
                    </div>
                </div>
            </section>
        @endif

        @if ($property->neighborhood)
            <section class="pt-5" id="neighborhood">
                <p>Agende uma visita e venha conhecer seu novo lar no bairro {{ $property->neighborhood }}.</p>
            </section>
        @endif

    </main>

    <footer id="footer">
        <div class="container py-4 px-0">
            <div class="d-flex flex-wrap justify-content-center">
                <div class="col-12 col-md-5 d-flex  align-items-center p-2">
                    <div><i class="fa fa-map-marked-alt me-4"></i></div>
                    <div>
                        <p class="m-0">Avenida Capixaba, Sl 308, Edifício Morais Business,</p>
                        <p class="m-0">Bairro Divino Espírito Santo,</p>
                        <p class="m-0">Vila Velha-ES</p>
                    </div>
                </div>
                <div class="col-12 col-md-3 d-flex align-items-center p-2">
                    <div><i class="fa fa-clock me-4"></i></div>
                    <div>
                        <p class="m-0">Seg/Sex: 09:00h - 19:00h</p>
                        <p class="m-0">Sáb/Dom: Plantão</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 d-flex align-items-center p-2">
                    <div><i class="fa fa-envelope me-4"></i></div>
                    <div>
                        <p class="m-0">contato@vmdimoveis.com.br</p>
                        <p class="m-0">+55 (27) 99623-5139</p>
                        <p class="m-0">+55 (27) 99244-0238</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <button aria-label="Voltar ao topo da página" title="Voltar ao topo da página" class="button-top"><i
            class="fa fa-chevron-up"></i></button>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('js/button-top.js') }}"></script>
</body>

</html>
