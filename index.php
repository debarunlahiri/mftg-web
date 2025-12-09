<?php
require_once 'config.php';
$page_title = $page_titles['home'];
require_once 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-carousel">
        <div class="hero-slide active" 
             style="background-image: url('<?php echo SITE_URL; ?>/assets/carousel/1.jpg');"
             data-title="Welcome to MFTG"
             data-subtitle="Trusted Women's Clothing Manufacturer & Kids Toys Supplier"
             data-description="Government-registered manufacturer specializing in premium ready-to-wear women's clothing for global private-label brands. We also supply a wide range of kids toys and gift items. Quality, affordability, and timely delivery guaranteed.">
            <div class="hero-overlay"></div>
        </div>
        <div class="hero-slide" 
             style="background-image: url('<?php echo SITE_URL; ?>/assets/carousel/2.jpg');"
             data-title="Premium Women's Clothing"
             data-subtitle="Ready-to-Wear & Private Label Manufacturing"
             data-description="Manufacturing premium women's clothing for global private-label brands. With advanced machinery, skilled craftsmen, and strict quality standards, we deliver top-tier garments that meet international fashion expectations.">
            <div class="hero-overlay"></div>
        </div>
        <div class="hero-slide" 
             style="background-image: url('<?php echo SITE_URL; ?>/assets/carousel/3.jpg');"
             data-title="Complete Range of Apparel"
             data-subtitle="Kurtis, Western Wear, Co-ord Sets & More"
             data-description="Offering a complete range of ready-to-wear categories including kurtis, tunics, tops, co-ord sets, western wear, leggings, and casual wear. High-capacity production with fast turnaround and zero-delay bulk manufacturing.">
            <div class="hero-overlay"></div>
        </div>
        <div class="hero-slide" 
             style="background-image: url('<?php echo SITE_URL; ?>/assets/carousel/4.jpg');"
             data-title="Kids Toys & Gift Items"
             data-subtitle="All Age Groups - Educational, Fun & Safe"
             data-description="Trusted supplier of kids toys and gifting items for retail stores, online sellers, corporate gifting companies, schools, and events. From educational toys to soft toys, creative kits, and festival hampers.">
            <div class="hero-overlay"></div>
        </div>
    </div>
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Welcome to MFTG</h1>
            <p class="hero-subtitle">Trusted Women's Clothing Manufacturer & Kids Toys Supplier</p>
            <p class="hero-description">
                Government-registered manufacturer specializing in premium ready-to-wear women's clothing for global private-label brands. 
                We also supply a wide range of kids toys and gift items. Quality, affordability, and timely delivery guaranteed.
            </p>
            <div class="hero-buttons">
                <a href="<?php echo SITE_URL; ?>/services.php" class="btn btn-primary">Our Services</a>
                <a href="<?php echo SITE_URL; ?>/enquiry.php" class="btn btn-secondary">Get a Quote</a>
            </div>
        </div>
    </div>
    <div class="hero-carousel-indicators">
        <span class="indicator active" data-slide="0"></span>
        <span class="indicator" data-slide="1"></span>
        <span class="indicator" data-slide="2"></span>
        <span class="indicator" data-slide="3"></span>
    </div>
</section>

