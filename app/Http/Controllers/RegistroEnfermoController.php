<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroEnfermo;
use App\Models\Migrante;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Datatables;

class RegistroEnfermoController extends Controller
{ 

    public function __construct()
    {
        $this->middleware('can:admin.enfermos.index')->only('index');
        $this->middleware('can:admin.enfermos.create')->only('create', 'store');
        $this->middleware('can:admin.enfermos.edit')->only('edit', 'update', 'show');
        $this->middleware('can:admin.enfermos.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = RegistroEnfermo::join('users', 'registro_enfermos.usuario', 'users.id')
            ->join('migrantes', 'registro_enfermos.migrante', 'migrantes.id')
            ->select(
                'registro_enfermos.id',
                'registro_enfermos.observaciones',
                'registro_enfermos.created_at',
                'registro_enfermos.updated_at',
                'migrantes.id as id_migrante',
                'migrantes.nombre_apellido as nombre_migrante',
                'migrantes.npi as npi_migrante',
                'migrantes.edad as edad_migrante',
                'migrantes.nacionalidad as nacion_migrante',
                'users.name as nombre_usuario',
            )
            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('acciones', function($row){
                })
                ->rawColumns(['acciones'])
                ->make(true);
        }
        
        return view('registro_enfermo.index');
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

        return view('registro_enfermo.create')->with('migrantes', $migrantes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $registro_enfermo = new RegistroEnfermo();
        $registro_enfermo->migrante = $request->get('migrante');
        $registro_enfermo->observaciones = $request->get('observaciones');
        $registro_enfermo->usuario = Auth::user()->id;
        $registro_enfermo->save();
        return redirect('/registro_enfermos');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $registro_enfermo = RegistroEnfermo::where('registro_enfermos.id', '=', $id)
        ->join('users', 'registro_enfermos.usuario', 'users.id')
        ->join('migrantes', 'registro_enfermos.migrante', 'migrantes.id')
        ->select(
            'registro_enfermos.id',
            'registro_enfermos.observaciones',
            'registro_enfermos.created_at',
            'registro_enfermos.updated_at',
            'migrantes.nombre_apellido as nombre_migrante',
            'migrantes.npi as npi_migrante',
            'migrantes.edad as edad_migrante',
            'migrantes.nacionalidad as nacion_migrante',
            'users.id as id_usuario',
            'users.name as nombre_usuario',
        )
        ->first();
        
        return view('registro_enfermo.show', compact('registro_enfermo'));
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

        $registro_enfermo = RegistroEnfermo::where('registro_enfermos.id', '=', $id)
        ->join('users', 'registro_enfermos.usuario', 'users.id')
        ->join('migrantes', 'registro_enfermos.migrante', 'migrantes.id')
        ->select(
            'registro_enfermos.id',
            'registro_enfermos.observaciones',
            'registro_enfermos.created_at',
            'registro_enfermos.updated_at',
            'migrantes.nombre_apellido as nombre_migrante',
            'migrantes.npi as npi_migrantes',
            'migrantes.edad as edad_migrante',
            'migrantes.nacionalidad as nacion_migrante',
            'users.id as id_usuario',
            'users.name as nombre_usuario',
        )
        ->first();

        return view('registro_enfermo.edit')->with('registro_enfermo', $registro_enfermo)->with('migrantes', $migrantes);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $registro_enfermo = RegistroEnfermo::findOrFailOrFail($id);
        $registro_enfermo->migrante = $request->get('migrante');
        $registro_enfermo->observaciones = $request->get('observaciones');
        $registro_enfermo->usuario = $request->get('usuario');
        $registro_enfermo->save();
        return redirect('/registro_enfermos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $registro_enfermo = RegistroEnfermo::findOrFail($id);
        $registro_enfermo->delete();
        return redirect('/registro_enfermos');
    }
}
