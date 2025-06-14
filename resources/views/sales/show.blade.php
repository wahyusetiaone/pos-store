@extends('layout.layout')
@php
    $title = 'Detail Penjualan';
    $subTitle = 'Informasi Penjualan';
@endphp

@section('content')
<div class="container-fluid">
    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detail Penjualan</h5>
                    <span class="text-muted">Informasi lengkap penjualan</span>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="mdi:calendar"></iconify-icon>
                                </span>
                                <input type="text" class="form-control" value="{{ $sale->sale_date }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pelanggan</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="mdi:account"></iconify-icon>
                                </span>
                                <input type="text" class="form-control" value="{{ $sale->customer->name ?? '-' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Total</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="mdi:cash"></iconify-icon>
                                </span>
                                <input type="text" class="form-control" value="Rp {{ number_format($sale->total, 0, ',', '.') }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Diskon</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="mdi:percent"></iconify-icon>
                                </span>
                                <input type="text" class="form-control" value="Rp {{ number_format($sale->discount, 0, ',', '.') }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Dibayar</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="mdi:cash-check"></iconify-icon>
                                </span>
                                <input type="text" class="form-control" value="Rp {{ number_format($sale->paid, 0, ',', '.') }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Metode Pembayaran</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="mdi:credit-card"></iconify-icon>
                                </span>
                                <input type="text" class="form-control" value="{{ ucfirst($sale->payment_method) }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Catatan</label>
                            <textarea class="form-control" rows="2" readonly>{{ $sale->note }}</textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">User</label>
                            <input type="text" class="form-control" value="{{ $sale->user->name ?? '-' }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

