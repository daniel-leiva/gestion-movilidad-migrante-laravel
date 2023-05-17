@extends('adminlte::page')

@section('title', 'Registro Enfermos')

@section('content_header')
    <h1>Registro Enfermos</h1>
@stop

@section('content')

    <!--Botón Agregar-->
    @can('admin.enfermos.create')
        <a href="registro_enfermo/create" class="btn btn-success fw-bold">
            <i class="fas fa-plus-circle"></i>
            Agregar Registro
        </a>
    @endcan
    
    <div class="table-responsive mt-3">
        <!--TABLA CONTENIDO-->
        <table id="data-table" class="registro-enfermos-table table table-dark table-hover table-striped ">
            <thead>
                <th>Id</th>
                <th>NPI Migrante</th>
                <th>Nombre Migrante</th>
                <th>Nacionalidad Migrante</th>
                <th>Edad Migrante</th>
                <th>Observaciones</th>
                <th>Usuario</th>
                <th>Creado</th>
                <th>Modificado</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <tr>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal Eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmar Eliminación</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span>¿Estás seguro que deseas eliminar estos datos? </span>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" name="confEliminar" id="confEliminar" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
        </div>
    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/luxon/3.3.0/luxon.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.3/af-2.5.2/b-2.3.5/b-colvis-2.3.5/b-html5-2.3.5/b-print-2.3.5/cr-1.6.1/date-1.3.1/fc-4.2.1/fh-3.3.1/kt-2.8.1/r-2.4.0/rg-1.3.0/rr-1.3.2/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.1/sr-1.2.1/datatables.min.js"></script>

    <!--Scripts SweetAlert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        
    <!--Script Tabla Datatables-->
    <script type="text/javascript">
        $(document).ready(function() {
    
            //Función Llamar Modal Eliminar
            var registro_enfermo_id;
            $(document).on('click', '.delete-btn', function(){
                registro_enfermo_id = $(this).attr('id');
                $('#modalEliminar').modal('show');
                console.log(registro_enfermo_id);
            });
    
            //Función Confirmar Eliminación
            $('#confEliminar').click(function(){
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:"registro_enfermo/"+registro_enfermo_id+"/destroy",
                    beforeSend:function(){
                        $('#confEliminar');
                    },
                    success:function(data)
                    {
                        setTimeout(function(){
                        $('#modalEliminar').modal('hide');
                        table.ajax.reload();
                        $('.registro-enfermos-table').DataTable().ajax.reload();
                        }, 1000);
                    }
                })
            });
    
            //Datatables
            var table = $('#data-table').DataTable({
                ajax: "{{ route('registro_enfermos.index') }}",
                type: 'POST',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'npi_migrante', name: 'npi_migrante'},
                    {data: 'nombre_migrante', name: 'nombre_migrante'},
                    {data: 'nacion_migrante', name: 'nacion_migrante'},
                    {data: 'edad_migrante', name: 'edad_migrante'},
                    {data: 'observaciones', name: 'observaciones'},
                    {data: 'nombre_usuario', name: 'nombre_usuario'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'acciones', name: 'acciones', orderable: false, searchable: false, 
                        render: function (data, type, row) {
                        var buttons = '<div class="d-flex align-items-center">';
                        buttons += '@can('admin.enfermos.edit')<a title="Ver" href="/registro_enfermo/' + row.id + '/show" class="btn btn-sm fw-bold mr-1 bg-warning"><i class="fas fa-eye ms-auto p-2"></i></a>@endcan';
                        buttons += '@can('admin.enfermos.edit')<a title="Editar" href="/registro_enfermo/' + row.id + '/edit" class="btn btn-sm fw-bold mr-1 bg-primary"><i class="fas fa-edit ms-auto p-2"></i></a>@endcan';
                        buttons += '@can('admin.enfermos.destroy')<a title="Eliminar" type="button" id="'+ row.id +'" class="delete-btn btn btn-sm fw-bold mr-1 bg-danger"><i class="fas fa-trash-alt ms-auto p-2"></i></a>@endcan';
                        buttons += '</div>';
    
                        return buttons;
                        }
                    },
                ],
                processing: true,
                serverSide: false,
                searching: true,
                ordering: true,
                paging: true,
                info: true,
                responsive: true,
                autoWidth: false,
                scrollY: "100%",
                scrollX: "100%",
                scrollCollapse: true,
                order: [[7, 'desc']],
                lengthMenu: [[ 10, 30, 50, 100, -1], [10, 30, 50, 100, 'Todos']],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.3/i18n/es-ES.json',
                },
                columnDefs: [
                    {
                        targets: [7, 8],
                        render: DataTable.render.datetime(),
                    },
                    {
                        searchPanes: {
                            initCollapsed: true,
                            show: true,
                        },
                        targets: [1, 2, 7]
                    },
                    {
                        searchPanes: {
                            show: false
                        },
                        targets: [0, 3, 4, 5, 6, 8]
                    },
    
                ],
                dom: '<"container-fluid"<"row"<"col"P>><"row"<"col"B><"col"l><"col"f>>>rt<"row"<"col"i><"col"p>>',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        className: 'btn btn-secondary',
                        text: '<i class="fas fa-copy"></i> Copiar',
                        titleAttr: 'Copiar al portapapeles',
                        exportOptions: {
                            'columns': [1, 2, 3, 4, 5, 7]
                        },
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-success',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        titleAttr: 'Exportar a excel',
                        exportOptions: {
                            'columns': [1, 2, 3, 4, 5, 7]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-danger',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        titleAttr: 'Exportar como pdf',
                        title: 'Registro Enfermos - Casa del Migrante San José',
                        pageSize: 'LEGAL',
                        orientation: 'landscape',
                        download: 'open',
                        exportOptions: {
                            'columns': [1, 2, 3, 4, 5, 7]
                        },
                        customize: function(doc){
                            doc.content[1].table.widths =
                                Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            doc.content[1].layout = "borders";
                            doc.defaultStyle.alignment = 'center';
                            doc.styles.title = {
                                fontSize: '15',
                                alignment: 'left',
                            },
                            doc.pageMargins = [20, 20, 20, 20];
                            doc.content.splice( 1, 0, {
                                margin: [ 0, -50, 0, 0 ],
                                alignment: 'right',
                                width: 60,
                                image: 'data:image/jpeg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAABQAAD/4QNOaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA3LjEtYzAwMCA3OS5kYWJhY2JiLCAyMDIxLzA0LzE0LTAwOjM5OjQ0ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1wTU06T3JpZ2luYWxEb2N1bWVudElEPSJBQUIwQTk2QjQxOUM1NkZDRTY0NTdCNTZDQjgxODk0MSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpGMkRDRjkxRkM4N0IxMUVEQUE2MEUzM0JGMkUxQjU5QSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpGMkRDRjkxRUM4N0IxMUVEQUE2MEUzM0JGMkUxQjU5QSIgeG1wOkNyZWF0b3JUb29sPSJQaWNzQXJ0Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6YmEzODNjNTMtOTE2My01YTQzLWJiOTAtODMzMWE3MjJjMjgwIiBzdFJlZjpkb2N1bWVudElEPSJBQUIwQTk2QjQxOUM1NkZDRTY0NTdCNTZDQjgxODk0MSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pv/tAEhQ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'
                            } );
                        }
                    }
                ]
            });
    
        });
    </script>
@stop