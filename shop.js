// --- Application State ---
let storeProducts = []; // Populated dynamically from Printful.
let cart = []; // Array to hold purchased items
let currentActiveProduct = null; // Tracks which product is open in the modal

// --- DOM Element Selection ---
const shopGrid = document.getElementById('shop-grid');
const cartCount = document.getElementById('cart-count');
const cartDrawer = document.getElementById('cart-drawer');
const cartOverlay = document.getElementById('cart-drawer-overlay');
const cartItemsContainer = document.getElementById('cart-items-container');
const cartSubtotal = document.getElementById('cart-subtotal');

const productModal = document.querySelector('.product-modal');
const modalOverlay = document.getElementById('product-modal-overlay');
const modalPriceText = document.getElementById('modal-price');

const colorSelect = document.getElementById('color-select');
const sizeSelect = document.getElementById('size-select');
const colorGroup = document.getElementById('color-group');
const sizeGroup = document.getElementById('size-group');

// --- Initialization ---
document.addEventListener('DOMContentLoaded', async () => {
    
    // Handle Mobile Menu Toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    menuToggle.addEventListener('click', () => navMenu.classList.toggle('active'));

    shopGrid.innerHTML = `
        <div class="terminal-loader">
            LOADING...<span class="cursor"></span>
        </div>
    `;

    // Fetch and render the store grid dynamically
    try {
        const response = await fetch('https://t8ry0h2y8g.execute-api.us-east-2.amazonaws.com/products');
        if (!response.ok) throw new Error("Network response was not ok");
        storeProducts = await response.json();

        console.log("Store Products Loaded:", storeProducts);

        renderShop();

    } catch (error) {
        console.error("Failed to load store items:", error);
        shopGrid.innerHTML = `
            <div class="terminal-loader" style="color: #EE040F;">
                ERR_CONNECTION_REFUSED: FAILED TO LOAD INVENTORY.
            </div>
        `;
    }

    // Event Listeners for UI Panels
    document.getElementById('cart-toggle-btn').addEventListener('click', toggleCart);
    document.getElementById('close-cart-btn').addEventListener('click', toggleCart);
    cartOverlay.addEventListener('click', toggleCart);

    document.getElementById('close-modal-btn').addEventListener('click', closeModal);
    modalOverlay.addEventListener('click', (event) => {
        if (event.target === modalOverlay) {
            closeModal();
        }
    });

    // Event Listener for changing size (Recalculates price dynamically based on variant)
    sizeSelect.addEventListener('change', calculateModalPrice);

    // Add to Cart Action
    document.getElementById('add-to-cart-btn').addEventListener('click', addItemToCart);
    
    // Checkout Action
    document.getElementById('checkout-btn').addEventListener('click', async () => {
        
        if(cart.length === 0) return;

        const checkoutBtn = document.getElementById('checkout-btn');
        const originalText = checkoutBtn.innerText;
        
        checkoutBtn.innerText = 'Processing...';
        checkoutBtn.disabled = true;

        try {
            const response = await fetch('https://t8ry0h2y8g.execute-api.us-east-2.amazonaws.com/checkout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ items: cart })
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const session = await response.json();
            window.location.href = session.url;

        } catch (error) {
            console.error("Error initiating checkout:", error);
            checkoutBtn.innerText = 'Checkout Failed. Try Again.';
            checkoutBtn.disabled = false;
            
            setTimeout(() => {
                checkoutBtn.innerText = originalText;
            }, 3000);
        }
    });

    renderGlitchAnimation();
});

// --- Core Functions ---

function renderShop() {
    shopGrid.innerHTML = '';
    storeProducts.forEach(product => {
        const card = document.createElement('div');
        card.className = 'shop-card';
        card.onclick = () => openModal(product);
        
        // Grab the price of the first variant to display on the storefront
        const displayPrice = product.variants[0].price.toFixed(2);
        
        card.innerHTML = `
            <img src="${product.img}" alt="${product.name}" class="shop-card-img">
            <h3>${product.name}</h3>
            <p class="price">$${displayPrice}</p>
        `;
        shopGrid.appendChild(card);
    });
}

function openModal(product) {
    currentActiveProduct = product;
    
    // Populate basic modal data
    document.getElementById('modal-img').src = product.img;
    document.getElementById('modal-title').innerText = product.name;
    
    // Fallback description in case Printful API format differs slightly
    document.getElementById('modal-desc').innerText = product.desc || "Official band merchandise.";
    
    const uniqueColors = [...new Set(product.variants.map(v => v.color).filter(Boolean))];

    if (uniqueColors.length > 0) {
        // Product has color options
        colorGroup.style.display = "flex";
        colorSelect.innerHTML = '';
        uniqueColors.forEach(color => {
            const option = document.createElement('option');
            option.value = color;
            option.text = color;
            colorSelect.appendChild(option);
        });

        // Listen for when the user changes the color selection
        colorSelect.onchange = () => updateSizeDropdown(product, colorSelect.value);
        
        // Trigger initial size population based on the first color
        updateSizeDropdown(product, uniqueColors[0]);
    } else {
        // No color options (e.g., a standard hat, vinyl, or accessory)
        colorGroup.style.display = "none";
        populateSizeDropdown(product.variants);
    }
    
    modalOverlay.classList.add('active');
    productModal.classList.add('active');
}



function updateSizeDropdown(product, selectedColor) {
    const filteredVariants = product.variants.filter(v => v.color === selectedColor);

    if(filteredVariants.length > 0 && filteredVariants[0].variantImg) {
        document.getElementById('modal-img').src = filteredVariants[0].variantImg;
    }

    populateSizeDropdown(filteredVariants);
}

// Helper to paint the size dropdown options
function populateSizeDropdown(variants) {
    sizeSelect.innerHTML = '';
    
    variants.forEach(variant => {
        const option = document.createElement('option');
        option.value = variant.variantId; // Holds the true unique Printful ID
        option.text = variant.size;
        option.dataset.price = variant.price;
        sizeSelect.appendChild(option);
    });

    // Hide size dropdown if there's only one flat option
    if (variants.length <= 1 && variants[0].size === "One Size") {
        sizeGroup.style.display = "none";
    } else {
        sizeGroup.style.display = "flex";
    }

    sizeSelect.onchange = calculateModalPrice;
    calculateModalPrice();
}

function closeModal() {
    modalOverlay.classList.remove('active');
    productModal.classList.remove('active');
    currentActiveProduct = null;
}

function calculateModalPrice() {
    if (!currentActiveProduct) return;
    
    const selectedOption = sizeSelect.options[sizeSelect.selectedIndex];
    if (selectedOption) {
        const price = parseFloat(selectedOption.dataset.price);
        modalPriceText.innerText = `$${price.toFixed(2)}`;
    }
}

function addItemToCart() {
    if (!currentActiveProduct) return;

    const selectedSizeOption = sizeSelect.options[sizeSelect.selectedIndex];
    if (!selectedSizeOption) return;

    const finalPrice = parseFloat(selectedSizeOption.dataset.price);
    const selectedSize = selectedSizeOption.text;
    const variantId = selectedSizeOption.value; // Resolved straight to the unique ID
    
    // Grab color if the selector is visible
    const hasColor = colorGroup.style.display !== "none";
    const selectedColor = hasColor ? colorSelect.value : null;

    // Format display string for the cart UI
    const metaText = selectedColor ? `${selectedColor} / ${selectedSize}` : selectedSize;

    const cartItem = {
        cartId: Date.now().toString(), 
        productId: currentActiveProduct.id,
        variantId: variantId, 
        name: currentActiveProduct.name,
        size: metaText, // Combines color and size cleanly for display rows
        price: finalPrice,
        img: currentActiveProduct.img
    };

    cart.push(cartItem);
    
    closeModal();
    updateCartUI();
    
    cartDrawer.classList.add('active');
    cartOverlay.classList.add('active');
}

function updateCartUI() {
    cartCount.innerText = cart.length;
    cartItemsContainer.innerHTML = '';
    
    if (cart.length === 0) {
        cartItemsContainer.innerHTML = '<p class="empty-cart-msg">Your cart is empty.</p>';
        cartSubtotal.innerText = '$0.00';
        return;
    }

    let total = 0;

    cart.forEach(item => {
        total += item.price;
        
        const row = document.createElement('div');
        row.className = 'cart-item-row';
        row.innerHTML = `
            <img src="${item.img}" alt="${item.name}" class="cart-item-img">
            <div class="cart-item-details">
                <h4>${item.name}</h4>
                <p class="cart-item-meta">Size: ${item.size} | $${item.price.toFixed(2)}</p>
                <button class="remove-item" onclick="removeFromCart('${item.cartId}')">Remove</button>
            </div>
        `;
        cartItemsContainer.appendChild(row);
    });

    cartSubtotal.innerText = `$${total.toFixed(2)}`;
}

window.removeFromCart = function(uniqueCartId) {
    cart = cart.filter(item => item.cartId !== uniqueCartId);
    updateCartUI();
};

function toggleCart() {
    cartDrawer.classList.toggle('active');
    cartOverlay.classList.toggle('active');
}

function renderGlitchAnimation() {
    const container = document.getElementById('logo-container');
    const numSlices = 20; 
    let currentTopPercent = 0;

    for (let i = 0; i < numSlices; i++) {
        let sliceHeightPercent = Math.random() * 9 + 3;

        if (i === numSlices - 1) {
            sliceHeightPercent = 100 - currentTopPercent;
        } else if (currentTopPercent + sliceHeightPercent > 100) {
            sliceHeightPercent = 100 - currentTopPercent;
        }

        const bottomInsetPercent = 100 - (currentTopPercent + sliceHeightPercent);

        const sliceDiv = document.createElement('div');
        sliceDiv.classList.add('slice');
        sliceDiv.style.clipPath = `inset(${currentTopPercent}% 0 ${bottomInsetPercent}% 0)`;

        const goesLeft = Math.random() > 0.5;
        const randomDistance = (Math.random() * 6 + 2) * (goesLeft ? -1 : 1);
        const sliceColor = goesLeft ? '#EE040F' : '#213ff9'; 
        const randomDuration = Math.random() * 0.1 + 0.1;
        const randomDelay = Math.random();

        sliceDiv.style.setProperty('--glitch-x', `${randomDistance}%`);
        sliceDiv.style.setProperty('--glitch-color', sliceColor);
        sliceDiv.style.setProperty('--glitch-dur', `${randomDuration}s`);
        sliceDiv.style.setProperty('--glitch-delay', `${randomDelay}s`);

        container.appendChild(sliceDiv);
        currentTopPercent += sliceHeightPercent;
        
        if (currentTopPercent >= 100) break; 
    }

    const playGlitchAnimation = () => {
        if (container.classList.contains('glitch-active')) return;

        container.classList.add('glitch-active');

        setTimeout(() => {
            container.classList.remove('glitch-active');
        }, 2000);
    };

    playGlitchAnimation();
    container.addEventListener('mouseenter', playGlitchAnimation);
}