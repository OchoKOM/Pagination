let currentPage = 1;
let isLoading = false;
let lastLoadedProductID = null;
let hasMorePages = true;

function loadProducts(page, lastProductID) {
    if (isLoading || !hasMorePages) return;
    isLoading = true;
    document.getElementById('loader').style.display = 'block';
    document.getElementById('error-message').style.display = 'none';

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `fetch_products.php?page=${page}&lastProductID=${lastProductID}`, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);
                const products = response.products;

                if (products.length > 0) {
                    appendProducts(products);
                    lastLoadedProductID = products[products.length - 1].id;
                    if (response.isLastPage) {
                        hasMorePages = false;
                        document.getElementById('end-of-content').style.display = 'block';
                    }
                } else {
                    hasMorePages = false;
                    document.getElementById('end-of-content').style.display = 'block';
                }
            } catch (error) {
                console.log('Parsing error:', error);
                console.log(xhr.responseText);
                
                showError('Failed to parse response.');
            }
        } else {
            showError('Server error: ' + xhr.status);
        }
        isLoading = false;
        document.getElementById('loader').style.display = 'none';
    };

    xhr.onerror = function () {
        showError('Network error. Please try again.');
    };

    xhr.send();
}

function appendProducts(products) {
    const list = document.getElementById('product-list');
    products.forEach(product => {
        const div = document.createElement('div');
        div.className = 'product';
        div.innerHTML = `
        <h3>${product.name}</h3>
        <p>${product.description || 'No description available'}</p>
        <p class="price">Price: $${product.price}</p>
        `;
        list.appendChild(div);
    });
}

function showError(message) {
    const errorMessage = document.getElementById('error-message');
    const errorDiv = errorMessage.querySelector('.message') 
    errorDiv.textContent = message;
    errorMessage.style.display = 'block';
    document.getElementById('loader').style.display = 'none';

    const retryButton = errorMessage.querySelector('.retry-button');

    retryButton.onclick = ()=>{
        document.getElementById('error-message').style.display = 'none';
        loadProducts(currentPage, lastLoadedProductID)
    }
}

window.onscroll = function () {
    if ((window.innerHeight + window.scrollY + 200) >= document.body.offsetHeight) {
        loadProducts(currentPage, lastLoadedProductID);
    }
};

// Événement pour les appareils tactiles
window.ontouchmove = function () {
    if ((window.innerHeight + window.scrollY + 200) >= document.body.offsetHeight) {
        loadProducts(currentPage, lastLoadedProductID);
    }
};

loadProducts(currentPage, lastLoadedProductID);