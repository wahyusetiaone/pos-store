@extends('layout.layout')
@php
    $title = 'Ubah Penjualan';
    $subTitle = 'Edit Data Penjualan';
@endphp

@section('content')
<div class="container-fluid">
    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Ubah Penjualan</h5>
                    <span class="text-muted">Edit data penjualan</span>
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
                    <form method="POST" action="{{ route('sales.update', $sale->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal</label>
                                <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="mdi:calendar"></iconify-icon>
                                    </span>
                                    <input type="date" name="sale_date" class="form-control @error('sale_date') is-invalid @enderror" value="{{ old('sale_date', $sale->sale_date) }}">
                                    @error('sale_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pelanggan</label>
                                <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="mdi:account"></iconify-icon>
                                    </span>
                                    <input type="text" name="customer_id" class="form-control @error('customer_id') is-invalid @enderror" value="{{ old('customer_id', $sale->customer_id) }}" placeholder="ID pelanggan">
                                    @error('customer_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Total</label>
                                <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="mdi:cash"></iconify-icon>
                                    </span>
                                    <input type="number" name="total" class="form-control @error('total') is-invalid @enderror" value="{{ old('total', $sale->total) }}" placeholder="Masukkan total penjualan">
                                    @error('total')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Diskon</label>
                                <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="mdi:percent"></iconify-icon>
                                    </span>
                                    <input type="number" name="discount" class="form-control @error('discount') is-invalid @enderror" value="{{ old('discount', $sale->discount) }}" placeholder="Masukkan diskon">
                                    @error('discount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Dibayar</label>
                                <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="mdi:cash-check"></iconify-icon>
                                    </span>
                                    <input type="number" name="paid" class="form-control @error('paid') is-invalid @enderror" value="{{ old('paid', $sale->paid) }}" placeholder="Jumlah dibayar">
                                    @error('paid')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Metode Pembayaran</label>
                                <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="mdi:credit-card"></iconify-icon>
                                    </span>
                                    <input type="text" name="payment_method" class="form-control @error('payment_method') is-invalid @enderror" value="{{ old('payment_method', $sale->payment_method) }}" placeholder="Tunai/Transfer/Dll">
                                    @error('payment_method')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Catatan</label>
                                <textarea name="note" class="form-control @error('note') is-invalid @enderror" rows="2" placeholder="Catatan penjualan">{{ old('note', $sale->note) }}</textarea>
                                @error('note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

