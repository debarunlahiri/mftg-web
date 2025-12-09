<?php
require_once 'config.php';
$page_title = $page_titles['contact'];
require_once 'includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Contact Us</h1>
        <p>Get in touch with us for any queries or assistance</p>
    </div>
</section>

<!-- Contact Content -->
<section class="content-section">
    <div class="container">
        <div class="contact-container">
            <div class="contact-info-section">
                <h2>Get In Touch</h2>
                <p>We would love to hear from you! Reach out to us for any inquiries, quotes, or support.</p>
                
                <div class="contact-info-cards">
                    <div class="contact-info-card">
                        <div class="contact-info-icon">
                            <i class="bi bi-geo-alt contact-icon-svg"></i>
                        </div>
                        <h3>Our Address</h3>
                        <p><?php echo SITE_ADDRESS; ?></p>
                    </div>
                    
                    <div class="contact-info-card">
                        <div class="contact-info-icon">
                            <i class="bi bi-telephone contact-icon-svg"></i>
                        </div>
                        <h3>Phone Numbers</h3>
                        <p>
                            <a href="tel:<?php echo SITE_PHONE1; ?>"><?php echo SITE_PHONE1; ?></a><br>
                            <a href="tel:<?php echo SITE_PHONE2; ?>"><?php echo SITE_PHONE2; ?></a>
                        </p>
                    </div>
                    
                    <div class="contact-info-card">
                        <div class="contact-info-icon">
                            <i class="bi bi-envelope contact-icon-svg"></i>
                        </div>
                        <h3>Email Address</h3>
                        <p>
                            <a href="mailto:<?php echo SITE_EMAIL; ?>"><?php echo SITE_EMAIL; ?></a>
                        </p>
                    </div>
                    
                    <div class="contact-info-card">
                        <div class="contact-info-icon">
                            <i class="bi bi-clock contact-icon-svg"></i>
                        </div>
                        <h3>Business Hours</h3>
                        <p>
                            Monday - Saturday: 10:00 AM - 7:00 PM<br>
                            Sunday: Closed
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="contact-form-section">
                <h2>Send Us a Message</h2>
                <form id="contactForm" class="contact-form" action="process-contact.php" method="POST">
                    <div class="form-group">
                        <label for="name">Your Name *</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Contact Number *</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject">
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section">
    <div class="container">
        <h2>Find Us Here</h2>
        <div class="map-container">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.3672346544634!2d77.3210624!3d28.6139391!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjjCsDM2JzUwLjIiTiA3N8KwMTknMTUuOCJF!5e0!3m2!1sen!2sin!4v1234567890123" 
                width="100%" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>

