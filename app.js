// Local mock data schema for immediate rendering
const SHEET_ID = "10xcm0Mwbw86-RCxINRvJuFdBu1mcwTLZaV-XlNKnTGQ"; // Placeholder Google Sheet ID
const API_KEY = "AIzaSyDgdSOkirNDWg1K-CpdQTkmuQ73OjYawv0";
const SHOWS_TAB_NAME = 'shows';
const CONTACTS_TAB_NAME = 'contacts';

const API_URL = `https://sheets.googleapis.com/v4/spreadsheets/${SHEET_ID}/values/${SHOWS_TAB_NAME}?key=${API_KEY}`;

const PRINTFUL_API_URL = "https://t8ry0h2y8g.execute-api.us-east-2.amazonaws.com/products";
const featuredGrid = document.getElementById('featured-grid');

document.addEventListener('DOMContentLoaded', () => {
    
    // --- Mobile Navigation Menu Handler ---
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const navItems = document.querySelectorAll('.nav-item');

    const fadeImages = document.querySelectorAll('.fade-img');

    // Toggle menu view open/closed
    menuToggle.addEventListener('click', () => {
        navMenu.classList.toggle('active');
        menuToggle.classList.toggle('open'); // Useful structural hook if you want to animate hamburger lines into an 'X'
    });

    // Close menu automatically when a link is clicked (crucial for single-page viewport jumping)
    navItems.forEach(item => {
        item.addEventListener('click', () => {
            navMenu.classList.remove('active');
        });
    });


    if (fadeImages.length > 0) {
        let currentImageIndex = 0;

        setInterval(() => {
            // Fade out the current image
            fadeImages[currentImageIndex].classList.remove('active');
            
            // Calculate the index of the next image (loops back to 0 at the end)
            currentImageIndex = (currentImageIndex + 1) % fadeImages.length;
            
            // Fade in the next image
            fadeImages[currentImageIndex].classList.add('active');
            
        }, 4000); // 4000ms = 4 seconds per image. Adjust as needed!
    }


    fetchLiveTourDates();

    loadFeaturedMerch();

    renderGlitchAnimation();

});


async function loadFeaturedMerch() {
    try {
        const response = await fetch(PRINTFUL_API_URL);
        if (!response.ok) throw new Error('Failed to fetch store items');
        
        const products = await response.json();
        
        // Cap the preview at exactly 4 products
        const previewItems = products.slice(1, 5);
        
        featuredGrid.innerHTML = previewItems.map(product => {
            // Grab the retail price from the first variant to use as the baseline "From $X.XX" price
            const basePrice = product.variants && product.variants.length > 0 
                ? product.variants[0].price 
                : 0;

            return `
                <a href="shop.html" class="merch-item" style="text-decoration: none; color: inherit;">
                    <img src="${product.img}" alt="${product.name}" oncontextmenu="return false;" ondragstart="return false;">
                    <h3>${product.name}</h3>
                    <!-- <p class="price">$${basePrice.toFixed(2)}</p> -->
                </a>
            `;
        }).join('');
        
    } catch (error) {
        console.error('Error loading featured merch:', error);
        // Fallback UI gracefully handled if your backend is sleeping or spinning up
        featuredGrid.innerHTML = `<p class="error-msg">Check back soon for official merchandise!</p>`;
    }
}


async function fetchLiveTourDates() {
    const container = document.getElementById('tour-dates-container');

    try {
        const response = await fetch(API_URL);
        if (!response.ok) {
            throw new Error('Network response tracking failed');
        }
        
        const data = await response.json();
        const rows = data.values; // This extracts the raw rows grid from Google

        // If the sheet is empty or only contains headers
        if (!rows || rows.length <= 1) {
            container.innerHTML = '<p class="loading">No upcoming shows scheduled. Check back soon!</p>';
            return;
        }

        // Extract headers from Row 1, and the data elements from subsequent rows
        const headers = rows[0]; 
        const dataRows = rows.slice(1); 

        // Convert raw arrays into clean JavaScript objects matching our layout format
        const formattedShows = dataRows.map(row => {
            return {
                date: row[headers.indexOf('date')] || '',
                venue: row[headers.indexOf('venue')] || '',
                location: row[headers.indexOf('location')] || '',
                ticketsAvailable: row[headers.indexOf('ticketsAvailable')] || 'FALSE',
                ticketsLink: row[headers.indexOf('ticketsLink')] || '#'
            };
        });

        // Send the formatted data to your existing UI generator
        renderTourDates(formattedShows);

    } catch (error) {
        console.error("Error loading tour dates:", error);
        container.innerHTML = '<p class="loading" style="color: var(--accent-red);">Error loading tour dates. Please refresh.</p>';
    }
}

