// Define the available products by team
const productsByTeam = {
    redbull: ['T-Shirt', 'Cap', 'Hoodie', 'Keychain', 'Jacket', 'Mug'],
    ferrari: ['T-Shirt', 'Cap', 'Hoodie', 'Keychain', 'Jacket', 'Mug'],
    mercedes: ['T-Shirt', 'Cap', 'Hoodie', 'Keychain', 'Jacket', 'Mug'],
    mclaren: ['T-Shirt', 'Cap', 'Hoodie', 'Keychain', 'Jacket', 'Mug'],
    aston_martin: ['T-Shirt', 'Cap', 'Hoodie', 'Keychain', 'Jacket', 'Mug']
};

// Update products dropdown dynamically based on the selected team
function updateProducts() {
    const team = document.getElementById('team').value;
    const productSelect = document.getElementById('product');

    productSelect.innerHTML = '';

    if (team && productsByTeam[team]) {
        productsByTeam[team].forEach((product) => {
            const option = document.createElement('option');
            option.value = product.toLowerCase().replace(/\s/g, '_');
            option.text = product;
            productSelect.add(option);
        });
    } else {
        const option = document.createElement('option');
        option.text = 'Select a Team First';
        productSelect.add(option);
    }
}

// Implement live search functionality
function liveSearch() {
    const searchInput = document.getElementById('search').value.toLowerCase();
    const productCards = document.getElementsByClassName('product-card');

    for (let i = 0; i < productCards.length; i++) {
        const productName = productCards[i].getElementsByTagName('h2')[0].innerText.toLowerCase();

        if (productName.includes(searchInput)) {
            productCards[i].style.display = '';
        } else {
            productCards[i].style.display = 'none';
        }
    }
}

// Implement image pop-up modal
const modal = document.getElementById('imageModal');
const modalImg = document.getElementById('imgModal');
const caption = document.getElementById('caption');
const closeModal = document.getElementsByClassName('close')[0];

const productImages = document.querySelectorAll('.product-image');

productImages.forEach((img) => {
    img.onclick = function () {
        modal.style.display = 'block';
        modalImg.src = this.src;
        caption.innerHTML = this.alt;
    };
});

closeModal.onclick = function () {
    modal.style.display = 'none';
};

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
};
