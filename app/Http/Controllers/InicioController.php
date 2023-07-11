<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\RegistroMovilidadController;
use App\Models\RegistroMovilidad;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Datatables;


class InicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = RegistroMovilidad::join('users', 'registro_movilidads.usuario', 'users.id')
            ->join('migrantes', 'registro_movilidads.migrante', 'migrantes.id')
            ->join('nucleos', 'registro_movilidads.nucleo', 'nucleos.id')
            ->join('caravanas', 'registro_movilidads.caravana', 'caravanas.id')
            ->select(
                'registro_movilidads.id',
                'migrantes.npi as npi_migrante',
                'migrantes.nombre_apellido as nombre_migrante',
                'migrantes.edad as edad_migrante',
                'migrantes.genero as genero_migrante',
                'migrantes.nacionalidad as nacion_migrante',
                'registro_movilidads.tipologia',
                'registro_movilidads.plan_movilidad',
                'registro_movilidads.fecha_ingreso',
                'registro_movilidads.fecha_salida',
                'migrantes.estado as estado',
                'users.name as nombre_usuario',
            )
            ->where([
                ['fecha_salida', '<', DB::raw('now()')],
                /*['estado', '==', "Dentro"],*/
            ])
            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('acciones', function($row){
                })
                ->rawColumns(['acciones'])
                ->toJson();
        }
        return view('/inicio');
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
