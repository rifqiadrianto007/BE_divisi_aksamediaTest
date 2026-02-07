<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {

        // cek jika sudah login
        if ($request->user()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah login'
            ], 403);
        }

        // validasi
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // cari admin
        $admin = Admin::where('username', $request->username)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {

            return response()->json([
                'status' => 'error',
                'message' => 'Username atau password salah'
            ], 401);

        }

        // generate token
        $token = $admin->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil',
            'data' => [
                'token' => $token,
                'admin' => [
                    'id' => $admin->id,
                    'name' => $admin->name,
                    'username' => $admin->username,
                    'phone' => $admin->phone,
                    'email' => $admin->email,
                ]
            ]
        ]);

    }

    public function logout(Request $request)
    {

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logout berhasil'
        ]);

    }

}
