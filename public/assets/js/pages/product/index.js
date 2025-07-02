document.addEventListener('DOMContentLoaded', function() {
    const checkAll = document.getElementById('checkAll');
    const productCheckboxes = document.querySelectorAll('.product-checkbox');
    const downloadButton = document.getElementById('downloadSelected');

    // Handle "Check All" functionality
    checkAll.addEventListener('change', function() {
        productCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateDownloadButton();
    });

    // Handle individual checkbox changes
    productCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateDownloadButton();

            // Update "Check All" state
            const allChecked = Array.from(productCheckboxes).every(cb => cb.checked);
            checkAll.checked = allChecked;
        });
    });

    // Update download button visibility and URL
    function updateDownloadButton() {
        const selectedProducts = Array.from(productCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        if (selectedProducts.length > 0) {
            downloadButton.classList.remove('d-none');
            downloadButton.onclick = function() {
                window.location.href = `${window.location.origin}/download/barcode/multiple?product_ids=${selectedProducts.join(',')}`;
            }
        } else {
            downloadButton.classList.add('d-none');
        }
    }

    // Initial check for any pre-checked boxes
    updateDownloadButton();
});

document.addEventListener('DOMContentLoaded', function() {
    const rangeAll = document.getElementById('range_all');
    const rangeSelected = document.getElementById('range_selected');
    const selectedProductSection = document.getElementById('selectedProductSection');
    const form = document.getElementById('catalogueDownloadForm');
    const selectedProductIds = document.getElementById('selectedProductIds');

    function updateModalInputs() {
        if (rangeSelected.checked) {
            selectedProductSection.style.display = '';
        } else {
            selectedProductSection.style.display = 'none';
        }
    }

    rangeAll.addEventListener('change', updateModalInputs);
    rangeSelected.addEventListener('change', updateModalInputs);
    updateModalInputs();

    form.addEventListener('submit', function(e) {
        if (rangeSelected.checked) {
            // collect checked product ids
            let ids = Array.from(document.querySelectorAll('.product-checkbox:checked')).map(cb => cb.value);
            selectedProductIds.value = ids.join(',');
            if (ids.length === 0) {
                alert('Pilih minimal satu produk!');
                e.preventDefault();
            }
        } else {
            // for all, send a marker for all
            selectedProductIds.value = 'all';
        }
    });
});
