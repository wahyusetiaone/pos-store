@extends('layout.layout')
@php
    $title = 'Detail Toko';
    $subTitle = 'Informasi Toko';
    $script = '<script>
        document.getElementById("copyStoreLink").addEventListener("click", function() {
            const url = `${window.location.origin}/shop?store=' . urlencode($store->name) . '`;
            navigator.clipboard.writeText(url).then(function() {
                alert("Link toko berhasil disalin!");
            });
        });
    </script>';
@endphp

@section('content')
    <div class="container-fluid">
        <div class="row gy-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-0">Detail Toko</h5>
                            <span class="text-muted">Informasi lengkap toko</span>
                        </div>
                        <button class="btn btn-outline-primary" id="copyStoreLink">
                            <i class="bi bi-clipboard"></i> Copy Link Toko
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">
                            @if($store->logo)
                                <div class="col-md-12 text-center mb-4">
                                    <img src="{{ asset('storage/' . $store->logo) }}" alt="Logo toko"
                                         class="img-thumbnail" style="max-height: 200px">
                                </div>
                            @endif
                            @if($store->img_logo)
                                <div class="col-md-12 text-center mb-4">
                                    <img src="{{ asset('storage/' . $store->img_logo) }}" alt="Foto logo toko"
                                         class="img-thumbnail" style="max-height: 200px">
                                </div>
                            @endif
                            <div class="col-md-6">
                                <label class="form-label">Nama Toko</label>
                                <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="mdi:store"></iconify-icon>
                                </span>
                                    <input type="text" class="form-control" value="{{ $store->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="mdi:email"></iconify-icon>
                                </span>
                                    <input type="text" class="form-control" value="{{ $store->email }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. Telepon</label>
                                <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="mdi:phone"></iconify-icon>
                                </span>
                                    <input type="text" class="form-control" value="{{ $store->phone }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <input type="text" class="form-control"
                                       value="{{ $store->is_active ? 'Aktif' : 'Nonaktif' }}" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" rows="2" readonly>{{ $store->address }}</textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" rows="2" readonly>{{ $store->description }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Jumlah Produk</label>
                                <input type="text" class="form-control" value="{{ $store->products->count() }}"
                                       readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Total Penjualan</label>
                                <input type="text" class="form-control" value="{{ $store->sales->count() }}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Total Pengguna</label>
                                <input type="text" class="form-control" value="{{ $store->users->count() }}" readonly>
                            </div>
                        </div>
                        <div class="row gy-3">
                            {{-- Banner Section --}}
                            @if($store->banners->count())
                                <div class="col-md-12 mb-4">
                                    <label class="form-label">Banner Toko</label>
                                    <div class="row">
                                        @foreach($store->banners as $banner)
                                            <div class="col-md-3 mb-3 text-center">
                                                <img src="{{ asset('storage/' . $banner->path) }}" class="img-thumbnail"
                                                     style="max-height: 120px">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
