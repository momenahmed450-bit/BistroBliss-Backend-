<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
   
    public function index()
    {
        return response()->json(User::all(), 200);

    }

   
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'phone'    => 'nullable|string',
            'address'  => 'nullable|string',
            'role'     => ['nullable', Rule::in(['admin', 'user'])],
        ]);

        $user = User::create($validated);
        return response()->json($user, 201);
    
    }


    public function show(string $id)
    {
      return response()->json($user, 200);
    }

   
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name'     => 'sometimes|string|max:255',
            'email'    => ['sometimes', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'sometimes|string|min:8',
            'phone'    => 'nullable|string',
            'address'  => 'nullable|string',
            'role'     => ['sometimes', Rule::in(['admin', 'user'])],
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);
        return response()->json($user, 200);
    }

    public function destroy(string $id)
    {
        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
