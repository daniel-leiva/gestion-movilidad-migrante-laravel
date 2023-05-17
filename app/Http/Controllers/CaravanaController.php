<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Caravana;
use Yajra\DataTables\Datatables;

class CaravanaController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.caravanas.index')->only('index', 'show');
        $this->middleware('can:admin.caravanas.create')->only('create', 'store');
        $this->middleware('can:admin.caravanas.edit')->only('edit', 'update');
        $this->middleware('can:admin.caravanas.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Caravana::select(
                'caravanas.id',
                'caravanas.codigo',
                'caravanas.nombre',
                'caravanas.cantidad',
                'caravanas.created_at',
                'caravanas.updated_at',
            )
            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('acciones', function($row){
                })
                ->rawColumns(['acciones'])
                ->make(true);
        }
        
        return view('caravana.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('caravana.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $caravana = new Caravana();
        $random = Str::random(10);
        $prefijo = 'C';
        $separador = ' - ';
        $ultimo_registro = Caravana::orderBy('id', 'DESC')->first();
        if($ultimo_registro){
            $ultimo_registro = Caravana::orderBy('id', 'DESC')->first();
            $suma_registro = $ultimo_registro['id']+1;
            $caravana->codigo = $prefijo.$suma_registro.$separador.$random;
        }
        else{
            $caravana->codigo = 'kobo';
        }
        $caravana->nombre = $request->get('nombre');
        $caravana->cantidad = $request->get('cantidad');
        $caravana->save();
        return redirect('/caravanas');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $caravana = Caravana::findOrFail($id);
        return view('caravana.show', compact('caravana'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $caravana = Caravana::findOrFail($id);
        return view('caravana.edit')->with('caravana', $caravana);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $caravana = Caravana::findOrFail($id);
        $caravana->codigo = $request->get('codigo');
        $caravana->nombre = $request->get('nombre');
        $caravana->cantidad = $request->get('cantidad');
        $caravana->save();
        return redirect('/caravanas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $caravana = Caravana::findOrFail($id);
        $caravana->delete();
        return redirect('/caravanas');
    }
}
