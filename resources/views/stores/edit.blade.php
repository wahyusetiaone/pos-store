@extends('layout.layout')
@php
    $title = 'Ubah Toko';
    $subTitle = 'Edit Data Toko';
@endphp

@section('content')
    <div class="container-fluid">
        <div class="row gy-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Ubah Toko</h5>
                        <span class="text-muted">Edit data toko</span>
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
                        <form method="POST" action="{{ route('stores.update', $store->id) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row gy-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Toko</label>
                                    <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="mdi:store"></iconify-icon>
                                    </span>
                                        <input type="text" name="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name', $store->name) }}" placeholder="Masukkan nama toko">
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="mdi:email"></iconify-icon>
                                    </span>
                                        <input type="email" name="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email', $store->email) }}"
                                               placeholder="Masukkan email toko">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Telepon</label>
                                    <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="mdi:phone"></iconify-icon>
                                    </span>
                                        <input type="text" name="phone"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               value="{{ old('phone', $store->phone) }}"
                                               placeholder="Masukkan nomor telepon">
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Alamat</label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror"
                                              rows="2"
                                              placeholder="Alamat toko">{{ old('address', $store->address) }}</textarea>
                                    @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea name="description"
                                              class="form-control @error('description') is-invalid @enderror" rows="2"
                                              placeholder="Deskripsi toko">{{ old('description', $store->description) }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Logo Toko</label>
                                    @if($store->logo)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $store->logo) }}" alt="Logo toko"
                                                 class="img-thumbnail" style="max-height: 100px">
                                        </div>
                                    @endif
                                    <input type="file" name="logo"
                                           class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                                    @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Foto Logo (img_logo)</label>
                                    @if($store->img_logo)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $store->img_logo) }}" alt="Foto logo"
                                                 class="img-thumbnail" style="max-height: 100px">
                                        </div>
                                    @endif
                                    <input type="file" name="img_logo"
                                           class="form-control @error('img_logo') is-invalid @enderror"
                                           accept="image/*">
                                    @error('img_logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Status</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active"
                                               value="1" {{ $store->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label">Aktif</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Management Banner Toko</h5>
                        <span class="text-muted">Edit gambar banner toko</span>
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
                            <div class="row gy-3">
                                {{-- Banner Section --}}
                                <div class="col-md-12">
                                    <label class="form-label">Banner Toko</label>
                                    <div class="row">
                                        @foreach($store->banners as $banner)
                                            <div class="col-md-3 mb-3 text-center">
                                                <img src="{{ asset('storage/' . $banner->path) }}" class="img-thumbnail mb-2" style="max-height: 100px">
                                                <form method="POST" action="{{ route('stores.banners.destroy', [$store->id, $banner->id]) }}" onsubmit="return confirm('Hapus banner ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                    <form method="POST" action="{{ route('stores.banners.store', $store->id) }}" enctype="multipart/form-data" class="mt-2">
                                        @csrf
                                        <div class="input-group">
                                            <input type="file" name="banner" class="form-control @error('banner') is-invalid @enderror" accept="image/*" required>
                                            <button class="btn btn-success" type="submit">Tambah Banner</button>
                                        </div>
                                        @error('banner')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
