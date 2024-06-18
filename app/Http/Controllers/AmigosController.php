<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Amigos;

// CRUD basico de amigos
class AmigosController extends Controller
{
    public function index()
    {
        return Amigos::all();
    }

    public function store(Request $request)
    {
        $amigo = Amigos::create($request->all());
        return response()->json($amigo, 201);
    }

    public function show($id)
    {
        return Amigos::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $amigo = Amigos::findOrFail($id);
        $amigo->update($request->all());
        return response()->json($amigo, 200);
    }

    public function destroy($id)
    {
        Amigos::where('id_usuario', $id)->delete();
        return response()->json(null, 204);
    }
}
