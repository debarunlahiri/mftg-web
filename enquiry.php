<?php
require_once 'config.php';
$page_title = $page_titles['enquiry'];
require_once 'includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Send Enquiry</h1>
        <p>Request a quote for your printing needs</p>
    </div>
</section>

<!-- Enquiry Content -->
<section class="content-section">
    <div class="container">
        <div class="enquiry-container">
            <div class="enquiry-info">
                <h2>Request a Quote</h2>
                <p>Fill out the form below with your requirements and we'll get back to you with a competitive quote within 24 hours.</p>
                
                <div class="enquiry-benefits">
                    <h3>Why Choose Our Services?</h3>
                    <ul>
                        <li>✓ Competitive and transparent pricing</li>
                        <li>✓ High-quality printing guaranteed</li>
                        <li>✓ Fast turnaround time</li>
                        <li>✓ Expert consultation available</li>
                        <li>✓ Bulk order discounts</li>
                        <li>✓ Free sample available</li>
                    </ul>
                </div>
                
                <div class="enquiry-contact">
                    <h3>Or Contact Us Directly</h3>
                    <p>
                        <strong>Phone:</strong><br>
                        <a href="tel:<?php echo SITE_PHONE1; ?>"><?php echo SITE_PHONE1; ?></a><br>
                        <a href="tel:<?php echo SITE_PHONE2; ?>"><?php echo SITE_PHONE2; ?></a>
                    </p>
                    <p>
                        <strong>Email:</strong><br>
                        <a href="mailto:<?php echo SITE_EMAIL; ?>"><?php echo SITE_EMAIL; ?></a>
                    </p>
                </div>
            </div>
            
            <div class="enquiry-form-section">
                <form id="enquiryForm" class="enquiry-form" action="process-enquiry.php" method="POST">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="contact">Contact No. *</label>
                            <input type="tel" id="contact" name="contact" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address">
                    </div>
                    
                    <div class="form-group">
                        <label for="service">Service Required *</label>
                        <select id="service" name="service" required>
                            <option value="">Select a service</option>
                            <option value="bed_covers">Bed Covers, Pillows & Cushions</option>
                            <option value="ladies_kurti">Ladies Kurti & Other Garments</option>
                            <option value="home_furnishing">Home Furnishing Materials</option>
                            <option value="sports_wear">Track Suits & Sports Wear</option>
                            <option value="tshirts">T-Shirts, Tops & Tie</option>
                            <option value="sequins">Sequins Prints</option>
                            <option value="flags">Flags & Promotion Items</option>
                            <option value="other">Other (Please specify in enquiry)</option>
                        </select>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="quantity">Estimated Quantity</label>
                            <input type="text" id="quantity" name="quantity" placeholder="e.g., 100 pieces">
                        </div>
                        
                        <div class="form-group">
                            <label for="timeline">Required Timeline</label>
                            <input type="text" id="timeline" name="timeline" placeholder="e.g., 2 weeks">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="enquiry">Enquiry Details *</label>
                        <textarea id="enquiry" name="enquiry" rows="6" placeholder="Please provide details about your requirements, design preferences, colors, sizes, etc." required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">Submit Enquiry</button>
                    
                    <p class="form-note">* Required fields. We typically respond within 24 hours.</p>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>

