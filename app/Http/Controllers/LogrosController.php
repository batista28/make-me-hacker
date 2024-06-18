<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logros;

// CRUD simple de los logros
class LogrosController extends Controller
{
    public function index()
    {
        return Logros::all();
    }

    public function store(Request $request)
    {
        $logro = Logros::create($request->all());
        return response()->json($logro, 201);
    }

    public function show($id)
    {
        return Logros::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $logro = Logros::findOrFail($id);
        $logro->update($request->all());
        return response()->json($logro, 200);
    }

    public function destroy($id)
    {
        Logros::destroy($id);
        return response()->json(null, 204);
    }
}