function formatDate(dateString) {

    const safeDateString = dateString.replace(/-/g, '/');
    const date = new Date(safeDateString);

    const options = { month: 'short', day: 'numeric' };
    const currentYear = new Date().getFullYear();

    if (date.getFullYear() > currentYear) {
        options.year = 'numeric';
    }
    
    return date.toLocaleDateString('en-US', options).toUpperCase();
}

function renderTourDates(dates) {
    const container = document.getElementById('tour-dates-container');
    container.innerHTML = '';

    dates.forEach(show => {

        if (!show.date || !show.venue || !show.location) {
            return;
        }

        const row = document.createElement('div');
        row.className = 'show-row';

        const isAvailable = show.ticketsAvailable.toUpperCase() === 'TRUE';

        row.innerHTML = `
            <div class="show-date">${formatDate(show.date)}</div>
            <div class="show-venue">${show.venue}</div>
            <div class="show-location">${show.location}</div>
            <div>
                ${isAvailable 
                    ? `<a href="${show.ticketsLink}" target="_blank" class="btn">Tickets</a>` 
                    : `<span class="show-message">Come see us!</span>`
                }
            </div>
        `;
        container.appendChild(row);
    });
}

function renderGlitchAnimation() {

    const container = document.getElementById('logo-container');
    const numSlices = 20; 
    let currentTopPercent = 0;

    for (let i = 0; i < numSlices; i++) {
        // Calculate height percentages
        let sliceHeightPercent = Math.random() * 9 + 3;

        if (i === numSlices - 1) {
        sliceHeightPercent = 100 - currentTopPercent;
        } else if (currentTopPercent + sliceHeightPercent > 100) {
        sliceHeightPercent = 100 - currentTopPercent;
        }

        const bottomInsetPercent = 100 - (currentTopPercent + sliceHeightPercent);

        // Create the DOM element
        const sliceDiv = document.createElement('div');
        sliceDiv.classList.add('slice');
        sliceDiv.style.clipPath = `inset(${currentTopPercent}% 0 ${bottomInsetPercent}% 0)`;

        // ==========================================
        // Generate the Animation Variables
        // ==========================================
        
        // Pick a random distance between 2% and 8% of the logo's width.
        // We randomly multiply by 1 or -1 so some jump left, some jump right.
        // Flip a coin (true or false) to decide direction
        const goesLeft = Math.random() > 0.5;
        
        // Pick the distance. If it goes left, make it negative.
        const randomDistance = (Math.random() * 6 + 2) * (goesLeft ? -1 : 1);
        
        // Assign the color based on the direction 
        const sliceColor = goesLeft ? '#EE040F' : '#33C5E8'; // Red for left, Cyan/Blue for right
        
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




/* ==========================================================================
   CONTACT SECTION FORM HANDLER
   ========================================================================== */

const SCRIPT_ID = 'AKfycbytv7nRCKKDV-_ONjLKeevDv-PmmX_-9pfiYQz9RZ4wHRm6qbin13tOyb26CLIjM797ng';
const scriptURL = `https://script.google.com/macros/s/${SCRIPT_ID}/exec`;
const form = document.forms['submit-to-google-sheet'];
const msg = document.getElementById("msg");

form.addEventListener('submit', e => {
    document.getElementById('timestamp').value = new Date().toISOString();
    msg.innerHTML = "Sending..."
    e.preventDefault()
    fetch(scriptURL, { method: 'POST', body: new FormData(form)})
        .then(response => {
            msg.innerHTML = "Message Sent! We will reach out soon."
            msg.style.color = "#61b752"
            setTimeout(function() {
                msg.innerHTML = ""
                msg.style.color = "#fff"
            }, 5000)
            form.reset()
        })
        .catch(error => {
            console.error('Error!', error.message)
            msg.innerHTML = "Failed to send message. Please refresh page and try again."
            msg.style.color = "#cb1a1a"
            setTimeout(function() {
                error.innerHTML = ""
                msg.style.color = "#fff"
            }, 5000)
        })
})