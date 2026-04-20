<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * Register user baru (default role: user)
     */
   public function register(Request $request)
{
    if ($request->has('role')) {
        return ResponseHelper::error(
            'Registrasi role tidak diizinkan',
            [
                'role' => ['Role tidak boleh dikirim saat registrasi']
            ],
            403
        );
    }
     

    $validator = Validator::make($request->all(), [
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ]);

    if ($validator->fails()) {
        return ResponseHelper::error(
            'Validasi gagal',
            $validator->errors(),
            422
        );
    }

    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role'     => 'user', // 🔒 DIPAKSA
    ]);

    $token = JWTAuth::fromUser($user);

    return ResponseHelper::success([
        'user'  => $user,
        'token' => $this->respondWithToken($token),
    ], 'User berhasil registrasi', 201);
}


    /**
     * Login
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return ResponseHelper::error(
                    'Email atau password salah',
                    null,
                    401
                );
            }
        } catch (JWTException $e) {
            return ResponseHelper::error(
                'Gagal membuat token',
                null,
                500
            );
        }

        return ResponseHelper::success(
            $this->respondWithToken($token),
            'Login berhasil'
        );
    }

    /**
     * Logout
     */
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return ResponseHelper::success(
            null,
            'Logout berhasil'
        );
    }

    /**
     * Refresh token
     */
    public function refresh()
    {
        $newToken = JWTAuth::refresh(JWTAuth::getToken());

        return ResponseHelper::success(
            $this->respondWithToken($newToken),
            'Token berhasil diperbarui'
        );
    }

    /**
     * Profile user
     */
    public function me()
    {
        return ResponseHelper::success(
            JWTAuth::parseToken()->authenticate(),
            'Berhasil ambil data user'
        );
    }

    /**
     * Format token response
     */
    protected function respondWithToken($token)
    {
        $user = JWTAuth::setToken($token)->toUser();

        return [
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => JWTAuth::factory()->getTTL() * 60,
            'role'         => $user->role,
        ];
    }
    
    
    }

