<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroConducta;
use App\Models\Migrante;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Datatables;

class RegistroConductaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = RegistroConducta::join('users', 'registro_conductas.usuario', 'users.id')
            ->join('migrantes', 'registro_conductas.migrante', 'migrantes.id')
            ->select(
                'registro_conductas.id',
                'registro_conductas.observaciones',
                'registro_conductas.created_at',
                'registro_conductas.updated_at',
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
        
        return view('registro_conducta.index');
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

        return view('registro_conducta.create')->with('migrantes', $migrantes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $registro_conducta = new RegistroConducta();
        $registro_conducta->migrante = $request->get('migrante');
        $registro_conducta->observaciones = $request->get('observaciones');
        $registro_conducta->usuario = Auth::user()->id;
        $registro_conducta->save();
        return redirect('/registros_conducta');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $registro_conducta = RegistroConducta::where('registro_conductas.id', '=', $id)
        ->join('users', 'registro_conductas.usuario', 'users.id')
        ->join('migrantes', 'registro_conductas.migrante', 'migrantes.id')
        ->select(
            'registro_conductas.id',
            'registro_conductas.observaciones',
            'registro_conductas.created_at',
            'registro_conductas.updated_at',
            'migrantes.nombre_apellido as nombre_migrante',
            'migrantes.npi as npi_migrante',
            'migrantes.edad as edad_migrante',
            'migrantes.nacionalidad as nacion_migrante',
            'users.id as id_usuario',
            'users.name as nombre_usuario',
        )
        ->first();
        
        return view('registro_conducta.show', compact('registro_conducta'));
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

        $registro_conducta = RegistroConducta::where('registro_conductas.id', '=', $id)
        ->join('users', 'registro_conductas.usuario', 'users.id')
        ->join('migrantes', 'registro_conductas.migrante', 'migrantes.id')
        ->select(
            'registro_conductas.id',
            'registro_conductas.observaciones',
            'registro_conductas.created_at',
            'registro_conductas.updated_at',
            'migrantes.nombre_apellido as nombre_migrante',
            'migrantes.npi as npi_migrantes',
            'migrantes.edad as edad_migrante',
            'migrantes.nacionalidad as nacion_migrante',
            'users.id as id_usuario',
            'users.name as nombre_usuario',
        )
        ->first();

        return view('registro_conducta.edit')->with('registro_conducta', $registro_conducta)->with('migrantes', $migrantes);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $registro_conducta = RegistroConducta::findOrFailOrFail($id);
        $registro_conducta->migrante = $request->get('migrante');
        $registro_conducta->observaciones = $request->get('observaciones');
        $registro_conducta->usuario = $request->get('usuario');
        $registro_conducta->save();
        return redirect('/registros_conducta');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $registro_conducta = RegistroConducta::findOrFailOrFail($id);
        $registro_conducta->delete();
        return redirect('/registros_conducta');
    }
}
