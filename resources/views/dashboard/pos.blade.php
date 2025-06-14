@extends('layout.pos')

@section('content')
<div class="container-fluid">
    <!-- Navigation Icons -->
    <div class="row mb-3">
        <!-- Left Side - Product List -->
        <div class="col-lg-8 p-3">
            <div class="card">
                <div class="d-flex gap-4 p-2">
                    <a href="{{ route('index') }}" class="text-decoration-none">
                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="ri-home-4-fill text-white fs-4"></i>
                        </div>
                    </a>
                    <a href="{{ route('sales.index') }}" class="text-decoration-none">
                        <div class="rounded-circle bg-success d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="ri-shopping-cart-2-fill text-white fs-4"></i>
                        </div>
                    </a>
                    <a href="{{ route('customers.index') }}" class="text-decoration-none">
                        <div class="rounded-circle bg-info d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="ri-user-3-fill text-white fs-4"></i>
                        </div>
                    </a>
                </div>
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Data Produk</h5>
                </div>
                <div class="card-body">
                    <!-- Filter and Search -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <select class="form-select" id="categoryFilter">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari Menu" id="searchProduct">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="row" id="productsGrid">
                        @foreach($products as $product)
                        <div class="col-md-3 mb-3">
                            <div class="card h-100 product-card" data-product-id="{{ $product->id }}">
                                <img src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image_path) : asset('images/no-image.jpg') }}"
                                     class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h6 class="card-title m-0 p-0">{{ $product->name }}</h6>
                                    <p class="card-text text-primary m-0 p-0">Rp {{ number_format($product->price, 0, ',', '.') }},-</p>
                                    <p class="card-text small m-0 p-0">STOK: {{ $product->stock }}x</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Cart -->
        <div class="col-lg-4 p-3">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0 d-flex justify-content-between">
                        <span>Keranjang</span>
                        <span>NO BON: {{ str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT) }}</span>
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Customer Information -->
                    <div class="mb-3">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" placeholder="CUSTOMER" id="customerSearch">
                            <input type="hidden" id="customerId">
                            <button class="btn btn-outline-secondary" type="button" id="searchCustomerBtn">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control mb-2" id="customerName" placeholder="ATAS NAMA" readonly>
                        <div id="customerSearchResults" class="position-absolute bg-white border rounded shadow-sm p-2 d-none" style="z-index: 1000; width: 95%;">
                            <!-- Search results will appear here -->
                        </div>
                        <small class="text-muted">Untuk Customer yang sudah terdaftar pada sistem</small>
                    </div>

                    <!-- Cart Items -->
                    <div class="table-responsive mb-3">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody id="cartItems">
                                <!-- Cart items will be added here dynamically -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Payment Details -->
                    <div class="payment-details">
                        <div class="mb-2 row">
                            <div class="col-6">
                                <select name="payment_method" class="form-select form-select-sm">
                                    <option value="cash">Lunas</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <select name="order_type" class="form-select form-select-sm">
                                    <option value="dine_in">Ditempat</option>
                                    <option value="takeaway">Take Away</option>
                                    <option value="delivery">Delivery</option>
                                </select>
                            </div>
                        </div>

                        <div class="payment-summary">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Total Bayar:</span>
                                <span class="text-end" id="totalAmount">Rp 0,-</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Diskon (%):</span>
                                <div class="input-group input-group-sm w-50">
                                    <input type="number" name="discount_percentage" class="form-control form-control-sm" value="0" min="0" max="100">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Pajak (%):</span>
                                <div class="input-group input-group-sm w-50">
                                    <input type="number" name="tax_percentage" class="form-control form-control-sm" value="0" min="0" max="100">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Diskon (Rp):</span>
                                <input type="number" name="fixed_discount" class="form-control form-control-sm w-50" value="0" min="0">
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="fw-bold">Grand Total:</span>
                                <span class="fw-bold text-end" id="grandTotal">Rp 0,-</span>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary w-100" id="saveTransaction">Simpan Transaksi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .product-card {
        cursor: pointer;
        transition: transform 0.2s;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .payment-summary {
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 0.25rem;
        margin-bottom: 1rem;
    }
    .hover-bg-light:hover {
        background-color: #f8f9fa;
    }

    .customer-item {
        transition: background-color 0.2s;
    }

    .customer-item:hover {
        background-color: #f8f9fa;
    }
</style>
@endpush

