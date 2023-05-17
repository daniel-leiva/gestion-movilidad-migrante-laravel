<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class PermisosController extends Controller
{
    public function index(Request $request){
        $permisos = Permission::select('id', 'name')->get();
        return view('permisos.index');
    }
}
