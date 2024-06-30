function filterProducts(category) {
    // Hide all products
    const allProducts = document.querySelectorAll('.all_information');
    allProducts.forEach(product => {
        product.style.display = 'none';
    });

    // Show only products of the selected category
    const selectedProducts = document.querySelectorAll(`.${category}`);
    selectedProducts.forEach(product => {
        product.style.display = 'block';
    });
}

// By default, show the profile category on page load
window.onload = function() {
    filterProducts('profile'); 
};