@push('scripts')
<script>
// Define cart as a global object
const cart = {
    items: [],
    customerId: null,
    customerName: '',
    customerPhone: '',
    paymentMethod: 'cash',
    orderType: 'dine_in',
    discount: 0,
    tax: 0,
    fixedDiscount: 0,

    addItem(product) {
        const existingItem = this.items.find(item => item.id === product.id);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            this.items.push({
                id: product.id,
                name: product.name,
                price: product.price,
                quantity: 1
            });
        }
        this.updateCart();
    },
    removeItem(productId) {
        this.items = this.items.filter(item => item.id !== productId);
        this.updateCart();
    },
    updateQuantity(productId, quantity) {
        const item = this.items.find(item => item.id === productId);
        if (item) {
            item.quantity = Math.max(1, parseInt(quantity) || 1);
            this.updateCart();
        }
    },
    updateCart() {
        const tbody = document.getElementById('cartItems');
        tbody.innerHTML = '';

        this.items.forEach((item, index) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${index + 1}</td>
                <td>${item.name}</td>
                <td>
                    <div class="input-group input-group-sm">
                        <button class="btn btn-outline-secondary btn-sm" onclick="cart.updateQuantity(${item.id}, ${item.quantity - 1})">-</button>
                        <input type="number" class="form-control form-control-sm text-center" value="${item.quantity}" style="width: 50px" min="1"
                            onchange="cart.updateQuantity(${item.id}, parseInt(this.value))">
                        <button class="btn btn-outline-secondary btn-sm" onclick="cart.updateQuantity(${item.id}, ${item.quantity + 1})">+</button>
                    </div>
                </td>
                <td>Rp ${(item.price * item.quantity).toLocaleString()},-</td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="cart.removeItem(${item.id})">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
        });

        this.updateTotals();
    },
    updateTotals() {
        let total = this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const discountAmount = (total * this.discount / 100) + this.fixedDiscount;
        const taxAmount = (total - discountAmount) * this.tax / 100;

        total = total - discountAmount + taxAmount;

        document.getElementById('totalAmount').textContent = `Rp ${total.toLocaleString()},-`;
        document.getElementById('grandTotal').textContent = `Rp ${total.toLocaleString()},-`;

        return {
            subtotal: this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0),
            discount: discountAmount,
            tax: taxAmount,
            total: total
        };
    },
    async saveTransaction() {
        try {
            const totals = this.updateTotals();

            const data = {
                customer_id: this.customerId,
                customer_name: this.customerName,
                customer_phone: this.customerPhone,
                items: this.items,
                payment_method: this.paymentMethod,
                total: totals.total,
                subtotal: totals.subtotal,
                discount: totals.discount,
                tax: totals.tax,
                paid: totals.total, // Assuming full payment
                note: `Order Type: ${this.orderType}`
            };

            const response = await fetch('/sales', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (result.success) {
                // Reset cart
                this.items = [];
                this.customerId = null;
                this.customerName = '';
                this.customerPhone = '';
                this.updateCart();

                // Reset form fields
                document.getElementById('customerSearch').value = '';
                document.getElementById('customerName').value = '';
                document.getElementById('customerId').value = '';

                // Show success message
                alert('Transaksi berhasil disimpan!');
            } else {
                throw new Error(result.message);
            }

        } catch (error) {
            console.error('Error saving transaction:', error);
            alert('Gagal menyimpan transaksi: ' + error.message);
        }
    }
};

