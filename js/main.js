// Bootstrap handles mobile menu automatically via navbar collapse
document.addEventListener('DOMContentLoaded', function() {
    // Hero Carousel Auto-Slideshow
    initHeroCarousel();

    // Form validation and handling
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
            }
        });
    }

    const enquiryForm = document.getElementById('enquiryForm');
    if (enquiryForm) {
        enquiryForm.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
            }
        });
    }

    const ctaContactForm = document.getElementById('ctaContactForm');
    if (ctaContactForm) {
        // Add real-time validation
        const ctaFields = ctaContactForm.querySelectorAll('input, textarea');
        ctaFields.forEach(field => {
            // Validate on blur (when user leaves the field)
            field.addEventListener('blur', function() {
                validateField(this);
            });
            
            // Clear error on input
            field.addEventListener('input', function() {
                if (this.style.borderColor === 'rgb(239, 68, 68)' || this.style.borderColor === '#ef4444') {
                    clearFieldError(this);
                }
            });
        });

        // Special handling for phone number field - prevent entering too many digits
        const phoneField = ctaContactForm.querySelector('input[type="tel"]');
        if (phoneField) {
            phoneField.addEventListener('input', function(e) {
                const value = this.value;
                const digitsOnly = value.replace(/\D/g, '');
                
                // Prevent entering more than 15 digits
                if (digitsOnly.length > 15) {
                    // Keep only first 15 digits
                    let formatted = value;
                    let digitCount = 0;
                    let newValue = '';
                    
                    for (let i = 0; i < formatted.length; i++) {
                        if (/\d/.test(formatted[i])) {
                            if (digitCount < 15) {
                                newValue += formatted[i];
                                digitCount++;
                            }
                        } else {
                            newValue += formatted[i];
                        }
                    }
                    
                    this.value = newValue;
                    
                    // Show warning if approaching limit
                    if (digitCount === 15) {
                        const existingWarning = phoneField.parentElement.querySelector('.phone-warning');
                        if (!existingWarning) {
                            const warning = document.createElement('div');
                            warning.className = 'phone-warning';
                            warning.style.cssText = 'color: #f59e0b; font-size: 12px; margin-top: 5px;';
                            warning.textContent = 'Maximum 15 digits allowed';
                            phoneField.parentElement.appendChild(warning);
                        }
                    }
                } else {
                    // Remove warning if within limit
                    const existingWarning = phoneField.parentElement.querySelector('.phone-warning');
                    if (existingWarning) {
                        existingWarning.remove();
                    }
                }
            });
        }

        // Validate on submit
        ctaContactForm.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
                // Scroll to first error
                const firstError = this.querySelector('.field-error');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
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

    // Add animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe service cards, feature cards, etc.
    const animatedElements = document.querySelectorAll('.service-card, .feature-card, .service-detail-card, .contact-info-card, .why-choose-item');
    animatedElements.forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(element);
    });

    // Handle success/error messages from URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const success = urlParams.get('success');
    const error = urlParams.get('error');

    if (success) {
        showMessage('Thank you! Your message has been sent successfully. We will get back to you soon.', 'success');
    }

    if (error) {
        let errorMessage = 'Something went wrong. Please try again.';
        switch(error) {
            case 'missing_fields':
                errorMessage = 'Please fill in all required fields.';
                break;
            case 'invalid_email':
                errorMessage = 'Please enter a valid email address.';
                break;
            case 'send_failed':
                errorMessage = 'Failed to send message. Please try again or contact us directly.';
                break;
        }
        showMessage(errorMessage, 'error');
    }
});

// Form validation function
function validateForm(form) {
    let isValid = true;
    const requiredFields = form.querySelectorAll('[required]');

    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            showFieldError(field, 'This field is required');
        } else {
            clearFieldError(field);
        }
    });

    // Email validation
    const emailFields = form.querySelectorAll('input[type="email"]');
    emailFields.forEach(field => {
        if (field.value && !isValidEmail(field.value)) {
            isValid = false;
            showFieldError(field, 'Please enter a valid email address');
        }
    });

    // Phone validation
    const phoneFields = form.querySelectorAll('input[type="tel"]');
    phoneFields.forEach(field => {
        if (field.value && !isValidPhone(field.value)) {
            isValid = false;
            showFieldError(field, 'Please enter a valid phone number with country code (e.g., +91 9999999999)');
        }
    });

    return isValid;
}

