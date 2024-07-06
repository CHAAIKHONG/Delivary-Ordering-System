function filterProducts(category) {
    const allProducts = document.querySelectorAll('.product_container');
    allProducts.forEach(product => {
        product.style.display = 'none';
    });

    const selectedProducts = document.querySelectorAll(`.${category}`);
    selectedProducts.forEach(product => {
        product.style.display = 'flex';
    });
}

window.onload = function() {
    filterProducts('meal');
};

document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.add-to-cart');
    links.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); 
            const productId = this.getAttribute('data-id');
            addToCart(productId);
        });
    });
});

function addToCart(productId) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_to_cart.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            alert(xhr.responseText);
        }
    };
    xhr.send('product_id=' + productId);
}