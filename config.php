<?php
// Site Configuration
define('SITE_NAME', 'Mundeshwari Fashion Toys & Gifts');

// Dynamically determine the base URL based on current request
// This ensures CSS, images, and other assets work when accessing via IP address or domain
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST']; // This will be the IP address or domain being accessed

// Get the base path from SCRIPT_NAME (e.g., /mftg-web/index.php becomes /mftg-web)
$script_name = $_SERVER['SCRIPT_NAME'];
$base_path = dirname($script_name);
$base_path = str_replace('\\', '/', $base_path);

// Handle root directory case
if ($base_path == '/' || $base_path == '.') {
    // Check if we're in a subdirectory
    if (strpos($script_name, '/mftg-web/') !== false || strpos($script_name, '/mftg-web') === 0) {
        $base_path = '/mftg-web';
    } else {
        $base_path = '';
    }
}

// Remove trailing slash
$base_path = rtrim($base_path, '/');

define('SITE_URL', $protocol . $host . $base_path);

define('SITE_EMAIL', 'mftgindia@gmail.com');
define('SITE_PHONE1', '+91-9999992271');
define('SITE_PHONE2', '+91-8130754544');
define('SITE_ADDRESS', 'Block C, Shop No. 410, 1st Floor, Sector – 10, Noida, U.P (INDIA)');
define('SITE_WEBSITE', 'www.mftgindia.com');

// Page titles
$page_titles = [
    'home' => 'Home - Women\'s Clothing Manufacturer & Kids Toys Supplier',
    'about' => 'About Us - Mundeshwari Fashion Toys & Gifts',
    'services' => 'Our Services - Clothing Manufacturing & Kids Toys',
    'contact' => 'Contact Us - Get in Touch',
    'enquiry' => 'Enquiry - Request a Quote'
];

// Services list
$services_list = [
    [
        'title' => 'Women\'s Clothing Manufacturing',
        'image' => 'ladies-kurti-printing.jpg',
        'description' => 'Ready-to-Wear & Private Label - Premium women\'s clothing manufacturing for global private-label brands with advanced machinery, skilled craftsmen, and strict quality standards.'
    ],
    [
        'title' => 'Kids Toys & Gift Items',
        'image' => 'sports-wear-printing.jpeg',
        'description' => 'All Age Groups - Trusted supplier of kids toys and gifting items suitable for retail stores, online sellers, corporate gifting companies, schools, and events.'
    ]
];
?>

