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
                                        <button type="button"
                                                class="w-32-px h-32-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center me-1"
                                                title="Kirim"
                                                onclick="openShippingModal({{ $purchase->id }})">
                                            <iconify-icon icon="mdi:truck-delivery"></iconify-icon>
                                        </button>
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

<!-- Shipping Modal -->
<div class="modal fade" id="shippingModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buat Pengiriman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="shippingForm">
                    <input type="hidden" id="purchase_id" name="purchase_id">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nomor Pengiriman</label>
                            <input type="text" name="number_shipping" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Pengiriman</label>
                            <input type="date" name="shipping_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    @if(auth()->user()->hasGlobalAccess())
                    <div class="mb-3">
                        <label class="form-label">Toko</label>
                        <select name="store_id" class="form-select" required>
                            <option value="">Pilih Toko...</option>
                            @foreach(App\Models\Store::where('is_active', true)->get() as $store)
                                <option value="{{ $store->id }}">{{ $store->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="drafted">Draft</option>
                            <option value="shipped" selected>Dikirim</option>
                            <option value="completed">Selesai</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea name="note" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="table-responsive mb-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="50">
                                        <input type="checkbox" id="checkAll">
                                    </th>
                                    <th>Produk</th>
                                    <th width="120">Qty Pembelian</th>
                                    <th width="120">Qty Kirim</th>
                                    <th width="150">Harga</th>
                                </tr>
                            </thead>
                            <tbody id="purchaseItems">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end fw-bold">Total:</td>
                                    <td>
                                        <input type="number" name="total" id="total_amount" class="form-control" readonly>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="submitShipping()">Kirim</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
let purchaseData = null;
const shippingModal = new bootstrap.Modal(document.getElementById('shippingModal'));

function openShippingModal(purchaseId) {
    // Reset form
    document.getElementById('shippingForm').reset();
    document.getElementById('purchase_id').value = purchaseId;

    // Fetch purchase data
    fetch(`/purchases/${purchaseId}`)
        .then(response => response.json())
        .then(data => {
            purchaseData = data;
            renderPurchaseItems(data.items);
        });

    shippingModal.show();
}

function renderPurchaseItems(items) {
    const tbody = document.getElementById('purchaseItems');
    tbody.innerHTML = items.map((item, index) => `
        <tr>
            <td class="text-center">
                <input type="checkbox" name="items[${index}][selected]" class="item-checkbox"
                       onchange="updateShippingQty(${index}, this.checked)">
                <input type="hidden" name="items[${index}][product_id]" value="${item.product_id}">
            </td>
            <td>${item.product.name}</td>
            <td class="text-center">${item.quantity}</td>
            <td>
                <input type="number" name="items[${index}][quantity]" class="form-control shipping-qty"
                       min="1" max="${item.quantity}" value="${item.quantity}" disabled>
            </td>
            <td>
                <input type="number" name="items[${index}][price]" class="form-control"
                       value="${item.price}" readonly>
            </td>
        </tr>
    `).join('');
}

function updateShippingQty(index, checked) {
    const qtyInput = document.querySelectorAll('.shipping-qty')[index];
    qtyInput.disabled = !checked;
}

document.getElementById('checkAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.item-checkbox');
    const qtyInputs = document.querySelectorAll('.shipping-qty');

    checkboxes.forEach((checkbox, index) => {
        checkbox.checked = this.checked;
        qtyInputs[index].disabled = !this.checked;
    });
});

function submitShipping() {
    const formData = new FormData(document.getElementById('shippingForm'));
    const purchaseId = formData.get('purchase_id');

    // Convert FormData to JSON
    const jsonData = {
        purchase_id: purchaseId,
        number_shipping: formData.get('number_shipping'),
        shipping_date: formData.get('shipping_date'),
        status: formData.get('status'),
        note: formData.get('note'),
        total: calculateTotal(),
        items: []
    };

    // Add store_id if user has global access
    if (formData.get('store_id')) {
        jsonData.store_id = formData.get('store_id');
    }

    // Get selected items
    const items = document.querySelectorAll('.item-checkbox');
    items.forEach((checkbox, index) => {
        if (checkbox.checked) {
            jsonData.items.push({
                product_id: formData.get(`items[${index}][product_id]`),
                quantity: formData.get(`items[${index}][quantity]`),
                price: formData.get(`items[${index}][price]`)
            });
        }
    });

    // Submit data
    fetch('/shippings', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(jsonData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            shippingModal.hide();
            window.location.reload();
        } else {
            alert(data.message || 'Terjadi kesalahan');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan');
    });
}

// Add function to calculate total
function calculateTotal() {
    let total = 0;
    document.querySelectorAll('.item-checkbox').forEach((checkbox, index) => {
        if (checkbox.checked) {
            const qty = document.querySelectorAll('.shipping-qty')[index].value;
            const price = document.querySelectorAll('input[name^="items["][name$="[price]"]')[index].value;
            total += qty * price;
        }
    });
    document.getElementById('total_amount').value = total;
    return total;
}

// Add event listeners for quantity changes to update total
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('shipping-qty') || e.target.classList.contains('item-checkbox')) {
        calculateTotal();
    }
});
</script>
@endpush
@endsection
