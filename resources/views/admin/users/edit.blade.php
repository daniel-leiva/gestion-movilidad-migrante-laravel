@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <h1>Asignar un Rol</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong> {{session('info')}} </strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <p class="h5">Nombre</p>
            <p class="form-control"> {{ $user->name }} </p>

            <h2 class="h5">Listado de Roles</h2>
            {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put']) !!}
                @foreach ($roles as $role)
                    <div>
                        <label>
                            {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                            {{$role->name}}
                        </label>
                    </div>
                @endforeach
                {!! Form::submit('Asignar Rol', ['class' => 'btn btn-success mt-2']) !!}
            {!! Form::close() !!}
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

@stop