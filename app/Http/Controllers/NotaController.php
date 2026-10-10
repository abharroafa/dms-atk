<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NotaController extends Controller
{
    public function update(Request $request, string $id)
    {
        $nota = Nota::findOrFail($id);

        if ($nota->status !== 'tersimpan') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya nota yang sudah tersimpan yang dapat diedit.',
            ], 422);
        }

        $validated = $request->validate([
            'nomor_nota' => ['sometimes', 'nullable', 'string', 'max:255'],
            'nama_supplier' => ['sometimes', 'nullable', 'string', 'max:255'],
            'tanggal_nota' => ['sometimes', 'nullable', 'date'],
            'total' => ['sometimes', 'numeric', 'min:0'],
            'kategori' => [
                'sometimes',
                'required',
                Rule::in(['dokumen_penting', 'lainnya']),
            ],
        ]);

        $sebelum = $nota->only(array_keys($validated));

        $nota->update($validated);

        AuditLog::catat(
            aksi: 'edit_nota',
            notaId: $nota->id,
            detail: [
                'sebelum' => $sebelum,
                'sesudah' => $nota->only(array_keys($validated)),
            ],
            userId: $request->user()->id,
            ipAddress: $request->ip()
        );

        return response()->json([
            'success' => true,
            'message' => 'Nota berhasil diperbarui.',
            'data' => $nota->fresh(),
        ]);
    }

    public function destroy(Request $request, string $id)
    {
        $nota = Nota::findOrFail($id);

        if ($nota->status !== 'tersimpan') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya nota yang sudah tersimpan yang dapat dihapus.',
            ], 422);
        }

        $detail = [
            'nomor_nota' => $nota->nomor_nota,
            'nama_supplier' => $nota->nama_supplier,
            'keterangan' => 'Nota dihapus menggunakan soft delete.',
        ];

        AuditLog::catat(
            aksi: 'hapus_nota',
            notaId: $nota->id,
            detail: $detail,
            userId: $request->user()->id,
            ipAddress: $request->ip()
        );

        $nota->delete();

        return response()->json([
            'success' => true,
            'message' => 'Nota berhasil dihapus.',
        ]);
    }
}