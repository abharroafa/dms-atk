@extends('layouts.app')

@section('title', 'Log Audit - ArsipNota')
@section('page-title', 'Log Audit')
@section('page-subtitle', 'Riwayat aktivitas pengguna dalam sistem.')

@section('content')
<div class="content-card">
    <div class="content-card-body">

        {{-- Header dan pencarian --}}
        <div style="display:flex; justify-content:space-between;
                    align-items:center; gap:16px; flex-wrap:wrap;
                    margin-bottom:20px;">

            <div>
                <h3 style="margin:0 0 6px;">Riwayat Aktivitas</h3>
                <p style="margin:0; color:#777; font-size:14px;">
                    Menampilkan aktivitas yang tercatat di sistem.
                </p>
            </div>

            <form action="{{ route('audit.index') }}"
                  method="GET"
                  style="display:flex; gap:8px; flex-wrap:wrap;">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari aktivitas atau pengguna..."
                    aria-label="Cari aktivitas atau pengguna"
                    style="padding:10px 12px; border:1px solid #ddd;
                           border-radius:8px; min-width:230px;"
                >

                <button type="submit"
                        style="padding:10px 16px; border:0;
                               border-radius:8px; cursor:pointer;
                               background:#76533b; color:white;">
                    Cari
                </button>

                @if(request()->filled('search'))
                    <a href="{{ route('audit.index') }}"
                       style="padding:10px 12px; color:#76533b;
                              text-decoration:none;">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        {{-- Informasi jumlah data --}}
        <p style="font-size:14px; color:#777; margin-bottom:16px;">
            Total aktivitas ditemukan:
            <strong>{{ $logs->total() }}</strong>
        </p>

        {{-- Tabel log audit --}}
        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse;
                          font-size:14px;">

                <thead>
                    <tr style="background:#f7f2ed; text-align:left;">
                        <th style="padding:12px;">No.</th>
                        <th style="padding:12px;">Waktu</th>
                        <th style="padding:12px;">Pengguna</th>
                        <th style="padding:12px;">Aktivitas</th>
                        <th style="padding:12px;">Detail</th>
                        <th style="padding:12px;">Alamat IP</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($logs as $log)
                        <tr style="border-bottom:1px solid #eee;">
                            <td style="padding:12px;">
                                {{ $logs->firstItem() + $loop->index }}
                            </td>

                            <td style="padding:12px; white-space:nowrap;">
                                {{ $log->created_at
                                    ? $log->created_at->format('d/m/Y H:i:s')
                                    : '-' }}
                            </td>

                            <td style="padding:12px;">
                                @if($log->user)
                                    <strong>{{ $log->user->name }}</strong>
                                    <br>
                                    <span style="color:#777;">
                                        {{ $log->user->username ?? $log->user->email }}
                                    </span>
                                @else
                                    <span style="color:#999;">
                                        Pengguna tidak tersedia
                                    </span>
                                @endif
                            </td>

                            <td style="padding:12px;">
                                <span style="display:inline-block;
                                             padding:5px 9px;
                                             border-radius:6px;
                                             background:#f3e8dc;
                                             color:#76533b;">
                                    {{ str_replace('_', ' ', $log->aksi) }}
                                </span>
                            </td>

                            <td style="padding:12px; min-width:180px;">
                                @if($log->detail)
                                    @php
                                        $detail = json_decode($log->detail, true);
                                    @endphp

                                    @if(is_array($detail))
                                        @foreach($detail as $key => $value)
                                            <div>
                                                <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                                                {{ is_scalar($value) ? $value : json_encode($value) }}
                                            </div>
                                        @endforeach
                                    @else
                                        {{ $log->detail }}
                                    @endif
                                @else
                                    -
                                @endif
                            </td>

                            <td style="padding:12px;">
                                {{ $log->ip_address ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"
                                style="padding:28px; text-align:center;
                                       color:#888;">
                                @if(request()->filled('search'))
                                    Tidak ada aktivitas yang cocok dengan pencarian.
                                @else
                                    Belum ada aktivitas yang tercatat.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Navigasi halaman --}}
        @if($logs->hasPages())
            <div style="margin-top:20px;">
                {{ $logs->links() }}
            </div>
        @endif

    </div>
</div>
@endsection