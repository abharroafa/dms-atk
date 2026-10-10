@extends('layouts.app')

@section('title', 'Dashboard - ArsipNota')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan pengelolaan dokumen Toko ATK.')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-12 col-md-6 col-xl-4">
        <div class="stat-card">
            <div class="stat-label">Total Arsip Nota</div>
            <div class="stat-value">0</div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-4">
        <div class="stat-card">
            <div class="stat-label">Menunggu Verifikasi</div>
            <div class="stat-value">0</div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-4">
        <div class="stat-card">
            <div class="stat-label">Aktivitas Sistem</div>
            <div class="stat-value">0</div>
        </div>
    </div>
</div>

<div class="content-card">
    <div class="content-card-header">
        <h2 class="content-card-title">Selamat datang di ArsipNota</h2>
    </div>
    <div class="content-card-body">
        Halo, <strong>{{ auth()->user()->name }}</strong>!
        Kamu berhasil masuk ke sistem ArsipNota.

        <div class="mt-3">
            <a href="{{ route('nota.upload') }}" class="btn btn-primary">
                <i class="bi bi-cloud-arrow-up me-2"></i>Unggah Nota
            </a>
        </div>
    </div>
</div>
@endsection