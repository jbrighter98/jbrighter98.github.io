// --- 1. Mock Database (Mimics future Printful API payload) ---
const mockProducts = [
    {
        id: "p_101",
        name: "Classic Logo Tee",
        desc: "Heavyweight 100% cotton tee. Features the classic anaglyph logo.",
        basePrice: 25.00,
        img: "bandImages/SAMPLET.png"
    },
    {
        id: "p_102",
        name: "Dark Logo Tee",
        desc: "Heavyweight 100% cotton tee. Features the classic anaglyph logo.",
        basePrice: 25.00,
        img: "bandImages/SAMPLEdarkT.jpg"
    },
    {
        id: "p_103",
        name: "Gradient Hoodie",
        desc: "Cotton Hoodie with front pocket. Features a large gradient logo on the back.",
        basePrice: 45.00,
        img: "bandImages/SAMPLEHoodie.jpg"
    },
    {
        id: "p_104",
        name: "Logo Dad Hat",
        desc: "Adjustable strapback hat with embroidered logo detailing.",
        basePrice: 20.00,
        img: "bandImages/SAMPLEHat.png"
    }
];

// --- 2. Application State ---
let cart = []; // Array to hold purchased items
let currentActiveProduct = null; // Tracks which product is open in the modal

// --- 3. DOM Element Selection ---
const shopGrid = document.getElementById('shop-grid');
const cartCount = document.getElementById('cart-count');
const cartDrawer = document.getElementById('cart-drawer');
const cartOverlay = document.getElementById('cart-drawer-overlay');
const cartItemsContainer = document.getElementById('cart-items-container');
const cartSubtotal = document.getElementById('cart-subtotal');

const productModal = document.querySelector('.product-modal');
const modalOverlay = document.getElementById('product-modal-overlay');
const sizeSelect = document.getElementById('size-select');
const modalPriceText = document.getElementById('modal-price');

// --- 4. Initialization ---
document.addEventListener('DOMContentLoaded', () => {
    
    // Handle Mobile Menu Toggle (Reused from index.html logic)
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    menuToggle.addEventListener('click', () => navMenu.classList.toggle('active'));

    // Render the store grid
    renderShop();

    // Event Listeners for UI Panels
    document.getElementById('cart-toggle-btn').addEventListener('click', toggleCart);
    document.getElementById('close-cart-btn').addEventListener('click', toggleCart);
    cartOverlay.addEventListener('click', toggleCart);

    document.getElementById('close-modal-btn').addEventListener('click', closeModal);
    // Only close if the user clicked the dark overlay specifically, not the modal inside it
    modalOverlay.addEventListener('click', (event) => {
        if (event.target === modalOverlay) {
            closeModal();
        }
    });

    // Event Listener for changing size (Recalculates price dynamically)
    sizeSelect.addEventListener('change', calculateModalPrice);

    // Add to Cart Action
    document.getElementById('add-to-cart-btn').addEventListener('click', addItemToCart);
    
    // Checkout Action (Placeholder)
    document.getElementById('checkout-btn').addEventListener('click', () => {
        if(cart.length === 0) return;
        alert("Stripe Checkout will launch from here!");
    });


    renderGlitchAnimation();


});

// --- 5. Core Functions ---

function renderShop() {
    shopGrid.innerHTML = '';
    mockProducts.forEach(product => {
        const card = document.createElement('div');
        card.className = 'shop-card';
        // Attaching click listener directly to the card to open modal
        card.onclick = () => openModal(product);
        
        card.innerHTML = `
            <img src="${product.img}" alt="${product.name}" class="shop-card-img">
            <h3>${product.name}</h3>
            <p class="price">$${product.basePrice.toFixed(2)}</p>
        `;
        shopGrid.appendChild(card);
    });
}

function openModal(product) {
    currentActiveProduct = product;
    
    // Populate modal data
    document.getElementById('modal-img').src = product.img;
    document.getElementById('modal-title').innerText = product.name;
    document.getElementById('modal-desc').innerText = product.desc;
    
    // Reset dropdown to Medium
    sizeSelect.value = "M"; 
    
    // Determine if product needs a size selector (e.g. hide it for Vinyl/Hats)
    const formGroup = document.querySelector('.product-modal .form-group');
    if (product.name.includes("Vinyl") || product.name.includes("Hat")) {
        formGroup.style.display = "none";
    } else {
        formGroup.style.display = "flex";
    }

    calculateModalPrice(); // Set initial price
    
    modalOverlay.classList.add('active');
    productModal.classList.add('active');
}

