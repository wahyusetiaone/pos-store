@extends('layout.layout')
@php
    $title = 'Detail Pengguna';
    $subTitle = 'Informasi Pengguna';
@endphp

@section('content')
<div class="container-fluid">
    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detail Pengguna</h5>
                    <span class="text-muted">Informasi lengkap pengguna</span>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-md-12 text-center mb-3">
                            <label class="form-label">Foto Profil</label>
                            <div class="mb-2">
                                <img src="{{ $user->img_picture ? asset('storage/' . $user->img_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}" alt="Foto Profil" class="rounded-circle" style="width:100px;height:100px;object-fit:cover;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="f7:person"></iconify-icon>
                                </span>
                                <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="mage:email"></iconify-icon>
                                </span>
                                <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Role</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="mdi:account-badge"></iconify-icon>
                                </span>
                                <input type="text" class="form-control" value="{{ $user->roles->pluck('name')->join(', ') }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
