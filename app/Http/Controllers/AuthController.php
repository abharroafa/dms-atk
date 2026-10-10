<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('username', $credentials['username'])
            ->first();

        if (
            !$user ||
            !Hash::check($credentials['password'], $user->password) ||
            !$user->is_active
        ) {
            throw ValidationException::withMessages([
                'username' => ['Username atau password salah, atau akun tidak aktif.'],
            ]);
        }

        $user->forceFill([
            'last_login_at' => now(),
        ])->save();

        AuditLog::catat(
            'login',
            null,
            ['username' => $user->username],
            $user->id,
            $request->ip()
        );

        $token = $user->createToken('dms-atk')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => [
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'role' => $user->role,
                ],
            ],
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        AuditLog::catat(
            'logout',
            null,
            [],
            $user->id,
            $request->ip()
        );

        $user->currentAccessToken()?->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
        ]);
    }

    public function me(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'role' => $user->role,
            ],
        ]);
    }
}
