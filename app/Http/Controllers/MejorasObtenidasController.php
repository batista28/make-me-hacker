<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MejorasObtenidas;

// Crud simple de las mejoras
class MejorasObtenidasController extends Controller
{
    public function index()
    {
        return MejorasObtenidas::all();
    }

    public function store(Request $request)
    {
        $mejoraObtenida = MejorasObtenidas::create($request->all());
        return response()->json($mejoraObtenida, 201);
    }

    public function show($id)
    {
        return MejorasObtenidas::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $mejoraObtenida = MejorasObtenidas::findOrFail($id);
        $mejoraObtenida->update($request->all());
        return response()->json($mejoraObtenida, 200);
    }

    public function destroy($id)
    {
        MejorasObtenidas::destroy($id);
        return response()->json(null, 204);
    }
}
