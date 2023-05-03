@extends('adminlte::page')

@section('title', 'Ver Núcleo')

@section('content_header')
    <h1>Ver Núcleo</h1>
@stop

@section('content')

    <!--Botón Regresar-->
    <a href="{{ route('nucleos.index')}}" class="btn btn-secondary fw-bold">
        <i class="fas fa-undo"></i>
        Regresar
    </a>

    <!--Tabla Contenido-->
    <div class="table-responsive mt-3">
        <table id="nucleos" class="table table-dark table-striped ">
            <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <tr>
                    <td> {{ $nucleo->id }} </td>
                    <td> {{ $nucleo->nombre }} </td>
                    <td> {{ $nucleo->estado }} </td>
                    <td>
                        <form action="{{ route ('nucleos.destroy', $nucleo->id) }}" method="POST">
                            <a href="/nucleo/{{ $nucleo->id }}/edit" class="btn btn-primary fw-bold">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger fw-bold" data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                <i class="fas fa-trash-alt"></i>
                            </a>

                            <!-- Modal Eliminar -->
                            <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 fw-bold text-dark" id="exampleModalLabel">Confirmar Eliminación</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-dark fw-semibold">
                                        <span>¿Estás seguro que deseas eliminar estos datos?</span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">
                                            <i class="fas fa-times-circle"></i>
                                            Cancelar
                                        </button>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger fw-bold">
                                            <i class="fas fa-trash-alt"></i>
                                            Eliminar
                                        </button>
                                    </div>
                                </div>
                                </div>
                            </div>

                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
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
    <script>
        $(document).ready( function () {
            $('#nucleos').DataTable({
                'language': {
                    'url': 'https://cdn.datatables.net/plug-ins/1.13.3/i18n/es-ES.json',
                },
                'searching': false,
                'ordering': false,
                'paging': false,
                'info': false,
                'responsive': true,
                'autoWidth': true

            });
        } );
    </script>

@stop