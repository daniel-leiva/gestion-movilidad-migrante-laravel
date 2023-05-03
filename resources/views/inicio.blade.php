@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Chart Migrantes</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        <h1>{{ $chart1->options['chart_title'] }}</h1>
                        {!! $chart1->renderHtml() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="app">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h1>Últimos Registros</h1>
                            <table class="table table-responsive table-dark table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>No.</th>
                                        <th>Nombre</th>
                                        <th>NPI</th>
                                        <th>Fecha Nacimiento</th>
                                        <th>Edad</th>
                                        <th>Género</th>
                                        <th>Nacionalidad</th>
                                        <th>Estado</th>
                                        <th>Creado</th>
                                        <th>Modificado</th>
                                        <th>Usuario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="x in lista_migrantes" :key="x.id">
                                        <th> [[ x.id ]] </th>
                                        <td> [[ x.numero ]] </td>
                                        <td> [[ x.nombre_apellido ]] </td>
                                        <td> [[ x.npi ]] </td>
                                        <td> [[ x.fecha_nacimiento ]] </td>
                                        <td> [[ x.edad ]] </td>
                                        <td> [[ x.genero ]] </td>
                                        <td> [[ x.nacionalidad ]] </td>
                                        <td v-show="x.estado === 'Dentro'" class="bg-success"> [[ x.estado ]] </td>
                                        <td v-show="x.estado === 'Fuera'" class="bg-danger"> [[ x.estado ]] </td>
                                        <td> [[ x.created_at ]] </td>
                                        <td> [[ x.updated_at ]] </td>
                                        <td> [[ x.nombre_usuario ]] </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h1>Fecha de Salida Vencida</h1>
                            <table class="table table-responsive table-dark table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>NPI Migrante</th>
                                        <th>Nombre Migrante</th>
                                        <th>Edad</th>
                                        <th>Género</th>
                                        <th>Nacionalidad</th>
                                        <th>Núcleo</th>
                                        <th>Código Caravana</th>
                                        <th>Tipologia</th>
                                        <th>Plan de Movilidad</th>
                                        <th style="width: 1000px">Fecha Ingreso</th>
                                        <th>Fecha Salida</th>
                                        <th>Locker</th>
                                        <th>Bodega</th>
                                        <th>Observaciones</th>
                                        <th>Creado</th>
                                        <th>Modificado</th>
                                        <th>Usuario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th> [[ y.id ]] </th>
                                        <td> [[ y.npi_migrante ]] </td>
                                        <td> [[ y.nombre_migrante ]] </td>
                                        <td> [[ y.edad_migrante ]] </td>
                                        <td> [[ y.genero_migrante ]] </td>
                                        <td> [[ y.nacion_migrante ]] </td>
                                        <td> [[ y.nombre_nucleo ]] </td>
                                        <td> [[ y.codigo_caravana ]] </td>
                                        <td> [[ y.tipologia ]] </td>
                                        <td> [[ y.plan_movilidad ]] </td>
                                        <td> [[ y.fecha_ingreso ]] </td>
                                        <td> [[ y.fecha_salida ]] </td>
                                        <td> [[ y.locker ]] </td>
                                        <td> [[ y.bodega ]] </td>
                                        <td> [[ y.observaciones ]] </td>
                                        <td> [[ y.created_at ]] </td>
                                        <td> [[ y.updated_at ]] </td>
                                        <td> [[ y.nombre_usuario ]] </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

    <!-- Script Momentjs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    <!-- Script Vuejs -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

    <!-- App Vuejs -->
    <script>
        Vue.createApp({
            delimiters: ['[[', ']]'],
            data() {
                return {
                    lista_migrantes: [],
                    lista_registros_movilidad: [],
                    url_migrantes: 'http://127.0.0.1:8000/api/migrantes',
                    url_registros_movilidad: 'http://127.0.0.1:8000/api/registros_movilidad',
                }
            },
            watch: {
                url_migrantes: function() {
                    this.getListaMigrantes();
                },
                url_registros_movilidad: function() {
                    this.getListaRegistrosMovilidad();
                },
                
            },
            methods: {
                async getListaMigrantes() {
                    const response = await fetch(this.url_migrantes);
                    this.lista_migrantes = await response.json();
                },
                async getListaRegistrosMovilidad() {
                    const response = await fetch(this.url_registros_movilidad);
                    this.lista_registros_movilidad = await response.json();
                },
            },
            created() {
                this.getListaMigrantes();
                this.getListaRegistrosMovilidad();
            },
        }).mount("#app");
        </script>

{!! $chart1->renderChartJsLibrary() !!}
{!! $chart1->renderJs() !!}
@stop