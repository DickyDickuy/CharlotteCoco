// Main JavaScript functionality
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    
    mobileMenuBtn.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
    });

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const headerHeight = document.querySelector('header').offsetHeight;
                const targetPosition = target.offsetTop - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
            
            // Close mobile menu if open
            if (!mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
            }
        });
    });

    // Header scroll effect
    const header = document.querySelector('header');
    let lastScrollTop = 0;
    
    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > 100) {
            header.classList.add('shadow-lg');
        } else {
            header.classList.remove('shadow-lg');
        }
        
        // Hide header on scroll down, show on scroll up
        if (scrollTop > lastScrollTop && scrollTop > 200) {
            header.style.transform = 'translateY(-100%)';
        } else {
            header.style.transform = 'translateY(0)';
        }
        
        lastScrollTop = scrollTop;
    });

    // Back to top button
    const backToTopBtn = document.getElementById('back-to-top');
    
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopBtn.classList.remove('opacity-0', 'invisible');
            backToTopBtn.classList.add('opacity-100', 'visible');
        } else {
            backToTopBtn.classList.add('opacity-0', 'invisible');
            backToTopBtn.classList.remove('opacity-100', 'visible');
        }
    });
    
    backToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in-up');
                
                // Add floating animation to coal pieces
                if (entry.target.classList.contains('coal-samples')) {
                    entry.target.classList.add('float-animation');
                }
                
                // Counter animation for statistics (if any)
                if (entry.target.classList.contains('counter')) {
                    animateCounter(entry.target);
                }
            }
        });
    }, observerOptions);

    // Observe elements for animation
    document.querySelectorAll('.product-image, .coal-samples, h2, h3, p').forEach(el => {
        observer.observe(el);
    });

    // Product hover effects
    document.querySelectorAll('.product-image').forEach(image => {
        image.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05) rotate(2deg)';
        });
        
        image.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
        });
    });

    // Coal pieces interactive animation
    document.querySelectorAll('.coal-piece').forEach(piece => {
        piece.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.2) rotate(5deg)';
            this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.4)';
        });
        
        piece.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
            this.style.boxShadow = '0 4px 8px rgba(0,0,0,0.3)';
        });
    });

    // Parallax effect for hero section
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const heroSection = document.querySelector('.hero-section');
        if (heroSection) {
            heroSection.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
    });

    // Dynamic typing effect for hero text
    const heroTitle = document.querySelector('.hero-section h1');
    if (heroTitle) {
        const text = heroTitle.textContent;
        heroTitle.textContent = '';
        let i = 0;
        
        function typeWriter() {
            if (i < text.length) {
                heroTitle.textContent += text.charAt(i);
                i++;
                setTimeout(typeWriter, 100);
            }
        }
        
        setTimeout(typeWriter, 1000);
    }

    // Product showcase carousel (if multiple products)
    let currentProduct = 0;
    const products = document.querySelectorAll('.product-showcase');
    
    function showNextProduct() {
        if (products.length > 1) {
            products[currentProduct].classList.add('opacity-0');
            currentProduct = (currentProduct + 1) % products.length;
            setTimeout(() => {
                products.forEach(p => p.classList.add('hidden'));
                products[currentProduct].classList.remove('hidden');
                setTimeout(() => {
                    products[currentProduct].classList.remove('opacity-0');
                }, 50);
            }, 300);
        }
    }

    // Auto-rotate products every 5 seconds
    if (products.length > 1) {
        setInterval(showNextProduct, 5000);
    }

    // Form handling (if contact form exists)
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simple form validation
            const formData = new FormData(this);
            const name = formData.get('name');
            const email = formData.get('email');
            const message = formData.get('message');
            
            if (!name || !email || !message) {
                showNotification('Please fill in all fields', 'error');
                return;
            }
            
            if (!isValidEmail(email)) {
                showNotification('Please enter a valid email address', 'error');
                return;
            }
            
            // Simulate form submission
            showNotification('Thank you for your message! We will contact you soon.', 'success');
            this.reset();
        });
    }

    // Email validation
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Notification system
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-20 right-4 p-4 rounded-lg z-50 transition-all duration-300 ${
            type === 'success' ? 'bg-green-500' : 
            type === 'error' ? 'bg-red-500' : 'bg-blue-500'
        } text-white`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    // Lazy loading for images
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('loading');
                observer.unobserve(img);
            }
        });
    });

    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });

    // Search functionality (if search exists)
    const searchInput = document.getElementById('search');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const products = document.querySelectorAll('.product-item');
            
            products.forEach(product => {
                const productName = product.querySelector('h3').textContent.toLowerCase();
                const productDesc = product.querySelector('p').textContent.toLowerCase();
                
                if (productName.includes(searchTerm) || productDesc.includes(searchTerm)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        });
    }

    // Initialize AOS (Animate On Scroll) if available
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });
    }

    // Performance monitoring
    if ('performance' in window) {
        window.addEventListener('load', function() {
            const loadTime = performance.timing.loadEventEnd - performance.timing.navigationStart;
            console.log(`Page loaded in ${loadTime}ms`);
        });
    }

    // Add loading states to buttons
    document.querySelectorAll('button, .btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (!this.classList.contains('loading')) {
                this.classList.add('loading');
                const originalText = this.textContent;
                this.textContent = 'Loading...';
                
                setTimeout(() => {
                    this.classList.remove('loading');
                    this.textContent = originalText;
                }, 2000);
            }
        });
    });

    // Cookie consent (simple implementation)
    if (!localStorage.getItem('cookieConsent')) {
        const cookieBanner = document.createElement('div');
        cookieBanner.className = 'fixed bottom-0 left-0 right-0 bg-gray-900 text-white p-4 z-50';
        cookieBanner.innerHTML = `
            <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
                <p class="mb-4 md:mb-0">We use cookies to enhance your experience on our website.</p>
                <button id="accept-cookies" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    Accept
                </button>
            </div>
        `;
        
        document.body.appendChild(cookieBanner);
        
        document.getElementById('accept-cookies').addEventListener('click', function() {
            localStorage.setItem('cookieConsent', 'true');
            document.body.removeChild(cookieBanner);
        });
    }

    // Drag & drop image swap for containers
    const droppables = document.querySelectorAll('.droppable-image');
    droppables.forEach(zone => {
        ['dragenter','dragover'].forEach(evt => zone.addEventListener(evt, e => {
            e.preventDefault();
            e.stopPropagation();
            zone.classList.add('dragover');
        }));
        ['dragleave','dragend','drop'].forEach(evt => zone.addEventListener(evt, e => {
            e.preventDefault();
            e.stopPropagation();
            if (evt !== 'drop') zone.classList.remove('dragover');
        }));
        zone.addEventListener('drop', async e => {
            const file = e.dataTransfer?.files?.[0];
            if (!file) return;
            if (!file.type.startsWith('image/')) {
                DjavaCoal?.showNotification?.('Please drop an image file', 'error');
                return;
            }
            const url = URL.createObjectURL(file);
            applyImageToZone(zone, url);
            zone.classList.remove('dragover');
        });
    });
});

// Utility functions
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// Export functions for external use
window.DjavaCoal = {
    showNotification: showNotification,
    debounce: debounce,
    throttle: throttle
};

// Helper: set dropped image into the frame
function applyImageToZone(zone, url){
    // Prefer <img> child if exists; else set background on .ratio-content
    const img = zone.querySelector('img');
    if (img) {
        img.src = url;
        img.classList.add('object-cover');
        img.classList.add('ratio-content');
        return;
    }
    const content = zone.querySelector('.ratio-content');
    if (content) {
        content.style.backgroundImage = `url('${url}')`;
        content.style.backgroundSize = 'cover';
        content.style.backgroundPosition = 'center';
    }
}
