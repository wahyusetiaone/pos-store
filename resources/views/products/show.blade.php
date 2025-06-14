@extends('layout.layout')

@php
    $title = 'Detail Produk';
    $subTitle = 'Informasi Produk';
@endphp

@section('content')
<div class="container-fluid">
    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detail Produk</h5>
                    <span class="text-muted">Informasi lengkap produk</span>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Produk</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="mdi:package-variant"></iconify-icon>
                                </span>
                                <input type="text" class="form-control" value="{{ $product->name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kode SKU</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="mdi:barcode"></iconify-icon>
                                </span>
                                <input type="text" class="form-control" value="{{ $product->sku }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="mdi:shape-outline"></iconify-icon>
                                </span>
                                <input type="text" class="form-control" value="{{ $product->category->name ?? '-' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Harga</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="mdi:cash"></iconify-icon>
                                </span>
                                <input type="text" class="form-control" value="Rp {{ number_format($product->price, 0, ',', '.') }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Stok</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="mdi:warehouse"></iconify-icon>
                                </span>
                                <input type="text" class="form-control" value="{{ $product->stock }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="mdi:toggle-switch"></iconify-icon>
                                </span>
                                <input type="text" class="form-control" value="{{ $product->status ? 'Aktif' : 'Tidak Aktif' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" rows="2" readonly>{{ $product->description }}</textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Gambar Produk</label>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($product->images as $image)
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gambar Produk" style="width:80px;height:80px;object-fit:cover;">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
