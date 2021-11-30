<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:user',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user',
            'password' => ['required', 'confirmed', Password::defaults()],
            'device_name' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $user->createToken($request->device_name)->plainTextToken;
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->login)
            ->orwhere('username', $request->login)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'login' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken($request->device_name)->plainTextToken;
    }

    public function logout(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->tokens()->delete();
        }

        return response()->noContent();
    }
}