<!-- About Section -->
<section class="about-section">
    <div class="container">
        <div class="section-header">
            <h2>About MFTG</h2>
            <div class="section-divider"></div>
        </div>
        <div class="about-content">
            <div class="about-text">
                <p>
                    MFTG is one of the trusted names among women's clothing manufacturers in India. We specialize in producing 
                    premium-quality, ready-to-wear women's clothing and export across the globe, serving numerous clients simultaneously.
                </p>
                <p>
                    We are a <strong>government-registered clothing manufacturer</strong>, ensuring affordable pricing without compromising on quality. 
                    Our expertise in serving private label brands has earned us immense appreciation for delivering exceptional craftsmanship. 
                    Supported by top-grade machinery and a skilled workforce, we eliminate production delays and efficiently serve multiple clients at once.
                </p>
                <p>
                    In addition to clothing manufacturing, MFTG provides a wide variety of kids toys and gift items suitable for all age groups, 
                    retail stores, online sellers, corporate gifting companies, schools, and events.
                </p>
                <a href="<?php echo SITE_URL; ?>/about.php" class="btn btn-primary">Learn More</a>
            </div>
            <div class="about-features">
                <div class="feature-card">
                    <div class="feature-icon">✓</div>
                    <h3>Government-Registered</h3>
                    <p>Trusted and registered manufacturer ensuring compliance and quality</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">✓</div>
                    <h3>Global Private Label Brands</h3>
                    <p>Trusted by worldwide brands for exceptional craftsmanship</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">✓</div>
                    <h3>Premium Quality Apparel</h3>
                    <p>Ready-to-wear women's clothing meeting international standards</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">✓</div>
                    <h3>Kids Toys & Gifts</h3>
                    <p>Wide range of educational and fun toys for all ages</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section">
    <div class="container">
        <div class="section-header">
            <h2>Our Services</h2>
            <div class="section-divider"></div>
            <p>Comprehensive women's clothing manufacturing and kids toys solutions</p>
        </div>
        <div class="services-grid-modern">
            <div class="service-card-modern">
                <div class="service-image-wrapper">
                    <img src="<?php echo SITE_URL; ?>/assets/images/services/ladies-kurti-printing.jpg"
                        alt="Women's Clothing Manufacturing"
                        onerror="this.src='<?php echo SITE_URL; ?>/assets/images/placeholder.jpg'; this.onerror=null;">
                    <div class="service-overlay"></div>
                    <div class="service-icon">
                        <i class="bi bi-scissors"></i>
                    </div>
                </div>
                <div class="service-content">
                    <span class="service-badge">Ready-to-Wear & Private Label</span>
                    <h3>Women's Clothing Manufacturing</h3>
                    <p class="service-description">We specialize in manufacturing premium women's clothing for global private-label brands. With advanced machinery, skilled craftsmen, and strict quality standards, we deliver top-tier garments that meet international fashion expectations.</p>
                    <ul class="service-features-list">
                        <li><i class="bi bi-check-circle-fill"></i> Design Development & Fabric Sourcing</li>
                        <li><i class="bi bi-check-circle-fill"></i> Tailored Production for Private Labels</li>
                        <li><i class="bi bi-check-circle-fill"></i> Complete Range of Ready-to-Wear Categories</li>
                        <li><i class="bi bi-check-circle-fill"></i> High-Capacity Production with Fast Turnaround</li>
                        <li><i class="bi bi-check-circle-fill"></i> Strict Quality Assurance</li>
                    </ul>
                </div>
            </div>
            <div class="service-card-modern">
                <div class="service-image-wrapper">
                    <img src="<?php echo SITE_URL; ?>/assets/images/services/kids-toys.jpg"
                        alt="Kids Toys & Gift Items"
                        onerror="this.src='<?php echo SITE_URL; ?>/assets/images/placeholder.jpg'; this.onerror=null;">
                    <div class="service-overlay"></div>
                    <div class="service-icon">
                        <i class="bi bi-gift"></i>
                    </div>
                </div>
                <div class="service-content">
                    <span class="service-badge">All Age Groups</span>
                    <h3>Kids Toys & Gift Items</h3>
                    <p class="service-description">Trusted supplier of kids toys and gifting items suitable for retail stores, online sellers, corporate gifting companies, schools, and events.</p>
                    <ul class="service-features-list">
                        <li><i class="bi bi-check-circle-fill"></i> Educational Toys</li>
                        <li><i class="bi bi-check-circle-fill"></i> Soft Toys & Plush Items</li>
                        <li><i class="bi bi-check-circle-fill"></i> Creative & DIY Kits</li>
                        <li><i class="bi bi-check-circle-fill"></i> Battery-Operated Toys</li>
                        <li><i class="bi bi-check-circle-fill"></i> Outdoor & Sports Toys</li>
                        <li><i class="bi bi-check-circle-fill"></i> Return Gift & Festival Hampers</li>
                        <li><i class="bi bi-check-circle-fill"></i> Custom Gifting Solutions</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="services-cta">
            <a href="<?php echo SITE_URL; ?>/services.php" class="btn btn-primary">View All Services</a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section" style="background-image: url('<?php echo SITE_URL; ?>/assets/images/services/small-contact.jpg');">
    <div class="cta-background-overlay"></div>
    <div class="container">
        <div class="cta-content">
            <h2>Interested in Our Services?</h2>
            <p>Get in touch with us today for clothing manufacturing or kids toys supply. Quality, affordability, and timely delivery guaranteed.</p>
            <form id="ctaContactForm" class="cta-contact-form" action="process-contact.php" method="POST">
                <div class="cta-form-row">
                    <div class="form-group">
                        <label for="cta-name">Your Name *</label>
                        <input type="text" id="cta-name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="cta-email">Email Address *</label>
                        <input type="email" id="cta-email" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cta-phone">Phone Number *</label>
                    <input type="tel" id="cta-phone" name="phone" required placeholder="+91 9999999999" pattern="[+]?[0-9\s\-\(\)]+" maxlength="20">
                </div>
                <div class="form-group">
                    <label for="cta-message">Message *</label>
                    <textarea id="cta-message" name="message" rows="4" required placeholder="Tell us about your requirements..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Send Message</button>
            </form>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>