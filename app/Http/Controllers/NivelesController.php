<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Niveles;

// Funciones basicas de CRUD
class NivelesController extends Controller
{
    public function index()
    {
        return Niveles::all();
    }

    public function store(Request $request)
    {
        $nivel = Niveles::create($request->all());
        return response()->json($nivel, 201);
    }

    public function show($id)
    {
        return Niveles::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $nivel = Niveles::findOrFail($id);
        $nivel->update($request->all());
        return response()->json($nivel, 200);
    }

    public function destroy($id)
    {
        Niveles::destroy($id);
        return response()->json(null, 204);
    }
}
