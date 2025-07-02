@extends('layout.layout')
@php
    $title = 'Ubah Pengguna';
    $subTitle = 'Edit Data Pengguna';
@endphp

@section('content')
<div class="container-fluid">
    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Ubah Pengguna</h5>
                    <span class="text-muted">Edit data pengguna</span>
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
                    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama</label>
                                <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="f7:person"></iconify-icon>
                                    </span>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" placeholder="Masukkan nama pengguna">
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
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" placeholder="Masukkan email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password (Kosongkan jika tidak diubah)</label>
                                <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="mdi:lock"></iconify-icon>
                                    </span>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password baru">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Role</label>
                                <div class="icon-field">
                                    <span class="icon">
                                        <iconify-icon icon="mdi:account-badge"></iconify-icon>
                                    </span>
                                    <select name="role" class="form-control @error('role') is-invalid @enderror">
                                        <option value="">Pilih role</option>
                                        <option value="owner" {{ old('role', $user->role) == 'owner' ? 'selected' : '' }}>Owner</option>
                                        <option value="admin_store" {{ old('role', $user->role) == 'admin_store' ? 'selected' : '' }}>Admin Toko</option>
                                        <option value="purchase" {{ old('role', $user->role) == 'purchase' ? 'selected' : '' }}>Purchase</option>
                                        <option value="cashier" {{ old('role', $user->role) == 'cashier' ? 'selected' : '' }}>Kasir</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 text-center mb-3">
                                <label class="form-label">Foto Profil</label>
                                <div class="mb-2">
                                    <img id="imgPreview" src="{{ $user->img_picture ? asset('storage/' . $user->img_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}" alt="Preview" class="rounded-circle" style="width:100px;height:100px;object-fit:cover;">
                                </div>
                                <input type="file" name="img_picture" class="form-control @error('img_picture') is-invalid @enderror" accept="image/*" onchange="previewImage(event)">
                                @error('img_picture')
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

@section('scripts')
<script>
function previewImage(event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById('imgPreview').src = URL.createObjectURL(file);
    }
}
</script>
@endsection
