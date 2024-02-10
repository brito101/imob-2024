@extends('adminlte::page')

@section('title', '- Criar Propriedade')
@section('plugins.BootstrapSwitch', true)
@section('plugins.BsCustomFileInput', true)
@section('plugins.Summernote', true)
@section('plugins.select2', true)
@section('plugins.BootstrapSelect', true)
@section('plugins.Summernote', true)

@section('adminlte_css')
    <style>
        li[aria-disabled='true'] {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection



@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-fw fa-home"></i> Criar Propriedade</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.properties.index') }}">Propriedades</a></li>
                        <li class="breadcrumb-item active">Criar Propriedade</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    @include('components.alert')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Dados Cadastrais da Propriedade</h3>
                        </div>

                        <form method="POST" action="{{ route('admin.properties.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                {{-- 'sale', 'rent' --}}
                                <div class="d-flex flex-wrap justify-content-start">
                                    <div class="col-12 col-md-6 form-group px-0 pr-md-2">
                                        <label for="title">Título</label>
                                        <input type="text" class="form-control" id="title"
                                            placeholder="Título do Anúncio" name="title" value="{{ old('title') }}"
                                            required>
                                    </div>

                                    <div class="col-12 col-md-6 form-group px-0 pl-md-2">
                                        <label for="headline">Headline</label>
                                        <input type="text" class="form-control" id="headline"
                                            placeholder="Texto da headline" name="headline" value="{{ old('headline') }}"
                                            required>
                                    </div>

                                    <div class="col-12 form-group px-0">
                                        <x-adminlte-input-file name="cover" label="Imagem de capa"
                                            placeholder="Selecione uma imagem..." legend="Selecionar" />
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 pr-md-2">
                                        <label for="type_id">Tipo</label>
                                        <x-adminlte-select2 name="type_id" id="type_id" data-placeholder="Selecione..."
                                            required>
                                            @foreach ($types as $type)
                                                <option {{ old('type_id') == $type->id ? 'selected' : '' }}
                                                    value="{{ $type->id }}" data-category={{ $type->category_id }}>
                                                    {{ $type->name }}</option>
                                            @endforeach
                                        </x-adminlte-select2>
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 px-md-2">
                                        <label for="experience">Experiência</label>
                                        <x-adminlte-select2 name="experience" id="experience_id" required>
                                            @foreach ($experiences as $experience)
                                                <option {{ old('experience_id') == $experience->id ? 'selected' : '' }}
                                                    value="{{ $experience->id }}">{{ $experience->name }}</option>
                                            @endforeach
                                        </x-adminlte-select2>
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 px-md-2">
                                        <label for="goal">Finalidade</label>
                                        <x-adminlte-select2 name="experience" id="goal_id" required>
                                            <option {{ old('goal') == 'Venda' ? 'selected' : '' }}>Venda</option>
                                            <option {{ old('goal') == 'Locação' ? 'selected' : '' }}>Locação</option>
                                            <option {{ old('goal') == 'Venda ou Locação' ? 'selected' : '' }}>Venda ou
                                                Locação</option>
                                        </x-adminlte-select2>
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 pl-md-2">
                                        <label for="status_id">Status</label>
                                        <x-adminlte-select2 name="status" id="status_id" required>
                                            <option {{ old('status') == 'Disponível' ? 'selected' : '' }}>Disponível
                                            </option>
                                            <option {{ old('Indisponível') == 'Indisponível' ? 'selected' : '' }}>
                                                Indisponível
                                            </option>
                                        </x-adminlte-select2>
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 pr-md-2">
                                        <label for="sale_price">Valor de Venda</label>
                                        <input type="text" class="form-control money_format_2" id="sale_price"
                                            placeholder="R$" name="sale_price" value="{{ old('sale_price') }}">
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 px-md-2">
                                        <label for="rent_price">Valor de Locação</label>
                                        <input type="text" class="form-control money_format_2" id="rent_price"
                                            placeholder="R$" name="rent_price" value="{{ old('rent_price') }}">
                                    </div>

                                    <div class="col-12 col-md-3 form-group px-0 pl-md-2">
                                        <label for="condominium">Valor de Condomínio</label>
                                        <input type="text" class="form-control money_format_2" id="condominium"
                                            placeholder="R$" name="condominium" value="{{ old('condominium') }}">
                                    </div>

                                    <div class="col-12 form-group px-0">
                                        <label for="owner">Proprietário</label>
                                        <input type="text" class="form-control" id="owner"
                                            placeholder="Dados do Proprietário (facultativo)" name="owner"
                                            value="{{ old('owner') }}">
                                    </div>

                                    @php
                                        $config = [
                                            'height' => '100',
                                            'toolbar' => [
                                                // [groupName, [list of button]]
                                                ['style', ['style']],
                                                ['font', ['bold', 'underline', 'clear']],
                                                ['fontsize', ['fontsize']],
                                                ['fontname', ['fontname']],
                                                ['color', ['color']],
                                                ['para', ['ul', 'ol', 'paragraph']],
                                                ['height', ['height']],
                                                ['table', ['table']],
                                                ['insert', ['link', 'picture', 'video']],
                                                ['view', ['fullscreen', 'codeview', 'help']],
                                            ],
                                            'inheritPlaceholder' => true,
                                        ];
                                    @endphp

                                    <div class="col-12 cform-group px-0">
                                        <x-adminlte-text-editor name="description" label="Descrição"
                                            label-class="text-black" igroup-size="md" placeholder="Texto descritivo..."
                                            :config="$config">
                                            {!! old('description') !!}
                                        </x-adminlte-text-editor>
                                    </div>

                                    <div class="col-12 px-0">
                                        <label for="differentials">Diferenciais</label>
                                        <div class="d-flex flex-wrap justify-content-start">
                                            @foreach ($differentials as $differential)
                                                <div class="col-12 col-md-4">
                                                    <div class="card p-0">
                                                        <div class="card-body icheck-primary">
                                                            <input type="checkbox"
                                                                name="differential_{{ $differential->id }}"
                                                                id="differential_{{ $differential->id }}">
                                                            <label for="differential_{{ $differential->id }}"
                                                                class="my-0 ml-2">{{ $differential->name }}</label>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('custom_js')
    <script src="{{ asset('vendor/jquery/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('js/money.js') }}"></script>
@endsection
