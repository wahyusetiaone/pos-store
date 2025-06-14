@extends('layout.layout')

@php
    $title = 'Tambah Pelanggan';
    $subTitle = 'Registrasi Pelanggan';
@endphp

@section('content')
<div class="container-fluid">
    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tambah Pelanggan</h5>
                    <span class="text-muted">Registrasi pelanggan baru</span>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('customers.store') }}">
                        @csrf
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama</label>
                                <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="f7:person"></iconify-icon>
                                    </span>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Masukkan nama pelanggan">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="mage:email"></iconify-icon>
                                    </span>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukkan email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Telepon</label>
                                <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="solar:phone-calling-linear"></iconify-icon>
                                    </span>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Masukkan nomor telepon">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Alamat</label>
                                <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="mdi:map-marker"></iconify-icon>
                                    </span>
                                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="Masukkan alamat">
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Catatan</label>
                                <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="2" placeholder="Catatan tambahan">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
