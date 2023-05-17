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

    <!--
    <div id="app">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="y in lista_registros_movilidad">
                                        <th> [[ y.id ]] </th>
                                        <td> [[ y.tipologia ]] </td>
                                        <td> [[ y.plan_movilidad ]] </td>
                                        <td> [[ y.fecha_ingreso ]] </td>
                                        <td> [[ y.fecha_salida ]] </td>
                                        <td> [[ y.locker ]] </td>
                                        <td> [[ y.bodega ]] </td>
                                        <td> [[ y.observaciones ]] </td>
                                        <td> [[ y.created_at ]] </td>
                                        <td> [[ y.updated_at ]] </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->
@stop

@section('css')

@stop

@section('js')

    <!-- Script Momentjs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    <!-- Script Vuejs -->
    <!--
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    -->

    <!-- App Vuejs -->
    <!--
    <script>
        Vue.createApp({
            delimiters: ['[[', ']]'],
            data() {
                return {
                    lista_registros_movilidad: [],
                    url_registros_movilidad: 'http://127.0.0.1:8000/api/registros_movilidad',
                }
            },
            watch: {
                url_registros_movilidad: function() {
                    this.getListaRegistrosMovilidad();
                },
                
            },
            methods: {
                async getListaRegistrosMovilidad() {
                    const response = await fetch(this.url_registros_movilidad);
                    this.lista_registros_movilidad = await response.json();
                },
            },
            created() {
                this.getListaRegistrosMovilidad();
            },
        }).mount("#app");
    </script>
    -->

{!! $chart1->renderChartJsLibrary() !!}
{!! $chart1->renderJs() !!}
@stop