<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDesafio;
use Illuminate\Support\Facades\Auth;

class UserDesafioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'desafio_id' => 'required|exists:desafios,id',
            'complete' => 'required|boolean',
            'active' => 'required|boolean',
        ]);

        $existingDesafio = UserDesafio::where('user_id', Auth::id())
            ->where('desafio_id', $request->desafio_id)
            ->where('active', true)
            ->first();

        if ($existingDesafio) {
            return response()->json(['success' => false, 'message' => 'Ya tienes este desafio activado, no puedes tener varias veces el mismo desafio!.'], 400);
        }

        UserDesafio::create([
            'user_id' => Auth::id(),
            'desafio_id' => $request->desafio_id,
            'active' => $request->active,
            'complete' => $request->complete,
        ]);

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'complete' => 'required|boolean',
            'active' => 'required|boolean',
        ]);

        $userDesafio = UserDesafio::findOrFail($id);
        $userDesafio->update([
            'complete' => $request->complete,
            'active' => $request->active,
        ]);

        return response()->json(['success' => true]);
    }

    public function getActiveDesafios()
    {
        $userDesafios = UserDesafio::where('user_id', Auth::id())
            ->where('active', 1)
            ->get();

        return response()->json(['userDesafios' => $userDesafios]);
    }
}
