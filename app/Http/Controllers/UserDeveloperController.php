<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDeveloper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Developers;
use App\Models\User;

class UserDeveloperController extends Controller
{
    public function store(Request $request)
    {
        try {
            Log::info('Store method called', ['request' => $request->all()]);

            $request->validate([
                'developer_id' => 'required|exists:developers,id',
                'active' => 'required|boolean',
            ]);

            Log::info('Validation passed');

            $developer = Developers::find($request->developer_id);
            $user = Auth::user();

            if ($user->score < $developer->precio) {
                Log::info('Insufficient score', ['user_score' => $user->score, 'developer_precio' => $developer->precio]);
                return response()->json(['success' => false, 'message' => 'No tienes suficiente dinero para contratar a este desarrollador.'], 400);
            }

            $existingDeveloper = UserDeveloper::where('user_id', $user->id)
                ->where('developer_id', $request->developer_id)
                ->where('active', true)
                ->first();

            if ($existingDeveloper) {
                Log::info('Developer already exists', ['developer_id' => $request->developer_id]);
                return response()->json(['success' => false, 'message' => 'Ya tienes este developer activado, no puedes tener varias veces el mismo developer!.'], 400);
            }

            $user->score -= $developer->precio;
            $user->save();

            UserDeveloper::create([
                'user_id' => $user->id,
                'developer_id' => $request->developer_id,
                'active' => $request->active,
            ]);

            Log::info('Developer added successfully', ['developer_id' => $request->developer_id]);

            return response()->json(['success' => true, 'new_score' => $user->score]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', ['errors' => $e->errors()]);
            return response()->json(['success' => false, 'message' => 'Validation failed.', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Failed to add developer: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Failed to add developer.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'active' => 'required|boolean',
        ]);

        $userDeveloper = UserDeveloper::findOrFail($id);
        $userDeveloper->update([
            'active' => $request->active,
        ]);

        return response()->json(['success' => true]);
    }

    public function getActiveDevelopers()
    {
        $userDevelopers = UserDeveloper::where('user_id', Auth::id())
            ->where('active', 1)
            ->get();

        return response()->json(['userDevelopers' => $userDevelopers]);
    }
}
