@extends('layout.layout')
@php
    $title = 'Detail Pelanggan';
    $subTitle = 'Informasi Pelanggan';
@endphp

@section('content')
<div class="container-fluid">
    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detail Pelanggan</h5>
                    <span class="text-muted">Informasi lengkap pelanggan</span>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="f7:person"></iconify-icon>
                                </span>
                                <input type="text" class="form-control" value="{{ $customer->name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="mage:email"></iconify-icon>
                                </span>
                                <input type="email" class="form-control" value="{{ $customer->email }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Telepon</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="solar:phone-calling-linear"></iconify-icon>
                                </span>
                                <input type="text" class="form-control" value="{{ $customer->phone }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Alamat</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="mdi:map-marker"></iconify-icon>
                                </span>
                                <input type="text" class="form-control" value="{{ $customer->address }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Catatan</label>
                            <textarea class="form-control" rows="2" readonly>{{ $customer->notes }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
