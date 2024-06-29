function filterProducts(category) {
    // Hide all products
    const allProducts = document.querySelectorAll('.product_container');
    allProducts.forEach(product => {
        product.style.display = 'none';
    });

    // Show only products of the selected category
    const selectedProducts = document.querySelectorAll(`.${category}`);
    selectedProducts.forEach(product => {
        product.style.display = 'flex';
    });
}

// By default, show all products or one category
window.onload = function() {
    filterProducts('meal'); // Show 'meal' products by default on page load
};
