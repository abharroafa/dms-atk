<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebAuthController extends Controller
{
    /**
     * Proses login pengguna.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Cari pengguna dan periksa username serta password.
        if (!Auth::attempt($credentials)) {
            // Catat percobaan login gagal.
            AuditLog::catat(
                aksi: 'login_gagal',
                detail: [
                    'username' => $request->input('username'),
                    'keterangan' => 'Username atau password salah.',
                ],
                userId: null,
                ipAddress: $request->ip()
            );

            return back()
                ->withErrors([
                    'username' => 'Username atau password salah.',
                ])
                ->onlyInput('username');
        }

        // Perbarui session setelah login berhasil.
        $request->session()->regenerate();

        $user = Auth::user();

        // Tolak akun yang dinonaktifkan.
        if (!$user->is_active) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            AuditLog::catat(
                aksi: 'login_ditolak',
                detail: [
                    'username' => $user->username,
                    'keterangan' => 'Akun tidak aktif.',
                ],
                userId: $user->id,
                ipAddress: $request->ip()
            );

            return back()
                ->withErrors([
                    'username' => 'Akun sedang tidak aktif.',
                ])
                ->onlyInput('username');
        }

        // Simpan waktu login terakhir.
        $user->last_login_at = now();
        $user->save();

        // Catat login berhasil.
        AuditLog::catat(
            aksi: 'login',
            detail: [
                'username' => $user->username,
                'role' => $user->role,
                'keterangan' => 'Pengguna berhasil login.',
            ],
            userId: $user->id,
            ipAddress: $request->ip()
        );

        return redirect()
            ->intended(route('dashboard'));
    }

    /**
     * Proses logout pengguna.
     */
    public function logout(Request $request)
    {
        $user = Auth::user();

        // Catat logout sebelum session dihapus.
        if ($user) {
            AuditLog::catat(
                aksi: 'logout',
                detail: [
                    'username' => $user->username,
                    'role' => $user->role,
                    'keterangan' => 'Pengguna berhasil logout.',
                ],
                userId: $user->id,
                ipAddress: $request->ip()
            );
        }

        Auth::logout();

        // Hapus session lama dan buat token CSRF baru.
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Kamu berhasil logout.');
    }
}