// Email validation
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Phone validation (supports country codes)
function isValidPhone(phone) {
    if (!phone || !phone.trim()) {
        return false;
    }
    
    // Remove all non-digit characters to check length
    const digitsOnly = phone.replace(/\D/g, '');
    
    // Allow phone numbers with country code (10-15 digits total)
    // Format: +91 9999999999 or 91 9999999999 or 9999999999
    const phoneRegex = /^[\+]?[0-9\s\-\(\)]+$/;
    
    // Validate format first
    if (!phoneRegex.test(phone)) {
        return false;
    }
    
    // Must have exactly 10-15 digits (reasonable range for international phone numbers)
    // Prevents users from entering extremely long numbers
    if (digitsOnly.length < 10 || digitsOnly.length > 15) {
        return false;
    }
    
    // Additional check: if starts with +, should have at least 11 digits (country code + number)
    if (phone.trim().startsWith('+') && digitsOnly.length < 11) {
        return false;
    }
    
    return true;
}

// Show field error
function showFieldError(field, message) {
    clearFieldError(field);
    field.style.borderColor = '#ef4444';
    
    // Add error class for styling
    field.classList.add('field-error-active');
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.style.color = '#ef4444';
    errorDiv.style.fontSize = '13px';
    errorDiv.style.marginTop = '6px';
    errorDiv.style.fontWeight = '500';
    errorDiv.style.display = 'flex';
    errorDiv.style.alignItems = 'center';
    errorDiv.style.gap = '5px';
    
    // Add error icon
    errorDiv.innerHTML = `<i class="bi bi-exclamation-circle" style="font-size: 14px;"></i> ${message}`;
    
    field.parentElement.appendChild(errorDiv);
    
    // Add shake animation
    field.style.animation = 'shake 0.4s ease';
    setTimeout(() => {
        field.style.animation = '';
    }, 400);
}

// Validate individual field
function validateField(field) {
    let isValid = true;
    let errorMessage = '';

    // Check if required field is empty
    if (field.hasAttribute('required') && !field.value.trim()) {
        isValid = false;
        errorMessage = 'This field is required';
    }
    // Validate email
    else if (field.type === 'email' && field.value && !isValidEmail(field.value)) {
        isValid = false;
        errorMessage = 'Please enter a valid email address';
    }
    // Validate phone
    else if (field.type === 'tel' && field.value && !isValidPhone(field.value)) {
        isValid = false;
        const digitsOnly = field.value.replace(/\D/g, '');
        if (digitsOnly.length < 10) {
            errorMessage = 'Phone number must have at least 10 digits';
        } else if (digitsOnly.length > 15) {
            errorMessage = 'Phone number cannot exceed 15 digits';
        } else {
            errorMessage = 'Please enter a valid phone number with country code (10-15 digits, e.g., +91 9999999999)';
        }
    }

    if (!isValid) {
        showFieldError(field, errorMessage);
    } else {
        clearFieldError(field);
        // Show success indicator for filled valid fields
        if (field.value.trim()) {
            field.style.borderColor = '#10b981';
            setTimeout(() => {
                if (field.value.trim()) {
                    field.style.borderColor = '#e9ecef';
                }
            }, 2000);
        }
    }

    return isValid;
}

// Clear field error
function clearFieldError(field) {
    // Reset border color based on form type
    if (field.closest('.cta-contact-form')) {
        field.style.borderColor = '#e9ecef';
    } else {
        field.style.borderColor = '#e5e7eb';
    }
    
    const existingError = field.parentElement.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }
}

