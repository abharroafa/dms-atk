<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /**
     * Memproses pendaftaran pengguna baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'alpha_dash',
                'unique:users,username',
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(8),
            ],
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.min' => 'Username minimal 3 karakter.',
            'username.max' => 'Username maksimal 50 karakter.',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah.',
            'username.unique' => 'Username sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        // Buat akun baru dalam kondisi nonaktif.
        User::create([
            'name' => $validated['username'],
            'username' => $validated['username'],
            'email' => Str::uuid() . '@register.local',
            'password' => $validated['password'],
            'role' => 'pemilik',
            'is_active' => true,
        ]);

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Pendaftaran berhasil. Akun menunggu aktivasi oleh pengelola sebelum dapat digunakan untuk login.'
            );
    }
}