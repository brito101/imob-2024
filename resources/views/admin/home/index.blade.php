@extends('adminlte::page')

@section('title', '- Dashboard')
@section('plugins.Chartjs', true)
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugins', true)


@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fa fa-fw fa-digital-tachograph"></i> Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if (Auth::user()->hasRole('Programador|Administrador'))
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-shield"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Administradores</span>
                                <span class="info-box-number">{{ $administrators }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-tie"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Corretores</span>
                                <span class="info-box-number">{{ $brokers }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-building"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Agências</span>
                                <span class="info-box-number">{{ $agencies }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-home"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Imóveis</span>
                                <span class="info-box-number">{{ $properties }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Last Properties --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title"><i class="fa fa-clock mr-2"></i> Últimos Imóveis Cadastrados</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body d-flex flex-wrap justify-content-center">
                            @foreach ($lastProperties as $property)
                                <div class="col-12">

                                    <div class="card card-solid">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 col-sm-6 border rounded pb-2" style="cursor: pointer;">
                                                    @if ($property->cover)
                                                        <div class="col-12">
                                                            <img src="{{ url('storage/properties/min/' . $property->cover) }}"
                                                                data-id="{{ $property->id }}" class="product-image"
                                                                alt="{{ $property->title }}">
                                                        </div>
                                                    @else
                                                        <div class="col-12">
                                                            <img src="{{ asset('img/share.webp') }}" class="product-image"
                                                                data-id="{{ $property->id }}" alt="{{ $property->title }}">
                                                        </div>
                                                    @endif
                                                    <div class="col-12 product-image-thumbs">
                                                        @foreach ($property->images->take(4) as $image)
                                                            <div class="product-image-thumb" data-id="{{ $property->id }}">
                                                                <img src="{{ url('storage/properties/album/' . $image->location) }}"
                                                                    alt="Product Image" style="cursor: :pointer;">
                                                            </div>
                                                        @endforeach

                                                        @if ($property->cover)
                                                            <div class="product-image-thumb" data-id="{{ $property->id }}">
                                                                <img src="{{ url('storage/properties/' . $property->cover) }}"
                                                                    alt="Product Image" style="cursor: :pointer;">
                                                            </div>
                                                        @else
                                                            <div class="product-image-thumb" data-id="{{ $property->id }}">
                                                                <img src="{{ asset('img/share.webp') }}"
                                                                    alt="Product Image" style="cursor: :pointer;">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <h3 class="my-3">#{{ $property->id }}:
                                                        {{ Str::limit($property->title) }}</p>
                                                        <hr>
                                                        <h4>{{ Str::limit($property->headline, 50) }}</h4>
                                                        <div class="text-muted">
                                                            <p class="mt-3">Categoria:
                                                                {{ $property->type->category->name }}</p>
                                                            <p>Tipo: {{ $property->type->name }}</p>
                                                            <p>Experiência: {{ $property->experience->name }}</p>
                                                        </div>

                                                        <div class="bg-gray py-2 px-3 mt-4">
                                                            <h2 class="mb-0">
                                                                @if (str_starts_with($property->goal, 'Venda'))
                                                                    Venda: {{ $property->sale_price }}
                                                                @endif
                                                            </h2>
                                                            <h2 class="mb-0">
                                                                @if (str_ends_with($property->goal, 'Locação'))
                                                                    Locação: {{ $property->sale_price }}
                                                                @endif
                                                            </h2>
                                                            @if ($property->condominium != 'R$ 0,00')
                                                                <h4 class="mt-0">
                                                                    <small>Condomínio: {{ $property->condominium }}</small>
                                                                </h4>
                                                            @endif
                                                        </div>
                                                        <div class="mt-4">
                                                            @can('Editar Propriedades')
                                                                <a class="btn btn-primary btn-lg btn-flat"
                                                                    href="{{ route('admin.properties.edit', ['property' => $property->id]) }}">
                                                                    <i class="fas fa-edit fa-lg"></i>
                                                                </a>
                                                            @endcan

                                                            <a class="btn btn-success btn-lg btn-flat" href="#"
                                                                target="_blank">
                                                                <i class="fas fa-eye fa-lg"></i>
                                                            </a>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <nav class="w-100">
                                                    <div class="nav nav-tabs" id="product-tab-{{ $property->id }}"
                                                        role="tablist">
                                                        <a class="nav-item nav-link active" id="product-desc-tab"
                                                            data-toggle="tab" href="#product-desc-{{ $property->id }}"
                                                            role="tab" aria-controls="product-desc"
                                                            aria-selected="true">Descrição</a>
                                                        <a class="nav-item nav-link"
                                                            id="product-rating-tab-{{ $property->id }}" data-toggle="tab"
                                                            href="#product-rating-{{ $property->id }}" role="tab"
                                                            aria-controls="product-rating"
                                                            aria-selected="false">Visualizações</a>
                                                    </div>
                                                </nav>
                                                <div class="tab-content p-3" id="nav-tabContent-{{ $property->id }}">
                                                    <div class="tab-pane fade show active"
                                                        id="product-desc-{{ $property->id }}" role="tabpanel"
                                                        aria-labelledby="product-desc-tab">
                                                        {{ Str::limit(strip_tags($property->description), 50) }}</div>
                                                    <div class="tab-pane fade" id="product-rating-{{ $property->id }}"
                                                        role="tabpanel" aria-labelledby="product-rating-tab">
                                                        {{ $property->views }}</div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

            @if (Auth::user()->hasRole('Programador|Administrador'))
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex flex-wrap justify-content-between col-12 align-content-center">
                            <h3 class="card-title align-self-center">Acessos Diário</h3>
                        </div>
                    </div>

                    @php
                        $heads = [['label' => 'Hora', 'width' => 10], 'Página', 'IP', 'User-Agent', 'Plataforma', 'Navegador', 'Usuário', 'Método'];
                        $config = [
                            'ajax' => url('/admin'),
                            'columns' => [['data' => 'time', 'name' => 'time'], ['data' => 'url', 'name' => 'url'], ['data' => 'ip', 'name' => 'ip'], ['data' => 'useragent', 'name' => 'useragent'], ['data' => 'platform', 'name' => 'platform'], ['data' => 'browser', 'name' => 'browser'], ['data' => 'name', 'name' => 'name'], ['data' => 'method', 'name' => 'method']],
                            'language' => ['url' => asset('vendor/datatables/js/pt-BR.json')],
                            'order' => [0, 'desc'],
                            'destroy' => true,
                            'autoFill' => true,
                            'processing' => true,
                            'serverSide' => true,
                            'responsive' => true,
                            'lengthMenu' => [[10, 50, 100, 500, 1000, -1], [10, 50, 100, 500, 1000, 'Tudo']],
                            'dom' => '<"d-flex flex-wrap col-12 justify-content-between"Bf>rtip',
                            'buttons' => [
                                ['extend' => 'pageLength', 'className' => 'btn-default'],
                                ['extend' => 'copy', 'className' => 'btn-default', 'text' => '<i class="fas fa-fw fa-lg fa-copy text-secondary"></i>', 'titleAttr' => 'Copiar', 'exportOptions' => ['columns' => ':not([dt-no-export])']],
                                ['extend' => 'print', 'className' => 'btn-default', 'text' => '<i class="fas fa-fw fa-lg fa-print text-info"></i>', 'titleAttr' => 'Imprimir', 'exportOptions' => ['columns' => ':not([dt-no-export])']],
                                ['extend' => 'csv', 'className' => 'btn-default', 'text' => '<i class="fas fa-fw fa-lg fa-file-csv text-primary"></i>', 'titleAttr' => 'Exportar para CSV', 'exportOptions' => ['columns' => ':not([dt-no-export])']],
                                ['extend' => 'excel', 'className' => 'btn-default', 'text' => '<i class="fas fa-fw fa-lg fa-file-excel text-success"></i>', 'titleAttr' => 'Exportar para Excel', 'exportOptions' => ['columns' => ':not([dt-no-export])']],
                                ['extend' => 'pdf', 'className' => 'btn-default', 'text' => '<i class="fas fa-fw fa-lg fa-file-pdf text-danger"></i>', 'titleAttr' => 'Exportar para PDF', 'exportOptions' => ['columns' => ':not([dt-no-export])']],
                            ],
                        ];
                    @endphp

                    <div class="card-body">
                        <x-adminlte-datatable id="table1" :heads="$heads" :heads="$heads" :config="$config" striped
                            hoverable beautify />
                    </div>
                </div>


                <div class="row px-0">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Usuários Online: <span
                                            id="onlineusers">{{ $onlineUsers }}</span></h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg" id="accessdaily">{{ $access }}</span>
                                        <span>Acessos Diários</span>
                                    </p>
                                    <p class="ml-auto d-flex flex-column text-right">
                                        <span id="percentclass"
                                            class="{{ $percent > 0 ? 'text-success' : 'text-danger' }}">
                                            <i id="percenticon"
                                                class="fas {{ $percent > 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}  mr-1"></i><span
                                                id="percentvalue">{{ $percent }}</span>%
                                        </span>
                                        <span class="text-muted">em relação ao dia anterior</span>
                                    </p>
                                </div>

                                <div class="position-relative mb-4">
                                    <div class="chartjs-size-monitor" z>
                                        <div class="chartjs-size-monitor-expand">
                                            <div class=""></div>
                                        </div>
                                        <div class="chartjs-size-monitor-shrink">
                                            <div class=""></div>
                                        </div>
                                    </div>
                                    <canvas id="visitors-chart" style="display: block; width: 489px; height: 200px;"
                                        class="chartjs-render-monitor" width="489" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

        </div>
    </section>
@endsection

@section('custom_js')
    <script>
        $(document).ready(function() {
            $('.product-image-thumb').on('click', function() {
                let element = $(this);
                let id = element.data('id');
                let image_element = element.find('img')

                console.log(id)
                $(`.product-image[data-id=${id}]`).prop('src', image_element.attr('src'))
                $(`.product-image-thumb.active[data-id=${id}]`).removeClass('active')
                $(this).addClass('active')
            })
        })
    </script>
    @if (Auth::user()->hasRole('Programador|Administrador'))
        <script>
            const ctx = document.getElementById('visitors-chart');
            if (ctx) {
                ctx.getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ({!! json_encode($chart->labels) !!}),
                        datasets: [{
                            label: 'Acessos por horário',
                            data: {!! json_encode($chart->dataset) !!},
                            borderWidth: 1,
                            borderColor: '#007bff',
                            backgroundColor: 'transparent'
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        legend: {
                            labels: {
                                boxWidth: 0,
                            }
                        },
                    },
                });

                let getData = function() {

                    $.ajax({
                        url: "{{ route('admin.home.chart') }}",
                        type: "GET",
                        success: function(data) {
                            myChart.data.labels = data.chart.labels;
                            myChart.data.datasets[0].data = data.chart.dataset;
                            myChart.update();
                            $("#onlineusers").text(data.onlineUsers);
                            $("#accessdaily").text(data.access);
                            $("#percentvalue").text(data.percent);
                            const percentclass = $("#percentclass");
                            const percenticon = $("#percenticon");
                            percentclass.removeClass('text-success');
                            percentclass.removeClass('text-danger');
                            percenticon.removeClass('fa-arrow-up');
                            percenticon.removeClass('fa-arrow-down');
                            if (parseInt(data.percent) > 0) {
                                percentclass.addClass('text-success');
                                percenticon.addClass('fa-arrow-up');
                            } else {
                                percentclass.addClass('text-danger');
                                percenticon.addClass('fa-arrow-down');
                            }
                        }
                    });
                };
                setInterval(getData, 10000);
            }
        </script>
    @endif
@endsection
