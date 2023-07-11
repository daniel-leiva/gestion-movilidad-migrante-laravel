<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Migrante;
use Yajra\DataTables\Datatables;
use Illuminate\Support\Facades\Auth;

class MigranteController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.migrantes.index')->only('index', 'show');
        $this->middleware('can:admin.migrantes.create')->only('create', 'store');
        $this->middleware('can:admin.migrantes.edit')->only('edit', 'update');
        $this->middleware('can:admin.migrantes.destroy')->only('destroy');
    }


    /**
     * Display a listing of the resource.
     */
    /*public function index()
    {
        return view('migrante.index');
    }*/

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Migrante::join('users', 'migrantes.usuario', 'users.id')
            ->select(
                'migrantes.id',
                'migrantes.numero',
                'migrantes.nombre_apellido',
                'migrantes.npi',
                'migrantes.fecha_nacimiento',
                'migrantes.edad',
                'migrantes.genero',
                'migrantes.nacionalidad',
                'migrantes.estado',
                'migrantes.created_at',
                'migrantes.updated_at',
                'users.name as nombre_usuario'
            )
            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('acciones', function($row){

                })
                ->rawColumns(['acciones'])
                ->make(true);
        }
        
        return view('migrante.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('migrante.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->get("option1")=="editarEstado"){
            $migrante = Migrante::findOrFail($request->get("valorID"));
            $migrante->estado = $request->get('estado');
            $migrante->save();
            return redirect('/migrantes');
        }

        $migrante = new Migrante();
        $migrante->numero = $request->get('numero');
        $migrante->nombre_apellido = $request->get('nombre_apellido');
        $migrante->npi = $request->get('npi');
        $migrante->fecha_nacimiento = $request->get('fecha_nacimiento');
        $fecha_nacimiento = $request->get('fecha_nacimiento');
        $migrante->edad = Carbon::parse($fecha_nacimiento)->age;
        $migrante->genero = $request->get('genero');
        $migrante->nacionalidad = $request->get('nacionalidad');
        $migrante->estado = $request->get('estado');
        $migrante->usuario = Auth::user()->id;
        $migrante->save();
        return redirect('/migrantes');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        $migrante = Migrante::where('migrantes.id', '=', $id)
        ->join('users', 'migrantes.usuario', 'users.id')
        ->select(
            'migrantes.id',
            'migrantes.numero',
            'migrantes.nombre_apellido',
            'migrantes.npi',
            'migrantes.fecha_nacimiento',
            'migrantes.edad',
            'migrantes.genero',
            'migrantes.nacionalidad',
            'migrantes.estado',
            'migrantes.created_at',
            'migrantes.updated_at',
            'users.name as nombre_usuario'
        )
        ->first();
       return view('migrante.show', compact('migrante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $migrante = Migrante::where('migrantes.id', '=', $id)
        ->join('users', 'migrantes.usuario', 'users.id')
        ->select(
            'migrantes.id',
            'migrantes.numero',
            'migrantes.nombre_apellido',
            'migrantes.npi',
            'migrantes.fecha_nacimiento',
            'migrantes.edad',
            'migrantes.genero',
            'migrantes.nacionalidad',
            'migrantes.estado',
            'migrantes.created_at',
            'migrantes.updated_at',
            'users.id as id_usuario',
            'users.name as nombre_usuario'
        )
        ->first();
        return view('migrante.edit')->with('migrante', $migrante);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $migrante = Migrante::findOrFail($id);
        $migrante->numero = $request->get('numero');
        $migrante->nombre_apellido = $request->get('nombre_apellido');
        $migrante->npi = $request->get('npi');
        $migrante->fecha_nacimiento = $request->get('fecha_nacimiento');
        $migrante->edad = $request->get('edad');
        $migrante->genero = $request->get('genero');
        $migrante->nacionalidad = $request->get('nacionalidad');
        $migrante->estado = $request->get('estado');
        $migrante->usuario = $request->get('usuario');
        $migrante->save();
        return redirect('/migrantes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $migrante = Migrante::findOrFail($id);
        $migrante->delete();
        return redirect('/migrantes');
    }
}
