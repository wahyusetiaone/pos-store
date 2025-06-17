@extends('layout.layout')
@php
    $title = 'Ubah Pengiriman';
    $subTitle = 'Edit Data Pengiriman';
@endphp

@section('content')
<div class="container-fluid">
    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Ubah Pengiriman</h5>
                    <span class="text-muted">Edit data pengiriman</span>
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
                    <form method="POST" action="{{ route('shippings.update', $shipping->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal</label>
                                <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="mdi:calendar"></iconify-icon>
                                    </span>
                                    <input type="date" name="shipping_date" class="form-control @error('shipping_date') is-invalid @enderror" value="{{ old('shipping_date', $shipping->shipping_date) }}">
                                    @error('shipping_date')
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
                                    <input type="text" name="supplier" class="form-control @error('supplier') is-invalid @enderror" value="{{ old('supplier', $shipping->supplier) }}" placeholder="Masukkan nama supplier">
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
                                    <input type="number" name="total" class="form-control @error('total') is-invalid @enderror" value="{{ old('total', $shipping->total) }}" placeholder="Masukkan total pengiriman">
                                    @error('total')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="drafted" {{ $shipping->status == 'drafted' ? 'selected' : '' }}>Draft</option>
                                    <option value="shipped" {{ $shipping->status == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                                    <option value="completed" {{ $shipping->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Catatan</label>
                                <textarea name="note" class="form-control @error('note') is-invalid @enderror" rows="2" placeholder="Catatan pengiriman">{{ old('note', $shipping->note) }}</textarea>
                                @error('note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <a href="{{ route('shippings.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
