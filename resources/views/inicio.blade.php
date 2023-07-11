@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Chart Migrantes</h1>
@stop

@section('content')

<div class="table-responsive mt-3">
    <!--TABLA CONTENIDO-->
    <table id="data-table" class="registro-mov-table table table-dark table-hover table-striped ">
        <thead>
            <th>Id</th>
            <th>NPI Migrante</th>
            <th>Nombre Migrante</th>
            <th>Edad</th>
            <th>Género</th>
            <th>Nacionalidad</th>
            <th>Tipologia</th>
            <th>Plan de Movilidad</th>
            <th>Fecha Ingreso</th>
            <th>Fecha Salida</th>
            <th>Estado</th>
            <th>Usuario</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            <tr>
            </tr>
        </tbody>
    </table>
</div>

@stop

@section('css')
    <!--Styles Datatables-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.3/af-2.5.2/b-2.3.5/b-colvis-2.3.5/b-html5-2.3.5/b-print-2.3.5/cr-1.6.1/date-1.3.1/fc-4.2.1/fh-3.3.1/kt-2.8.1/r-2.4.0/rg-1.3.0/rr-1.3.2/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.1/sr-1.2.1/datatables.min.css" rel="stylesheet"/>
@stop

@section('js')
    <!--Scripts Datatables-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/luxon/3.3.0/luxon.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.3/af-2.5.2/b-2.3.5/b-colvis-2.3.5/b-html5-2.3.5/b-print-2.3.5/cr-1.6.1/date-1.3.1/fc-4.2.1/fh-3.3.1/kt-2.8.1/r-2.4.0/rg-1.3.0/rr-1.3.2/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.1/sr-1.2.1/datatables.min.js"></script>

<!--Script Tabla Datatables-->
<script type="text/javascript">
    $(document).ready(function() {

        //Datatables
        var table = $('#data-table').DataTable({
            ajax: "{{ route('inicio.index') }}",
            type: 'POST',
            dataType: 'json',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'npi_migrante', name: 'npi_migrante'},
                {data: 'nombre_migrante', name: 'nombre_migrante'},
                {data: 'edad_migrante', name: 'edad_migrante'},
                {data: 'genero_migrante', name: 'genero_migrante'},
                {data: 'nacion_migrante', name: 'nacion_migrante'},
                {data: 'tipologia', name: 'tipologia'},
                {data: 'plan_movilidad', name: 'plan_movilidad'},
                {data: 'fecha_ingreso', name: 'fecha_ingreso'},
                {data: 'fecha_salida', name: 'fecha_salida',
                    /*createdCell: function(td, cellData, rowData, row, col){
                        var color = (cellData === 'Dentro') ? '#198754' : '#DC3545';
                        $(tr).css('background-color', color);
                    }*/
                },
                {data: 'estado', name: 'estado'},
                {data: 'nombre_usuario', name: 'nombre_usuario'},
                {data: 'acciones', name: 'acciones', orderable: false, searchable: false}
            ],
            processing: true,
            serverSide: false,
            searching: true,
            ordering: true,
            paging: true,
            info: true,
            responsive: true,
            autoWidth: true,
            scrollY: "100%",
            scrollX: "100%",
            scrollCollapse: true,
            order: [[0, 'desc']],
            lengthMenu: [[ 10, 30, 50, 100, -1], [10, 30, 50, 100, 'Todos']],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.3/i18n/es-ES.json',
            },
        });
    });
</script>

@stop