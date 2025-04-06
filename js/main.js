// Book favorite functionality
document.querySelectorAll('.favorite-button').forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        button.classList.toggle('active');
        const icon = button.querySelector('i');
        if (button.classList.contains('active')) {
            icon.classList.add('text-red-500');
        } else {
            icon.classList.remove('text-red-500');
        }
    });
});

// Download website functionality
const downloadButton = document.querySelector('.cta-section .button');
if (downloadButton) {
    downloadButton.addEventListener('click', async () => {
        try {
            // Here you would typically trigger the download
            // For now, we'll just show a success message
            alert('Download started! Check your downloads folder.');
        } catch (error) {
            console.error('Download failed:', error);
            alert('Download failed. Please try again later.');
        }
    });
}

// Smooth scroll for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add loading animation to images
document.querySelectorAll('img').forEach(img => {
    img.addEventListener('load', function() {
        this.classList.add('loaded');
    });
});

// Initialize any tooltips or popovers
document.querySelectorAll('[data-tooltip]').forEach(element => {
    element.addEventListener('mouseenter', e => {
        const tooltip = document.createElement('div');
        tooltip.className = 'tooltip';
        tooltip.textContent = e.target.dataset.tooltip;
        document.body.appendChild(tooltip);

        const rect = e.target.getBoundingClientRect();
        tooltip.style.top = rect.top - tooltip.offsetHeight - 10 + 'px';
        tooltip.style.left = rect.left + (rect.width - tooltip.offsetWidth) / 2 + 'px';
    });

    element.addEventListener('mouseleave', () => {
        document.querySelector('.tooltip')?.remove();
    });
}); 