function closeModal() {
    modalOverlay.classList.remove('active');
    productModal.classList.remove('active');
    currentActiveProduct = null;
}

function calculateModalPrice() {
    if (!currentActiveProduct) return;
    
    let price = currentActiveProduct.basePrice;
    const selectedSize = sizeSelect.value;
    
    // Example Printful Logic: 2XL sizes cost $2.00 more to print
    if (selectedSize === '2XL') {
        price += 2.00;
    }
    
    modalPriceText.innerText = `$${price.toFixed(2)}`;
}

function addItemToCart() {
    if (!currentActiveProduct) return;

    let finalPrice = currentActiveProduct.basePrice;
    let selectedSize = sizeSelect.value;

    // Determine if sizing applies based on visibility of the selector
    const isSizable = document.querySelector('.product-modal .form-group').style.display !== "none";
    
    if (isSizable && selectedSize === '2XL') {
        finalPrice += 2.00;
    }

    // Build the cart item object
    const cartItem = {
        cartId: Date.now().toString(), // Unique ID for array manipulation
        productId: currentActiveProduct.id,
        name: currentActiveProduct.name,
        size: isSizable ? selectedSize : "One Size",
        price: finalPrice,
        img: currentActiveProduct.img
    };

    cart.push(cartItem);
    
    closeModal();
    updateCartUI();
    
    // Automatically slide out the cart drawer so the user sees it was added
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

// Global scope function so the inline HTML onclick works
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
        // 1. Calculate height percentages (Same as before)
        let sliceHeightPercent = Math.random() * 9 + 3;

        if (i === numSlices - 1) {
        sliceHeightPercent = 100 - currentTopPercent;
        } else if (currentTopPercent + sliceHeightPercent > 100) {
        sliceHeightPercent = 100 - currentTopPercent;
        }

        const bottomInsetPercent = 100 - (currentTopPercent + sliceHeightPercent);

        // 2. Create the DOM element (Same as before)
        const sliceDiv = document.createElement('div');
        sliceDiv.classList.add('slice');
        sliceDiv.style.clipPath = `inset(${currentTopPercent}% 0 ${bottomInsetPercent}% 0)`;

        // ==========================================
        // NEW: Generate the Animation Variables
        // ==========================================
        
        // Pick a random distance between 2% and 8% of the logo's width.
        // We randomly multiply by 1 or -1 so some jump left, some jump right.
        // 1. Flip a coin (true or false) to decide direction
        const goesLeft = Math.random() > 0.5;
        
        // 2. Pick the distance. If it goes left, make it negative.
        const randomDistance = (Math.random() * 6 + 2) * (goesLeft ? -1 : 1);
        
        // 3. Assign the color based on the direction (Using classic glitch hex codes!)
        const sliceColor = goesLeft ? '#EE040F' : '#213ff9'; // Red for left, Cyan/Blue for right
        
        // Pick a very short duration between 0.1s and 0.3s
        const randomDuration = Math.random() * 0.1 + 0.1;
        
        // Pick a random start delay between 0s and 1.5s
        const randomDelay = Math.random();

        // Inject these specific numbers directly into the slice's inline CSS
        sliceDiv.style.setProperty('--glitch-x', `${randomDistance}%`);
        sliceDiv.style.setProperty('--glitch-color', sliceColor);
        sliceDiv.style.setProperty('--glitch-dur', `${randomDuration}s`);
        sliceDiv.style.setProperty('--glitch-delay', `${randomDelay}s`);

        // Add it to the container
        container.appendChild(sliceDiv);
        currentTopPercent += sliceHeightPercent;
        
        if (currentTopPercent >= 100) break; 
    }

    // ==========================================
    // The Animation Trigger Mechanism
    // ==========================================

    const playGlitchAnimation = () => {
        // If it's currently playing, ignore the hover so it doesn't flicker/restart awkwardly
        if (container.classList.contains('glitch-active')) return;

        // Turn the animation on
        container.classList.add('glitch-active');

        // Our max delay is 1.5s, max duration is 0.3s. 
        // After 2 seconds, the whole sequence is definitely over.
        // We remove the class so it is "reset" and ready to be hovered again.
        setTimeout(() => {
        container.classList.remove('glitch-active');
        }, 2000);
    };

    // Trigger 1: Play once immediately when the page loads
    playGlitchAnimation();

    // Trigger 2: Play again every time the mouse enters the logo
    container.addEventListener('mouseenter', playGlitchAnimation);

}