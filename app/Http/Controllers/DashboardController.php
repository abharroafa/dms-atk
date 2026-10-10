<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Jumlah nota yang sudah tersimpan
        $totalNota = DB::table('notas')
            ->where('status', 'tersimpan')
            ->whereNull('deleted_at')
            ->count();

        // Jumlah nota yang masih dalam proses verifikasi
        $menungguVerifikasi = DB::table('notas')
            ->where('status', 'draft')
            ->whereNull('deleted_at')
            ->count();

        // Jumlah aktivitas yang tercatat
        $aktivitasSistem = DB::table('audit_logs')
            ->count();

        return view('dashboard.index', compact(
            'totalNota',
            'menungguVerifikasi',
            'aktivitasSistem'
        ));
    }
}
