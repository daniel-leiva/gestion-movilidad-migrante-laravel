<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nucleo;
use Yajra\DataTables\Datatables;

class NucleoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Nucleo::select(
                'nucleos.id',
                'nucleos.nombre',
                'nucleos.estado',
            )
            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('acciones', function($row){
                })
                ->rawColumns(['acciones'])
                ->make(true);
        }
        
        return view('nucleo.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('nucleo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nucleo = new Nucleo();
        $nucleo->nombre = $request->get('nombre');
        $nucleo->estado = $request->get('estado');
        $nucleo->save();
        return redirect('/nucleos');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $nucleo = Nucleo::findOrFail($id);
        return view('nucleo.show', compact('nucleo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $nucleo = Nucleo::findOrFail($id);
        return view('nucleo.edit')->with('nucleo', $nucleo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $nucleo = Nucleo::findOrFail($id);
        $nucleo->nombre = $request->get('nombre');
        $nucleo->estado = $request->get('estado');
        $nucleo->save();
        return redirect('/nucleos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $nucleo = Nucleo::findOrFail($id);
        $nucleo->delete();
        return redirect('/nucleos');
    }
}
