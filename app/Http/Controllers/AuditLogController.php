<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditLog::with([
            'user:id,name,username,email',
            'nota:id,nomor_nota,nama_supplier',
        ])->latest();

        if ($request->filled('aksi')) {
            $query->where('aksi', $request->input('aksi'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('aksi', 'like', "%{$search}%")
                    ->orWhere('detail', 'like', "%{$search}%");
            });
        }

        $logs = $query->paginate(10)->withQueryString();

        return response()->json([
            'success' => true,
            'message' => 'Data log audit berhasil diambil.',
            'data' => $logs,
        ]);
    }
}