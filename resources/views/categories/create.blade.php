@extends('layout.layout')
@php
    $title = 'Tambah Kategori';
    $subTitle = 'Registrasi Kategori';
@endphp

@section('content')
<div class="container-fluid">
    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tambah Kategori</h5>
                    <span class="text-muted">Registrasi kategori baru</span>
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
                    <form method="POST" action="{{ route('categories.store') }}">
                        @csrf
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Kategori</label>
                                <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="mdi:shape-outline"></iconify-icon>
                                    </span>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Masukkan nama kategori">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="2" placeholder="Deskripsi kategori">{{ old('description') }}</textarea>
                                @error('description')
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

