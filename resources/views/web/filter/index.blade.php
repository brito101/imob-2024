@extends('web.master.master')

@section('content')
    <div class="main_filter bg-light py-5">
        <div class="container">
            <section class="row">
                <div class="col-12">
                    <h2 class="text-front icon-search-plus mb-5">Filtro</h2>
                </div>

                <div class="col-12 col-md-4">
                    <form action="{{ route('web.filter') }}" method="post" class="w-100 p-3 bg-white mb-5 shadow-sm">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-12">
                                <label for="goal" class="mb-2 text-back">Comprar ou Alugar?</label>
                                <select class="form-select" aria-label="Escolha..." id="goal"
                                    data-url="{{ route('web.category') }}" name="goal">
                                    <option value="" disabled selected>Selecione</option>
                                    <option value="Venda">Comprar</option>
                                    <option value="Locação">Alugar</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="category" class="mb-2 text-back">O que você quer?</label>
                                <select class="form-select" aria-label="Escolha..." id="category"
                                    data-url="{{ route('web.type') }}" name="category">
                                    <option value="" disabled selected>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="type" class="mb-2 text-back">Qual o tipo do imóvel?</label>
                                <select class="form-select" aria-label="Escolha..." id="type"
                                    data-url="{{ route('web.city') }}" name="type">
                                    <option value="" disabled selected>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="city" class="mb-2 text-back">Onde você quer?</label>
                                <select class="form-select" aria-label="Escolha..." id="city"
                                    data-url="{{ route('web.city') }}" name="city">
                                    <option value="" disabled selected>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="bedrooms" class="mb-2 text-back">Quartos</label>
                                <select class="selectpicker" name="filter_bedrooms" id="bedrooms" title="Escolha..."
                                    data-index="5" data-action="#">
                                    <option disabled>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="bedrooms" class="mb-2 text-back">Suítes</label>
                                <select class="selectpicker" name="filter_suites" id="suites" title="Escolha..."
                                    data-index="6" data-action="#">
                                    <option disabled>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="bedrooms" class="mb-2 text-back">Banheiros</label>
                                <select class="selectpicker" name="filter_bathrooms" id="bathrooms" title="Escolha..."
                                    data-index="7" data-action="#">
                                    <option disabled>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="bedrooms" class="mb-2 text-back">Garagem</label>
                                <select class="selectpicker" name="filter_garage" id="garage" title="Escolha..."
                                    data-index="8" data-action="#">
                                    <option disabled>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="bedrooms" class="mb-2 text-back">Preço Base</label>
                                <select class="selectpicker" name="filter_base" id="base" title="Escolha..."
                                    data-index="9" data-action="#">
                                    <option disabled>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="bedrooms" class="mb-2 text-back">Preço Limite</label>
                                <select class="selectpicker" name="filter_limit" id="limit" title="Escolha..."
                                    data-index="10" data-action="#">
                                    <option disabled>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="col-12 text-right mt-3 button_search">
                                <button class="btn-custom text-opposit"><i class="fa fa-search me-2"></i>
                                    Pesquisar</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-12 col-md-8">
                    <section class="row main_properties">
                        @if ($properties->count())
                            @foreach ($properties as $property)
                                @include('web.components.property-card', [
                                    'property' => $property,
                                    'type' => $type,
                                    'page' => 'filter',
                                ])
                            @endforeach

                            <div class="d-flex flex-wrap justifty-content-center">
                                {{ $properties->links() }}
                            </div>
                        @else
                            <div class="col-12 p-5 bg-white shadow-sm">
                                <h2 class="text-front text-center"><i class="fa fa-frown"></i> Não encontramos nenhum
                                    imóvel para você
                                    comprar ou alugar!</h2>
                                <p class="text-center text-support">Utilize o filtro avançado para encontrar o imóvel dos
                                    seus sonhos...</p>
                            </div>
                        @endif


                    </section>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        let goal = '';
        let category = '';
        let type = '';
        let city = '';

        const goalSelect = $("#goal");
        const categorySelect = $("#category");
        const typeSelect = $("#type");
        const citySelect = $("#city");

        goalSelect.val("");
        categorySelect.val("");
        typeSelect.val("");
        citySelect.val("");

        function getData(url, field) {
            $.ajax({
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                data: {
                    goal,
                    category,
                    type,
                    city,
                },
                url,
                success: function(res) {
                    if (res) {
                        $(`#${field}`).children().remove();
                        $(`#${field}`).append(
                            `<option value="">Indiferente</option>`)
                        res.forEach(element => {
                            if (element !== null) {
                                $(`#${field}`).append(
                                    `<option value="${element}">${element}</option>`);
                            }
                        });
                    }
                },
            });
        }

        goalSelect.on('change', function() {
            goal = $(this).val();

            typeSelect.val("");            
            citySelect.val("");

            type = "";
            city = "";

            getData($(this).data('url'), 'category');
        });

        categorySelect.on('change', function() {
            category = $(this).val();
            
            citySelect.val("");

            city = "";

            getData($(this).data('url'), 'type');
        });

        typeSelect.on('change', function() {
            type = $(this).val();
            getData($(this).data('url'), 'city');
        });
    </script>
@endsection
