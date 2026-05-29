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