@extends('layout.layout')
@php
    $title = 'Daftar Pembelian';
    $subTitle = 'Tabel Pembelian';
@endphp

@section('content')
<div class="row gy-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('purchases.create') }}" class="btn btn-primary float-end">Tambah Pembelian</a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="table-responsive">
                    <table class="table bordered-table mb-0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Supplier</th>
                                <th>Total</th>
                                <th>User</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchases as $purchase)
                                <tr>
                                    <td>{{ $purchase->purchase_date }}</td>
                                    <td>{{ $purchase->supplier }}</td>
                                    <td>Rp {{ number_format($purchase->total, 0, ',', '.') }}</td>
                                    <td>{{ $purchase->user->name ?? '-' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('purchases.show', $purchase->id) }}" class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center me-1" title="Lihat">
                                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                        </a>
                                        <a href="{{ route('purchases.edit', $purchase->id) }}" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center me-1" title="Ubah">
                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                        </a>
                                        <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center border-0" onclick="return confirm('Hapus pembelian ini?')" title="Hapus">
                                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    @if ($purchases->hasPages())
                        <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                            <li class="page-item">
                                <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-8 border-0 px-20 py-10 d-flex align-items-center justify-content-center h-48-px w-48-px"
                                   href="{{ $purchases->previousPageUrl() ?? 'javascript:void(0)' }}" @if($purchases->onFirstPage()) tabindex="-1" aria-disabled="true" @endif>
                                    <iconify-icon icon="ep:d-arrow-left" class="text-xl"></iconify-icon>
                                </a>
                            </li>
                            @foreach ($purchases->getUrlRange(1, $purchases->lastPage()) as $page => $url)
                                <li class="page-item">
                                    <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-8 border-0 px-20 py-10 d-flex align-items-center justify-content-center h-48-px w-48-px{{ $page == $purchases->currentPage() ? ' bg-primary-600 text-white' : '' }}"
                                       href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
                            <li class="page-item">
                                <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-8 border-0 px-20 py-10 d-flex align-items-center justify-content-center h-48-px w-48-px"
                                   href="{{ $purchases->nextPageUrl() ?? 'javascript:void(0)' }}" @if(!$purchases->hasMorePages()) tabindex="-1" aria-disabled="true" @endif>
                                    <iconify-icon icon="ep:d-arrow-right" class="text-xl"></iconify-icon>
                                </a>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

