@extends('adminlte::page')

@section('title', 'Editar Caravana')

@section('content_header')
    <h1>Editar Caravana</h1>
@stop

@section('content')

    <!--Form Edit-->
    <form action="{{ route('caravanas.update',$caravana->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="" class="form-label">Código</label>
            <input type="text" class="form-control" id="codigo" name="codigo" value="{{$caravana->codigo}}" readonly>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{$caravana->nombre}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Cantidad</label>
            <input type="text" class="form-control" id="cantidad" name="cantidad" value="{{$caravana->cantidad}}">
        </div>
        <a href="/caravanas" class="btn btn-danger fw-bold">
            <i class="fas fa-times-circle"></i>
            Cancelar
        </a>
        @can('admin.caravanas.edit')
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
@stop

@section('js')
    <!--Scripts Datatables-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.3/af-2.5.2/b-2.3.5/b-colvis-2.3.5/b-html5-2.3.5/b-print-2.3.5/cr-1.6.1/date-1.3.1/fc-4.2.1/fh-3.3.1/kt-2.8.1/r-2.4.0/rg-1.3.0/rr-1.3.2/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.1/sr-1.2.1/datatables.min.js"></script>
@stop