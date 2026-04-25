// Set active nav link
function setActiveNav() {
    const currentPage = window.location.pathname.split('/').pop() || 'index.html';
    const navLinks = document.querySelectorAll('.nav a');
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === currentPage) {
            link.classList.add('active');
        }
    });
}

// Click image to enlarge
function initImageEnlarge() {
    const galleryImages = document.querySelectorAll('.gallery-item-image');
    
    galleryImages.forEach(img => {
        img.addEventListener('click', function() {
            const modal = document.createElement('div');
            modal.className = 'image-modal';
            modal.innerHTML = `
                <div class="image-modal-content">
                    <img src="${this.src}" alt="${this.alt}">
                    <button class="image-modal-close">&times;</button>
                </div>
            `;
            
            document.body.appendChild(modal);
            document.body.style.overflow = 'hidden';
            
            const closeModal = () => {
                modal.remove();
                document.body.style.overflow = 'auto';
            };

            modal.querySelector('.image-modal-close').onclick = closeModal;
            modal.onclick = (e) => { if (e.target === modal) closeModal(); };
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && document.body.contains(modal)) closeModal();
            }, { once: true });
        });
    });
}

// Accordion (FAQ)
function initAccordion() {
    const headers = document.querySelectorAll('.accordion-header');
    headers.forEach(header => {
        header.addEventListener('click', () => {
            const item = header.parentElement;
            const isActive = item.classList.contains('active');
            document.querySelectorAll('.accordion-item').forEach(i => i.classList.remove('active'));
            if (!isActive) item.classList.add('active');
        });
    });
}

// --- NEW: Carousel Logic ---
function initCarousel() {
    const items = document.querySelectorAll('.carousel-item');
    const prevBtn = document.querySelector('.carousel-prev');
    const nextBtn = document.querySelector('.carousel-next');
    
    if (!items.length) return; // Stop if no carousel exists on page

    let currentIndex = 0;

    function showSlide(index) {
        // Hide all
        items.forEach(item => item.classList.remove('active'));
        
        // Fix index bounds
        if (index >= items.length) currentIndex = 0;
        else if (index < 0) currentIndex = items.length - 1;
        else currentIndex = index;

        // Show active
        items[currentIndex].classList.add('active');
    }

    nextBtn.addEventListener('click', () => showSlide(currentIndex + 1));
    prevBtn.addEventListener('click', () => showSlide(currentIndex - 1));
}

document.addEventListener('DOMContentLoaded', () => {
    setActiveNav();
    initImageEnlarge();
    initAccordion();
    initCarousel(); // Run the carousel logic
});