<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Migrante;
use App\Models\RegistroMovilidad;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Pagination\Paginator;

class ChartController extends Controller
{

    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $chart_options = [
            'chart_title' => 'Registrados por Fecha',
            'chart_type' => 'line',
            'chart_color' => '0, 0, 0',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Migrante',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
        ];

        $chart1 = new LaravelChart($chart_options);

        return view('inicio', compact('chart1'));
    }

    public function registros_movilidad()
    {
        $registros_movilidad = RegistroMovilidad::select(
            'registro_movilidads.id',
            'registro_movilidads.tipologia',
            'registro_movilidads.plan_movilidad',
            'registro_movilidads.fecha_ingreso',
            'registro_movilidads.fecha_salida',
            'registro_movilidads.locker',
            'registro_movilidads.bodega',
            'registro_movilidads.observaciones',
            'registro_movilidads.created_at',
            'registro_movilidads.updated_at',
            
        )
        ->orderBy('fecha_salida', 'asc')
        ->get();
        
        return $registros_movilidad;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
