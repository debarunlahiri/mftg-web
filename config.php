<?php
// Site Configuration
define('SITE_NAME', 'MFTG Fashion Toys & Gifts');

// Dynamically determine the base URL based on current request
// This ensures CSS, images, and other assets work when accessing via IP address or domain
$server_port = $_SERVER['SERVER_PORT'] ?? null;
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $server_port == 443) ? "https://" : "http://";
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
define('CONTACT_EMAIL', 'mftgindia@gmail.com');
define('CONTACT_CC_EMAIL', 'techproenq@gmail.com, summitcodeworks@gmail.com');
define('SITE_PHONE1', '+91-8368097183');
define('SITE_ADDRESS', 'Akash Nagar, Yusüfpur Chak Saberi, Gautam Buddha Nagar, Uttar Pradesh - 201009, India');
define('SITE_WEBSITE', 'www.mftgindia.com');

if (file_exists(__DIR__ . '/config.local.php')) {
    require_once __DIR__ . '/config.local.php';
}

// Page titles
$page_titles = [
    'home' => 'Home - Women\'s Clothing Manufacturer & Kids Toys Supplier',
    'about' => 'About Us - MFTG Fashion Toys & Gifts',
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
        'description' => 'All Age Groups - Trusted manufacturer of plush toys and gifting items suitable for retail stores, online sellers, corporate gifting companies, schools, and events.'
    ]
];
?>
