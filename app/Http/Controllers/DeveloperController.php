<?php

namespace App\Http\Controllers;

use App\Models\Developers;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function index()
    {
        $developers = Developers::all();
        return view('developers.index', compact('developers'));
    }

    public function create()
    {
        return view('developers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'mejora' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
        ]);

        Developers::create($request->all());
        return redirect()->route('developers.index')->with('success', 'Developer created successfully.');
    }

    public function show(Developers $developer)
    {
        return view('developers.show', compact('developer'));
    }

    public function edit(Developers $developer)
    {
        return view('developers.edit', compact('developer'));
    }

    public function update(Request $request, Developers $developer)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'mejora' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
        ]);

        $developer->update($request->all());
        return redirect()->route('developers.index')->with('success', 'Developer updated successfully.');
    }

    public function destroy(Developers $developer)
    {
        $developer->delete();
        return redirect()->route('developers.index')->with('success', 'Developer deleted successfully.');
    }
}
