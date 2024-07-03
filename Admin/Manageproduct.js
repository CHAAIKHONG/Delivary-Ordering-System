let products = []; // Assume this is populated from PHP or another data source

function filterCategory(category) {
    const rows = document.querySelectorAll('.product-row');
    rows.forEach(row => {
        if (category === 'all' || row.getAttribute('data-category') === category) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function showAddProductModal() {
    document.getElementById('addProductModal').style.display = 'block';
}

function showEditProductModal(productId) {
    const product = products.find(p => p.product_id === productId);
    if (product) {
        // Assuming you have modal elements and update functionality
        document.getElementById('edit-product-name').value = product.product_name;
        document.getElementById('edit-product-category').value = product.category_id;
        // Add more fields as needed
        document.getElementById('editProductModal').style.display = 'block';
    }
}

function addProduct() {
    // Implement add product functionality if not already done in PHP
    console.log('Adding product...');
}

function updateProduct(productId) {
    // Implement update product functionality if not already done in PHP
    console.log('Updating product...');
}

function deleteProduct(productId) {
    // Implement delete product functionality if not already done in PHP
    console.log('Deleting product...');
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('collapsed');
    document.getElementById('content-wrapper').classList.toggle('collapsed');
}