// Show message notification
function showMessage(message, type) {
    const messageDiv = document.createElement('div');
    messageDiv.className = 'notification-message';
    messageDiv.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 20px 30px;
        background-color: ${type === 'success' ? '#10b981' : '#ef4444'};
        color: white;
        border-radius: 5px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        z-index: 10000;
        max-width: 400px;
        animation: slideInRight 0.5s ease;
    `;
    messageDiv.textContent = message;

    document.body.appendChild(messageDiv);

    setTimeout(() => {
        messageDiv.style.animation = 'slideOutRight 0.5s ease';
        setTimeout(() => {
            messageDiv.remove();
        }, 500);
    }, 5000);
}

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }

    @keyframes shake {
        0%, 100% {
            transform: translateX(0);
        }
        10%, 30%, 50%, 70%, 90% {
            transform: translateX(-5px);
        }
        20%, 40%, 60%, 80% {
            transform: translateX(5px);
        }
    }

    .field-error-active:focus {
        border-color: #ef4444 !important;
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1) !important;
    }
`;
document.head.appendChild(style);

// Hero Carousel Function
function initHeroCarousel() {
    const slides = document.querySelectorAll('.hero-slide');
    const indicators = document.querySelectorAll('.hero-carousel-indicators .indicator');
    const heroTitle = document.querySelector('.hero-title');
    const heroSubtitle = document.querySelector('.hero-subtitle');
    const heroDescription = document.querySelector('.hero-description');
    
    if (slides.length === 0) return;
    
    let currentSlide = 0;
    const totalSlides = slides.length;
    const slideInterval = 7000; // 7 seconds per slide (increased from 5 seconds)
    let carouselInterval = null;
    
    function updateText(index) {
        const slide = slides[index];
        if (!slide) return;
        
        const title = slide.getAttribute('data-title');
        const subtitle = slide.getAttribute('data-subtitle');
        const description = slide.getAttribute('data-description');
        
        if (title && heroTitle) {
            heroTitle.style.opacity = '0';
            setTimeout(() => {
                heroTitle.textContent = title;
                heroTitle.style.opacity = '1';
            }, 300);
        }
        
        if (subtitle && heroSubtitle) {
            heroSubtitle.style.opacity = '0';
            setTimeout(() => {
                heroSubtitle.textContent = subtitle;
                heroSubtitle.style.opacity = '1';
            }, 350);
        }
        
        if (description && heroDescription) {
            heroDescription.style.opacity = '0';
            setTimeout(() => {
                heroDescription.textContent = description;
                heroDescription.style.opacity = '1';
            }, 400);
        }
    }
    
    function showSlide(index) {
        // Remove active class from all slides and indicators
        slides.forEach(slide => slide.classList.remove('active'));
        indicators.forEach(indicator => indicator.classList.remove('active'));
        
        // Add active class to current slide and indicator
        if (slides[index]) {
            slides[index].classList.add('active');
        }
        if (indicators[index]) {
            indicators[index].classList.add('active');
        }
        
        // Update text content
        updateText(index);
    }
    
    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }
    
    function startCarousel() {
        // Clear any existing interval
        if (carouselInterval) {
            clearInterval(carouselInterval);
        }
        // Start auto-advance
        carouselInterval = setInterval(nextSlide, slideInterval);
    }
    
    // Initialize first slide
    showSlide(currentSlide);
    
    // Wait a bit after initial load, then start auto-advance
    // This ensures everything is loaded and the first slide is fully displayed
    setTimeout(() => {
        startCarousel();
    }, slideInterval); // Wait one full interval before starting to auto-advance
    
    // Click on indicators to navigate
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            currentSlide = index;
            showSlide(currentSlide);
            // Reset the interval
            startCarousel();
        });
    });
    
    // Pause on hover
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        heroSection.addEventListener('mouseenter', () => {
            if (carouselInterval) {
                clearInterval(carouselInterval);
                carouselInterval = null;
            }
        });
        
        heroSection.addEventListener('mouseleave', () => {
            startCarousel();
        });
    }
}

