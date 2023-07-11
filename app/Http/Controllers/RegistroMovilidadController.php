<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroMovilidad;
use App\Models\Migrante;
use App\Models\Caravana;
use App\Models\Nucleo;
use Yajra\DataTables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegistroMovilidadController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.movilidad.index')->only('index', 'show');
        $this->middleware('can:admin.movilidad.create')->only('create', 'store');
        $this->middleware('can:admin.movilidad.edit')->only('edit', 'update');
        $this->middleware('can:admin.movilidad.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $registro = RegistroMovilidad::where('fecha_salida', '<', DB::raw('now()'))->get();
        if ($request->ajax()) {
            $data = RegistroMovilidad::join('users', 'registro_movilidads.usuario', 'users.id')
            ->join('migrantes', 'registro_movilidads.migrante', 'migrantes.id')
            ->join('nucleos', 'registro_movilidads.nucleo', 'nucleos.id')
            ->join('caravanas', 'registro_movilidads.caravana', 'caravanas.id')
            ->select(
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
                'users.name as nombre_usuario',
                'migrantes.npi as npi_migrante',
                'migrantes.nombre_apellido as nombre_migrante',
                'migrantes.edad as edad_migrante',
                'migrantes.genero as genero_migrante',
                'migrantes.nacionalidad as nacion_migrante',
                'nucleos.nombre as nombre_nucleo',
                'caravanas.codigo as codigo_caravana',
            )
            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('acciones', function($row){
                })
                ->rawColumns(['acciones'])
                ->toJson();
        }
        return view('registro_movilidad.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $migrantes = Migrante::select(
            'migrantes.id as id_migrante',
            'migrantes.nombre_apellido as nombre_migrante',
            'migrantes.npi as npi_migrante',
            'migrantes.nacionalidad as nacion_migrante',
            'migrantes.edad as edad_migrante',
        )->get();

        $caravanas = Caravana::select(
            'caravanas.id as id_caravana',
            'caravanas.codigo as cod_caravana',
            'caravanas.nombre as nombre_caravana',
        )->get();

        $nucleos = Nucleo::select(
            'nucleos.id as id_nucleo',
            'nucleos.nombre as nombre_nucleo',
        )->get();

        return view('registro_movilidad.create')
        ->with('migrantes', $migrantes)
        ->with('nucleos', $nucleos)
        ->with('caravanas', $caravanas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $registro_movilidad = new RegistroMovilidad();
        $registro_movilidad->migrante = $request->get('migrante');
        $registro_movilidad->tipologia = $request->get('tipologia');
        $registro_movilidad->plan_movilidad = $request->get('plan_movilidad');
        $registro_movilidad->fecha_ingreso = $request->get('fecha_ingreso');
        $registro_movilidad->fecha_salida = $request->get('fecha_salida');
        $registro_movilidad->locker = $request->get('locker');
        $registro_movilidad->bodega = $request->get('bodega');
        $registro_movilidad->observaciones = $request->get('observaciones');
        if($request->has('caravana')){
            $registro_movilidad->caravana = $request->get('caravana');
        }
        else{
            $registro_movilidad->caravana = 1;
        }
        if($request->has('nucleo')){
            $registro_movilidad->nucleo = $request->get('nucleo');
        }
        else{
            $registro_movilidad->nucleo = 1;
        }
        $registro_movilidad->usuario = Auth::user()->id;
        $registro_movilidad->save();
        return redirect('/registros_movilidad');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $registro_movilidad = RegistroMovilidad::where('registro_movilidads.id', '=', $id)
        ->join('users', 'registro_movilidads.usuario', 'users.id')
        ->join('migrantes', 'registro_movilidads.migrante', 'migrantes.id')
        ->join('nucleos', 'registro_movilidads.nucleo', 'nucleos.id')
        ->join('caravanas', 'registro_movilidads.caravana', 'caravanas.id')
        ->select(
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
            'users.id as id_usuario',
            'users.name as nombre_usuario',
            'migrantes.id as id_migrante',
            'migrantes.npi as npi_migrante',
            'migrantes.nombre_apellido as nombre_migrante',
            'migrantes.edad as edad_migrante',
            'migrantes.genero as genero_migrante',
            'migrantes.nacionalidad as nacion_migrante',
            'nucleos.id as id_nucleo',
            'nucleos.nombre as nombre_nucleo',
            'caravanas.id as id_caravana',
            'caravanas.codigo as codigo_caravana',
            'caravanas.nombre as nombre_caravana',
        )
        ->first();
        
        return view('registro_movilidad.show', compact('registro_movilidad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $migrantes = Migrante::select(
            'migrantes.id as id_migrante',
            'migrantes.nombre_apellido as nombre_migrante',
            'migrantes.npi as npi_migrante',
            'migrantes.nacionalidad as nacion_migrante',
            'migrantes.edad as edad_migrante',
        )->get();

        $caravanas = Caravana::select(
            'caravanas.id as id_caravana',
            'caravanas.codigo as cod_caravana',
            'caravanas.nombre as nombre_caravana',
        )->get();

        $nucleos = Nucleo::select(
            'nucleos.id as id_nucleo',
            'nucleos.nombre as nombre_nucleo',
        )->get();

        $registro_movilidad = RegistroMovilidad::where('registro_movilidads.id', '=', $id)
        ->join('users', 'registro_movilidads.usuario', 'users.id')
        ->join('migrantes', 'registro_movilidads.migrante', 'migrantes.id')
        ->join('nucleos', 'registro_movilidads.nucleo', 'nucleos.id')
        ->join('caravanas', 'registro_movilidads.caravana', 'caravanas.id')
        ->select(
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
            'users.id as id_usuario',
            'users.name as nombre_usuario',
            'migrantes.id as id_migrante',
            'migrantes.npi as npi_migrante',
            'migrantes.nombre_apellido as nombre_migrante',
            'migrantes.edad as edad_migrante',
            'migrantes.genero as genero_migrante',
            'migrantes.nacionalidad as nacion_migrante',
            'nucleos.id as id_nucleo',
            'nucleos.nombre as nombre_nucleo',
            'caravanas.id as id_caravana',
            'caravanas.codigo as codigo_caravana',
            'caravanas.nombre as nombre_caravana',
        )
        ->first();

        return view('registro_movilidad.edit')
        ->with('registro_movilidad', $registro_movilidad)
        ->with('nucleos', $nucleos)
        ->with('caravanas', $caravanas)
        ->with('migrantes', $migrantes);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $registro_movilidad = RegistroMovilidad::findOrFail($id);
        $registro_movilidad->migrante = $request->get('migrante');
        $registro_movilidad->tipologia = $request->get('tipologia');
        $registro_movilidad->plan_movilidad = $request->get('plan_movilidad');
        $registro_movilidad->fecha_ingreso = $request->get('fecha_ingreso');
        $registro_movilidad->fecha_salida = $request->get('fecha_salida');
        $registro_movilidad->locker = $request->get('locker');
        $registro_movilidad->bodega = $request->get('bodega');
        $registro_movilidad->observaciones = $request->get('observaciones');
        $registro_movilidad->caravana = $request->get('caravana');
        $registro_movilidad->nucleo = $request->get('nucleo');
        $registro_movilidad->usuario = $request->get('usuario');
        $registro_movilidad->save();
        return redirect('/registros_movilidad');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $registro_movilidad = RegistroMovilidad::findOrFail($id);
        $registro_movilidad->delete();
        return redirect('/registro_movilidad');
    }
}
