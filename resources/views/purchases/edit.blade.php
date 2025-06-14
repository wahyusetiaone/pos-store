@extends('layout.layout')
@php
    $title = 'Ubah Pembelian';
    $subTitle = 'Edit Data Pembelian';
@endphp

@section('content')
<div class="container-fluid">
    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Ubah Pembelian</h5>
                    <span class="text-muted">Edit data pembelian</span>
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
                    <form method="POST" action="{{ route('purchases.update', $purchase->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal</label>
                                <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="mdi:calendar"></iconify-icon>
                                    </span>
                                    <input type="date" name="purchase_date" class="form-control @error('purchase_date') is-invalid @enderror" value="{{ old('purchase_date', $purchase->purchase_date) }}">
                                    @error('purchase_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Supplier</label>
                                <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="mdi:truck"></iconify-icon>
                                    </span>
                                    <input type="text" name="supplier" class="form-control @error('supplier') is-invalid @enderror" value="{{ old('supplier', $purchase->supplier) }}" placeholder="Masukkan nama supplier">
                                    @error('supplier')
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
                                    <input type="number" name="total" class="form-control @error('total') is-invalid @enderror" value="{{ old('total', $purchase->total) }}" placeholder="Masukkan total pembelian">
                                    @error('total')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Catatan</label>
                                <textarea name="note" class="form-control @error('note') is-invalid @enderror" rows="2" placeholder="Catatan pembelian">{{ old('note', $purchase->note) }}</textarea>
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

