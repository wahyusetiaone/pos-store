// POS Cart Management
const cart = {
    items: [],
    customerId: null,
    customerName: '',
    customerPhone: '',
    paymentMethod: 'cash',
    orderType: 'ots', // mengubah default value sesuai dengan template
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
                quantity: 1,
                stock: product.stock
            });
        }
        this.updateCart();
    },

    removeItem(productId) {
        this.items = this.items.filter(item => item.id !== productId);
        this.updateCart();
    },

    updateItemQuantity(productId, quantity) {
        const item = this.items.find(item => item.id === productId);
        if (item) {
            item.quantity = parseInt(quantity);
            if (item.quantity <= 0) {
                this.removeItem(productId);
            }
        }
        this.updateCart();
    },

    calculateSubtotal() {
        return this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    },

    calculateTax() {
        return (this.calculateSubtotal() * this.tax) / 100;
    },

    calculateDiscount() {
        const percentageDiscount = (this.calculateSubtotal() * this.discount) / 100;
        return percentageDiscount + parseFloat(this.fixedDiscount || 0);
    },

    calculateGrandTotal() {
        return this.calculateSubtotal() + this.calculateTax() - this.calculateDiscount();
    },

    updateCart() {
        // Update items table
        const itemsContainer = document.getElementById('cartItems');
        itemsContainer.innerHTML = '';

        this.items.forEach((item, index) => {
            const row = document.createElement('tr');
            const newQuantity = Math.min(item.quantity + 1, item.stock);
            row.innerHTML = `
                <td>${index + 1}</td>
                <td>${item.name}</td>
                <td>
                    <div class="input-group input-group-sm" style="width: 120px;">
                        <button class="btn btn-outline-secondary btn-decrease" type="button" data-product-id="${item.id}" data-quantity="${item.quantity - 1}">-</button>
                        <input type="number" class="form-control text-center quantity-input"
                            value="${item.quantity}"
                            data-product-id="${item.id}"
                            min="1"
                            max="${item.stock}">
                        <button class="btn btn-outline-secondary btn-increase" type="button" data-product-id="${item.id}" data-quantity="${newQuantity}">+</button>
                    </div>
                </td>
                <td>Rp ${item.price.toLocaleString()},-</td>
                <td>
                    <button class="btn btn-sm btn-danger btn-remove" data-product-id="${item.id}">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;

            // Add event listeners for this row
            const decreaseBtn = row.querySelector('.btn-decrease');
            const increaseBtn = row.querySelector('.btn-increase');
            const quantityInput = row.querySelector('.quantity-input');
            const removeBtn = row.querySelector('.btn-remove');

            decreaseBtn.addEventListener('click', () => {
                const newQty = parseInt(decreaseBtn.dataset.quantity);
                if (newQty >= 1) {
                    this.updateItemQuantity(item.id, newQty);
                }
            });

            increaseBtn.addEventListener('click', () => {
                const newQty = parseInt(increaseBtn.dataset.quantity);
                if (newQty <= item.stock) {
                    this.updateItemQuantity(item.id, newQty);
                }
            });

            quantityInput.addEventListener('change', (e) => {
                const newQty = parseInt(e.target.value);
                if (newQty >= 1 && newQty <= item.stock) {
                    this.updateItemQuantity(item.id, newQty);
                }
            });

            removeBtn.addEventListener('click', () => {
                this.removeItem(item.id);
            });

            itemsContainer.appendChild(row);
        });

        // Update totals
        document.getElementById('totalAmount').textContent = `Rp ${this.calculateSubtotal().toLocaleString()},-`;
        document.getElementById('grandTotal').textContent = `Rp ${this.calculateGrandTotal().toLocaleString()},-`;
    },

    clear() {
        this.items = [];
        this.customerId = null;
        this.customerName = '';
        this.customerPhone = '';
        this.paymentMethod = 'cash';
        this.orderType = 'ots'; // mengubah default value sesuai dengan template
        this.discount = 0;
        this.tax = 0;
        this.fixedDiscount = 0;
        this.updateCart();
    }
};

// Category filter functionality
function filterProducts() {
    const categoryId = document.getElementById('categoryFilter').value;
    const searchText = document.getElementById('searchProduct').value.toLowerCase();

    document.querySelectorAll('.product-card').forEach(card => {
        const productName = card.querySelector('.card-title').textContent.toLowerCase();
        const productCategoryId = card.getAttribute('data-category-id');

        const matchesCategory = !categoryId || productCategoryId === categoryId;
        const matchesSearch = !searchText || productName.includes(searchText);

        card.closest('.col-md-3').style.display = (matchesCategory && matchesSearch) ? '' : 'none';
    });
}

// Event Listeners
document.addEventListener('DOMContentLoaded', function() {
    // Payment method change handler
    document.querySelector('select[name="payment_method"]').addEventListener('change', function() {
        cart.paymentMethod = this.value;
    });

    // Order type change handler
    document.querySelector('select[name="order_type"]').addEventListener('change', function() {
        cart.orderType = this.value;
    });

    // Add tax percentage handler
    document.querySelector('input[name="tax_percentage"]').addEventListener('input', function() {
        cart.tax = parseFloat(this.value) || 0;
        cart.updateCart();
    });

    // Add discount percentage handler
    document.querySelector('input[name="discount_percentage"]').addEventListener('input', function() {
        cart.discount = parseFloat(this.value) || 0;
        cart.updateCart();
    });

    // Fixed discount input handler
    document.querySelector('input[name="fixed_discount"]').addEventListener('input', function() {
        cart.fixedDiscount = parseFloat(this.value) || 0;
        cart.updateCart();
    });

    // Save transaction button handler
    document.getElementById('saveTransaction').addEventListener('click', async function() {
        if (cart.items.length === 0) {
            alert('Cart is empty!');
            return;
        }

        try {
            const grandTotal = cart.calculateGrandTotal();
            const response = await fetch('/sales', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    items: cart.items,
                    customer_id: cart.customerId,
                    customer_name: cart.customerName,
                    customer_phone: cart.customerPhone,
                    payment_method: cart.paymentMethod,
                    order_type: cart.orderType,
                    total: grandTotal,
                    paid: grandTotal, // Set paid amount equal to grand total for now
                    discount: cart.discount,
                    tax: cart.tax,
                    fixed_discount: cart.fixedDiscount
                })
            });

            if (response.ok) {
                const result = await response.json();
                alert('Transaction saved successfully!');
                cart.clear();
                // window.location.href = `/sales/${result.data.id}`;
            } else {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Failed to save transaction');
            }
        } catch (error) {
            alert('Error saving transaction: ' + error.message);
        }
    });

    // Add category filter event listener
    document.getElementById('categoryFilter').addEventListener('change', filterProducts);

    // Add product search event listener
    document.getElementById('searchProduct').addEventListener('input', filterProducts);

    // Product card click handler - Update to include category ID attribute
    document.querySelectorAll('.product-card').forEach(card => {
        card.addEventListener('click', function() {
            const product = {
                id: this.dataset.productId,
                name: this.querySelector('.card-title').textContent,
                price: parseFloat(this.querySelector('.text-primary').textContent.replace(/[^0-9]/g, '')),
                stock: parseInt(this.querySelector('.card-text.small').textContent.match(/\d+/)[0])
            };
            cart.addItem(product);
        });
    });

    // Initialize tooltips and other Bootstrap components if needed
    if (typeof bootstrap !== 'undefined') {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
});