document.addEventListener('DOMContentLoaded', function() {
    // Filter and Search functionality
    const categoryFilter = document.getElementById('categoryFilter');
    const searchInput = document.getElementById('searchProduct');
    const productsGrid = document.getElementById('productsGrid');
    let searchTimeout;

    function updateProducts(categoryId = '', search = '') {
        fetch(`/products?category_id=${categoryId}&search=${search}&ajax=true`, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                productsGrid.innerHTML = data.html;
                // Reattach click events to new product cards
                document.querySelectorAll('.product-card').forEach(card => {
                    card.addEventListener('click', function() {
                        const productId = parseInt(this.dataset.productId);
                        const productName = this.querySelector('.card-title').textContent;
                        const productPrice = parseInt(this.querySelector('.card-text').textContent.replace(/[^0-9]/g, ''));

                        cart.addItem({
                            id: productId,
                            name: productName,
                            price: productPrice
                        });
                    });
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // Category filter change event
    categoryFilter.addEventListener('change', function() {
        updateProducts(this.value, searchInput.value);
    });

    // Search input with debounce
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            updateProducts(categoryFilter.value, this.value);
        }, 300);
    });

    // Add click event listeners to product cards
    document.querySelectorAll('.product-card').forEach(card => {
        card.addEventListener('click', function() {
            const productId = parseInt(this.dataset.productId);
            const productName = this.querySelector('.card-title').textContent;
            const productPrice = parseInt(this.querySelector('.card-text').textContent.replace(/[^0-9]/g, ''));

            cart.addItem({
                id: productId,
                name: productName,
                price: productPrice
            });
        });
    });

    // Customer Search Functionality
    const customerSearch = document.getElementById('customerSearch');
    const customerSearchResults = document.getElementById('customerSearchResults');
    const customerNameInput = document.getElementById('customerName');
    const customerIdInput = document.getElementById('customerId');
    let customerSearchTimeout;

    function searchCustomer(query) {
        if (!query.trim()) {
            customerSearchResults.classList.add('d-none');
            return;
        }

        fetch(`/customers?search=${encodeURIComponent(query)}`, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(customers => {
                customerSearchResults.innerHTML = '';
                console.log(customers)
                if (customers.length > 0) {
                    customers.forEach(customer => {
                        const div = document.createElement('div');
                        div.className = 'customer-item p-2 cursor-pointer hover-bg-light';
                        div.style.cursor = 'pointer';
                        div.innerHTML = `
                            <div><strong>${customer.name}</strong></div>
                            <div class="small text-muted">${customer.phone || ''}</div>
                        `;
                        div.addEventListener('click', () => {
                            customerIdInput.value = customer.id;
                            customerSearch.value = customer.phone || '';
                            customerNameInput.value = customer.name;
                            customerSearchResults.classList.add('d-none');
                        });
                        customerSearchResults.appendChild(div);
                    });
                    customerSearchResults.classList.remove('d-none');
                } else {
                    customerSearchResults.innerHTML = '<div class="p-2 text-muted">Tidak ada customer ditemukan</div>';
                    customerSearchResults.classList.remove('d-none');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    customerSearch.addEventListener('input', function() {
        clearTimeout(customerSearchTimeout);
        customerSearchTimeout = setTimeout(() => {
            searchCustomer(this.value);
        }, 300);
    });

    document.addEventListener('click', function(e) {
        if (!customerSearchResults.contains(e.target) && e.target !== customerSearch) {
            customerSearchResults.classList.add('d-none');
        }
    });

    // Customer selection event
    function selectCustomer(customer) {
        cart.customerId = customer.id;
        cart.customerName = customer.name;
        cart.customerPhone = customer.phone || '';
        customerIdInput.value = customer.id;
        customerSearch.value = customer.phone || '';
        customerNameInput.value = customer.name;
        customerSearchResults.classList.add('d-none');
    }

    // Modify the customer click event to use selectCustomer function
    function createCustomerElement(customer) {
        const div = document.createElement('div');
        div.className = 'customer-item p-2 cursor-pointer hover-bg-light';
        div.style.cursor = 'pointer';
        div.innerHTML = `
            <div><strong>${customer.name}</strong></div>
            <div class="small text-muted">${customer.phone || ''}</div>
        `;
        div.addEventListener('click', () => selectCustomer(customer));
        return div;
    }

    // Payment related events
    const paymentMethodSelect = document.querySelector('select[name="payment_method"]');
    const orderTypeSelect = document.querySelector('select[name="order_type"]');
    const discountInput = document.querySelector('input[name="discount_percentage"]');
    const taxInput = document.querySelector('input[name="tax_percentage"]');
    const fixedDiscountInput = document.querySelector('input[name="fixed_discount"]');
    const saveTransactionBtn = document.getElementById('saveTransaction');

    if (paymentMethodSelect) {
        paymentMethodSelect.addEventListener('change', function() {
            cart.paymentMethod = this.value;
        });
    }

    if (orderTypeSelect) {
        orderTypeSelect.addEventListener('change', function() {
            cart.orderType = this.value;
        });
    }

    if (discountInput) {
        discountInput.addEventListener('input', function() {
            cart.discount = parseFloat(this.value) || 0;
            cart.updateTotals();
        });
    }

    if (taxInput) {
        taxInput.addEventListener('input', function() {
            cart.tax = parseFloat(this.value) || 0;
            cart.updateTotals();
        });
    }

    if (fixedDiscountInput) {
        fixedDiscountInput.addEventListener('input', function() {
            cart.fixedDiscount = parseFloat(this.value) || 0;
            cart.updateTotals();
        });
    }

    // Save Transaction button
    if (saveTransactionBtn) {
        saveTransactionBtn.addEventListener('click', function() {
            if (cart.items.length === 0) {
                alert('Keranjang masih kosong!');
                return;
            }
            cart.saveTransaction();
        });
    }

    // Initialize cart
    cart.updateCart();
});
</script>
@endpush
