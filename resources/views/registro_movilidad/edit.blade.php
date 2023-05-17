@extends('adminlte::page')

@section('title', 'Editar Registro Movilidad')

@section('content_header')
    <h1>Editar Registro</h1>
@stop

@section('content')

    <!--Form Editar-->
    <form action="{{ route('registro_movilidads.update',$registro_movilidad->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="" class="form-label">Migrante</label>
            <select id="migrante" name="migrante" class="select2-selector form-select w-100" aria-label="Default select example">
                <option class="text-muted" selected disabled>Selecciona el migrante</option>
                @foreach ($migrantes as $migrante)
                    <option value="{{$migrante->id_migrante}}">{{$migrante->npi_migrante}}: {{$migrante->nombre_migrante}}, {{$migrante->nacion_migrante}} </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Núcleo</label>
            <select id="nucleo" name="nucleo" class="form-select w-100" aria-label="Default select example">
                <option class="text-muted" selected disabled>Selecciona un núcleo</option>
                @foreach ($nucleos as $nucleo)
                    <option value="{{$nucleo->id_nucleo}}">{{$nucleo->nombre_nucleo}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Caravana</label>
            <select id="caravana" name="caravana" class="select2-selector form-select w-100" aria-label="Default select example">
                <option class="text-muted" selected disabled>Selecciona la caravana</option>
                @foreach ($caravanas as $caravana)
                    <option value="{{$caravana->id_caravana}}">{{$caravana->cod_caravana}}: {{$caravana->nombre_caravana}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tipología</label>
            <select id="tipologia" name="tipologia" class="form-select w-100" aria-label="Default select example">
                <option class="text-muted" selected disabled>Selecciona la tipologia...</option>
                    <option value="En tránsito">En tránsito</option>
                    <option value="Solicitante de asilo">Solicitante de asilo</option>
                    <option value="De retorno">De retorno</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Plan Movilidad</label>
            <input type="text" class="form-control" value="{{$registro_movilidad->plan_movilidad}}" id="plan_movilidad" name="plan_movilidad" placeholder="Plan Movilidad..." required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Fecha Ingreso</label>
            <input type="date" class="form-control" value="{{$registro_movilidad->fecha_ingreso}}" id="fecha_ingreso" name="fecha_ingreso" placeholder="Fecha Ingreso..." required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Fecha Salida</label>
            <input type="date" class="form-control" value="{{$registro_movilidad->fecha_salida}}" id="fecha_salida" name="fecha_salida" placeholder="Fecha Ingreso..." required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Locker</label>
            <input type="number" class="form-control" value="{{$registro_movilidad->locker}}" id="locker" name="locker" placeholder="Locker..." required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Bodega</label>
            <select id="bodega" name="bodega" class="form-select w-100" aria-label="Default select example">
                <option class="text-muted" selected disabled>Selecciona una opción...</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Observaciones</label>
            <textarea class="form-control" value="{{$registro_movilidad->observaciones}}" name="observaciones" id="observaciones" placeholder="Observaciones..." id="" style="height: 100px"></textarea>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Usuario</label>
            <input type="hidden" class="form-control" id="usuario" name="usuario" value="{{$registro_movilidad->id_usuario}}" readonly>
            <input type="text" class="form-control" value="{{$registro_movilidad->nombre_usuario}}" readonly>
        </div>
        <a href="/registros_movilidad" class="btn btn-danger fw-bold">
            <i class="fas fa-times-circle"></i>
            Cancelar
        </a>
        @can('admin.movilidad.edit')
            <button type="submit" href="" class="btn btn-primary fw-bold">
                <i class="fas fa-edit"></i>
                Editar
            </button>
        @endcan
    </form>
@stop

@section('footer')
    <!-- Default to the left -->
    <strong>Copyright © 2023 <a href="#">Daniel Leiva</a>. </strong>All rights reserved.
@stop

@section('css')
    <!--Styles Datatables-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.3/af-2.5.2/b-2.3.5/b-colvis-2.3.5/b-html5-2.3.5/b-print-2.3.5/cr-1.6.1/date-1.3.1/fc-4.2.1/fh-3.3.1/kt-2.8.1/r-2.4.0/rg-1.3.0/rr-1.3.2/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.1/sr-1.2.1/datatables.min.css" rel="stylesheet"/>
        
    <!--Styles Select2-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
    <!--Scripts Datatables-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/luxon/3.3.0/luxon.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.3/af-2.5.2/b-2.3.5/b-colvis-2.3.5/b-html5-2.3.5/b-print-2.3.5/cr-1.6.1/date-1.3.1/fc-4.2.1/fh-3.3.1/kt-2.8.1/r-2.4.0/rg-1.3.0/rr-1.3.2/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.1/sr-1.2.1/datatables.min.js"></script>

    <!--Scripts SweetAlert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--Scripts Select2-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!--Scripts Seleccionador Select2-->
    <script>
        $(document).ready(function(){
            $('.select2-selector').select2({
                language: "es",
                selectionCssClass: 'h-100',
                closeOnSelect: true,
            });
        });
    </script>
@stop