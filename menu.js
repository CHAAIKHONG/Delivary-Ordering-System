function filterProducts(category) {
    // 隐藏所有产品
    const allProducts = document.querySelectorAll('.product_container');
    allProducts.forEach(product => {
        product.style.display = 'none';
    });

    // 显示选定类别的产品
    const selectedProducts = document.querySelectorAll(`.${category}`);
    selectedProducts.forEach(product => {
        product.style.display = 'flex';
    });
}

// 页面加载时默认显示 'meal' 类别的产品
window.onload = function() {
    filterProducts('meal');
};

// 为所有 "Add Cart" 链接添加点击事件监听器
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.add-to-cart');
    links.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // 阻止默认行为（导航）
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