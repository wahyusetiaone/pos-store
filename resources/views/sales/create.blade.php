@extends('layout.layout')
@php
    $title = 'Tambah Penjualan';
    $subTitle = 'Form Transaksi Penjualan';
@endphp

@section('content')
<div class="row gy-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Transaksi Penjualan</h5>
            </div>
            <div class="card-body">
                <form id="saleForm" action="{{ route('sales.store') }}" method="POST">
                    @csrf
                    @if(auth()->user()->hasGlobalAccess())
                    <div class="mb-3">
                        <label class="form-label">Pilih Toko</label>
                        <select name="store_id" id="store_id" class="form-select @error('store_id') is-invalid @enderror" required>
                            <option value="">Pilih Toko...</option>
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}" {{ old('store_id') == $store->id ? 'selected' : '' }}>
                                    {{ $store->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('store_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Pelanggan</label>
                                <select name="customer_id" id="customer_id" class="form-select @error('customer_id') is-invalid @enderror">
                                    <option value="">Pilih Pelanggan...</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }} - {{ $customer->phone }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Atau Pelanggan Baru</label>
                                <input type="text" name="customer_name" class="form-control" placeholder="Nama Pelanggan Baru">
                            </div>
                        </div>
                    </div>

                    <!-- Product Selection -->
                    <div class="mb-3">
                        <label class="form-label">Tambah Produk</label>
                        <div class="input-group">
                            <input type="text" id="product_search" class="form-control" placeholder="Cari produk...">
                            <button type="button" class="btn btn-primary" id="add_product">Tambah</button>
                        </div>
                    </div>

                    <!-- Product List Table -->
                    <div class="table-responsive mb-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th width="100">Jumlah</th>
                                    <th width="150">Harga</th>
                                    <th width="150">Diskon</th>
                                    <th width="150">Subtotal</th>
                                    <th width="50">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="product_list">
                                <!-- Products will be added here dynamically -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end">Total:</td>
                                    <td colspan="2">
                                        <input type="number" name="total" id="total" class="form-control" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end">Diskon:</td>
                                    <td colspan="2">
                                        <input type="number" name="discount" id="discount" class="form-control" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end">Total Akhir:</td>
                                    <td colspan="2">
                                        <input type="number" name="final_total" id="final_total" class="form-control" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end">Dibayar:</td>
                                    <td colspan="2">
                                        <input type="number" name="paid" id="paid" class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end">Kembalian:</td>
                                    <td colspan="2">
                                        <input type="number" name="change" id="change" class="form-control" readonly>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Metode Pembayaran</label>
                                <select name="payment_method" class="form-select" required>
                                    <option value="cash">Tunai</option>
                                    <option value="transfer">Transfer</option>
                                    <option value="card">Kartu Debit/Kredit</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Catatan</label>
                                <textarea name="note" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('sales.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Add your JavaScript for handling dynamic product addition, calculation, etc.
</script>
@endpush
@endsection
