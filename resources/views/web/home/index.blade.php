@extends('web.master.master')

@section('content')
    <div class="main_slide d-none d-sm-block">
        <div class="container" style="height: 100%;">
            <div class="row align-items-center" style="height: 100%;">
                <div class="col-lg-9">
                    <p class="main_slide_content text-opposit">EXPERIÊNCIA DE ENCONTRAR O <span>IMÓVEL</span>
                        DOS <span>SONHOS</span> PARA UMA FAMÍLIA <span>FELIZ</span>!</p>
                    <a href="#" class="btn-custom-2 text-opposit" style="font-size: 1.4rem;">Quero
                        <b>Comprar</b>!</a>
                    <a href="#" class="btn-custom text-opposit" style="font-size: 1.4rem;">Quero
                        <b>Alugar</b>!</a>
                </div>
            </div>
        </div>
    </div>

    <div class="main_filter">

        Filtro
    </div>

    @if ($experiences->count() > 0)
        <section class="main_list_group py-5 bg-light">
            <div class="container">
                <div class="p-4 main_list_group_title">
                    <h1 class="text-center text-support">Ambiente no seu <span class="text-front"><b>estilo</b></span></h1>
                    <p class="text-center text-muted mb-0 h4">Encontre o imóvel com a experiência que você quer viver</p>
                </div>

                <div class="main_list_group_item row mt-5 d-flex justify-content-around">
                    @foreach ($experiences as $experience)
                        <article class="main_list_group_items_item col-12 col-md-6 col-lg-4 mb-4">
                            <a href="#">
                                <div class="d-flex align-items-center justify-content-center shadow-sm rounded"
                                    style="background: url({{ $experience->cover }}) no-repeat; background-size: cover;">
                                    <h2 class="text-opposit">{{ $experience->name }}</h2>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($propertiesForSale->count() > 0)
        <section class="main_properties py-5">
            <div class="container">
                <header class="d-flex justify-content-between align-items-center mb-5 flex-wrap">
                    <h1 class="text-front main_properties_title">À Venda</h1>
                    <a href="#" class="badge badge-front p-2 text-opposit text-decoration-none text-bold">Ver mais</a>
                </header>

                <div class="row d-flex justify-content-center">
                    @foreach ($propertiesForSale as $property)
                        @include('web.components.property-card', [
                            'property' => $property,
                            'type' => 'sale',
                        ])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($propertiesForRent->count() > 0)
        <section class="main_properties py-5 bg-light">
            <div class="container">
                <header class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="text-front main_properties_title">Para Alugar</h1>
                    <a href="#" class="badge badge-front p-2 text-opposit text-decoration-none text-bold">Ver mais</a>
                </header>

                <div class="row d-flex justify-content-center">
                    @foreach ($propertiesForRent as $property)
                        @include('web.components.property-card', [
                            'property' => $property,
                            'type' => 'rent',
                        ])
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
