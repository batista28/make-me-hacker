<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Desafios;

// CRUD sencillo de desafios
class DesafiosController extends Controller
{
    public function index()
    {
        $desafios = Desafios::all();

        return view('desafios.index', ['desafios' => $desafios]);
    }

    public function store(Request $request)
    {
        $desafio = Desafios::create($request->all());
        return response()->json($desafio, 201);
    }

    public function show($id)
    {
        return Desafios::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $desafio = Desafios::findOrFail($id);
        $desafio->update($request->all());
        return response()->json($desafio, 200);
    }

    public function destroy($id)
    {
        Desafios::destroy($id);
        return response()->json(null, 204);
    }
}
