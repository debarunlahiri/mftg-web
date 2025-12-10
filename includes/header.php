<?php
if (!defined('SITE_NAME')) {
    require_once __DIR__ . '/../config.php';
}
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MFTG - Trusted women's clothing manufacturer in India. Government-registered manufacturer specializing in premium ready-to-wear women's clothing for global private-label brands. Also supplies kids toys and gift items.">
    <meta name="keywords" content="digital printing, sublimation printing, poly fabric printing, sportswear printing, Noida, Delhi NCR">
    <title><?php echo isset($page_title) ? $page_title : SITE_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar bg-dark text-white py-2">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="d-flex gap-3 flex-wrap">
                    <a href="tel:<?php echo SITE_PHONE1; ?>" class="text-white text-decoration-none">
                        <i class="bi bi-telephone icon-svg"></i> <?php echo SITE_PHONE1; ?>
                    </a>
                    <a href="tel:<?php echo SITE_PHONE2; ?>" class="text-white text-decoration-none">
                        <i class="bi bi-telephone icon-svg"></i> <?php echo SITE_PHONE2; ?>
                    </a>
                    <a href="mailto:<?php echo SITE_EMAIL; ?>" class="text-white text-decoration-none">
                        <i class="bi bi-envelope icon-svg"></i> <?php echo SITE_EMAIL; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top main-header">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-3" href="<?php echo SITE_URL; ?>/index.php">
                <img src="<?php echo SITE_URL; ?>/assets/images/logo.jpeg" alt="<?php echo SITE_NAME; ?>" class="logo-image">
                <div class="logo-text">
                    <h1 class="mb-0">
                        <span class="company-name-desktop"><?php echo SITE_NAME; ?></span>
                        <span class="company-name-mobile">MFTG</span>
                    </h1>
                    <p class="tagline mb-0">Mundeshwari Fashion Toys & Gifts</p>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page == 'index' ? 'active' : ''; ?>" href="<?php echo SITE_URL; ?>/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page == 'about' ? 'active' : ''; ?>" href="<?php echo SITE_URL; ?>/about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page == 'services' ? 'active' : ''; ?>" href="<?php echo SITE_URL; ?>/services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page == 'contact' ? 'active' : ''; ?>" href="<?php echo SITE_URL; ?>/contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white ms-2" href="<?php echo SITE_URL; ?>/enquiry.php">Enquiry</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

