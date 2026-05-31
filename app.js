// Local mock data schema for immediate rendering
const mockTourDates = [
    { date: "JUN 12", venue: "Bobby's Bar", location: "Philadelphia, PA", link: "#" },
    { date: "JUN 18", venue: "The Poop Room", location: "New York, NY", link: "#" },
    { date: "JUL 02", venue: "Sick Place", location: "Boston, MA", link: "#" },
    { date: "JUL 15", venue: "The Club", location: "Washington, DC", link: "#" }
];

document.addEventListener('DOMContentLoaded', () => {
    
    // --- Mobile Navigation Menu Handler ---
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const navItems = document.querySelectorAll('.nav-item');

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

    // --- Render Tour Module ---
    renderTourDates(mockTourDates);

    renderGlitchAnimation();





});

function renderTourDates(dates) {
    const container = document.getElementById('tour-dates-container');
    container.innerHTML = '';

    if (dates.length === 0) {
        container.innerHTML = '<p>No shows scheduled. Check back soon!</p>';
        return;
    }

    dates.forEach(show => {
        const row = document.createElement('div');
        row.className = 'tour-row';
        row.innerHTML = `
            <div class="tour-date">${show.date}</div>
            <div class="tour-venue">${show.venue}</div>
            <div class="tour-location">${show.location}</div>
            <div>
                <a href="${show.link}" target="_blank" class="btn">Tickets</a>
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