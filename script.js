// JavaScript for Supahub Navbar

document.addEventListener('DOMContentLoaded', function() {
    
    // Navbar scroll effect
    const navbar = document.querySelector('.navbar');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });

    // Smooth scrolling for anchor links
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

    // Close mobile menu when clicking on a link
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                bsCollapse.hide();
            }
        });
    });

    // Add active state to current page link
    const currentPage = window.location.pathname;
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPage) {
            link.classList.add('active');
        }
    });

    // Dropdown hover effect for desktop
    const dropdowns = document.querySelectorAll('.dropdown');
    
    dropdowns.forEach(dropdown => {
        const dropdownMenu = dropdown.querySelector('.dropdown-menu');
        
        dropdown.addEventListener('mouseenter', function() {
            if (window.innerWidth >= 992) { // Desktop only
                dropdownMenu.classList.add('show');
            }
        });
        
        dropdown.addEventListener('mouseleave', function() {
            if (window.innerWidth >= 992) { // Desktop only
                dropdownMenu.classList.remove('show');
            }
        });
    });

    // Sign up button click handler - removed to allow normal navigation
    // The button now navigates directly to contact.html via href attribute

    // Add loading animation to navbar
    setTimeout(() => {
        navbar.style.opacity = '1';
        navbar.style.transform = 'translateY(0)';
    }, 100);

    // Input validation function
    function validateInput(input, type) {
        if (!input || typeof input !== 'string') return false;
        
        switch(type) {
            case 'email':
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(input.trim());
            case 'name':
                const nameRegex = /^[a-zA-Z\s]{2,50}$/;
                return nameRegex.test(input.trim());
            case 'message':
                return input.trim().length >= 10 && input.trim().length <= 1000;
            default:
                return input.trim().length > 0;
        }
    }

    // Contact form handling
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form elements
            const nameInput = this.querySelector('input[name="name"]');
            const emailInput = this.querySelector('input[name="email"]');
            const messageInput = this.querySelector('textarea[name="message"]');
            
            // Validate inputs
            let isValid = true;
            let errorMessage = '';
            
            if (!validateInput(nameInput.value, 'name')) {
                isValid = false;
                errorMessage = 'Please enter a valid name (2-50 characters, letters and spaces only).';
                nameInput.focus();
            } else if (!validateInput(emailInput.value, 'email')) {
                isValid = false;
                errorMessage = 'Please enter a valid email address.';
                emailInput.focus();
            } else if (!validateInput(messageInput.value, 'message')) {
                isValid = false;
                errorMessage = 'Please enter a message between 10 and 1000 characters.';
                messageInput.focus();
            }
            
            if (!isValid) {
                showNotification(errorMessage, 'error');
                return;
            }
            
            // Get form data
            const formData = new FormData(this);
            
            // Show loading state
            const submitBtn = this.querySelector('.submit-btn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
            submitBtn.disabled = true;
            
            // Send form data
            fetch('send_email.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    showNotification(data.message, 'success');
                    contactForm.reset();
                } else {
                    // Show error message
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('An error occurred. Please try again.', 'error');
            })
            .finally(() => {
                // Reset button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    }

    // Input sanitization function
    function sanitizeInput(input) {
        if (typeof input !== 'string') return '';
        return input
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#x27;')
            .replace(/\//g, '&#x2F;');
    }

    // Notification function
    function showNotification(message, type) {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.notification');
        existingNotifications.forEach(notification => notification.remove());
        
        // Sanitize inputs
        const sanitizedMessage = sanitizeInput(message);
        const sanitizedType = sanitizeInput(type);
        
        // Create notification element safely
        const notification = document.createElement('div');
        notification.className = `notification notification-${sanitizedType}`;
        
        // Create elements safely without innerHTML
        const content = document.createElement('div');
        content.className = 'notification-content';
        
        const icon = document.createElement('i');
        icon.className = `fas ${sanitizedType === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}`;
        
        const messageSpan = document.createElement('span');
        messageSpan.textContent = sanitizedMessage;
        
        const closeBtn = document.createElement('button');
        closeBtn.className = 'notification-close';
        closeBtn.addEventListener('click', function() {
            notification.remove();
        });
        
        const closeIcon = document.createElement('i');
        closeIcon.className = 'fas fa-times';
        closeBtn.appendChild(closeIcon);
        
        content.appendChild(icon);
        content.appendChild(messageSpan);
        content.appendChild(closeBtn);
        notification.appendChild(content);
        
        // Add to page
        document.body.appendChild(notification);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 5000);
    }

});

// Add CSS for navbar scroll effect
const style = document.createElement('style');
style.textContent = `
    .navbar {
        opacity: 0;
        transform: translateY(-10px);
        transition: all 0.3s ease;
    }
    
    .navbar-scrolled {
        background-color: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1) !important;
    }
    
    .dropdown-menu.show {
        display: block;
    }
`;
document.head.appendChild(style); 