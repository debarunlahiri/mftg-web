# MFTG Website

Official website for MFTG - a Noida-based company specializing in Women's Clothing Manufacturing (Ready-to-Wear & Private Label) and Kids Toys & Gift Items.

## Screenshots

![MFTG Website Screenshot 1](assets/screenshots/image.png)

![MFTG Website Screenshot 2](assets/screenshots/image2.png)

![MFTG Website Screenshot 3](assets/screenshots/image3.png)

## Project Overview

This is a responsive PHP-based website built with Bootstrap and custom CSS. The website showcases MFTG's services, company information, and provides contact forms for client inquiries.

## Features

- Responsive design for desktop, tablet, and mobile devices
- Hero carousel with dynamic content and auto-advance functionality
- Service pages for Women's Clothing Manufacturing and Kids Toys & Gift Items
- About Us page with company information
- Contact form with client-side validation
- CTA section with integrated contact form
- Dynamic URL generation for asset loading

## Technology Stack

- **Backend**: PHP
- **Frontend**: HTML5, CSS3, JavaScript
- **Framework**: Bootstrap 5
- **Server**: XAMPP (Apache/MySQL)

## Project Structure

```
mftg-web/
├── assets/
│   ├── carousel/          # Hero carousel images
│   └── images/
│       └── services/      # Service-related images
├── css/
│   └── style.css         # Main stylesheet
├── includes/
│   ├── header.php        # Site header and navigation
│   └── footer.php        # Site footer
├── js/
│   └── main.js           # JavaScript functionality
├── config.php            # Site configuration and constants
├── index.php             # Homepage
├── about.php             # About Us page
├── services.php          # Services page
├── contact.php           # Contact page
└── .gitignore           # Git ignore rules
```

## Installation

1. Clone or download this repository
2. Place the project in your XAMPP `htdocs` directory:
   ```
   /Applications/XAMPP/xamppfiles/htdocs/mftg-web/
   ```
3. Ensure XAMPP is running (Apache server)
4. Access the website via:
   ```
   http://localhost/mftg-web/
   ```
   Or via IP address:
   ```
   http://YOUR_IP_ADDRESS/mftg-web/
   ```

## Configuration

Site-wide configuration is managed in `config.php`. Key constants include:

- `SITE_NAME`: Company name (currently "MFTG")
- `SITE_URL`: Automatically detected base URL
- `SITE_EMAIL`: Contact email address
- `SITE_PHONE1` & `SITE_PHONE2`: Contact phone numbers
- `SITE_ADDRESS`: Company address
- `SITE_WEBSITE`: Website URL

The `SITE_URL` is dynamically generated based on the current request, ensuring assets load correctly whether accessed via localhost or IP address.

## Pages

### Homepage (`index.php`)
- Hero carousel with 4 slides
- Company overview section
- Services preview section
- CTA contact form

### About Us (`about.php`)
- Company profile and mission/vision
- Why Choose MFTG section
- Expertise areas
- Product categories
- Quality assurance information
- Sidebar with quick facts and contact info

### Services (`services.php`)
- Detailed Women's Clothing Manufacturing services
- Kids Toys & Gift Items information
- Product categories and features
- Custom solutions information

### Contact (`contact.php`)
- Contact information
- Contact form for inquiries

## JavaScript Features

- **Hero Carousel**: Auto-advancing slideshow with 7-second intervals, fade transitions, and hover pause
- **Form Validation**: Client-side validation for contact forms including:
  - Required field checking
  - Email format validation
  - Phone number validation (supports country codes, 10-15 digits)
  - Real-time error feedback with icons and animations
- **Smooth Scrolling**: Enhanced navigation experience

## CSS Features

- Responsive breakpoints for mobile (480px), tablet (768px), and desktop
- Custom gradient overlays matching carousel design
- Modern card-based layouts
- Hover effects and transitions
- Form styling with validation feedback

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Contact Information

- **Email**: mftgindia@gmail.com
- **Phone 1**: +91-9999992271
- **Phone 2**: +91-8130754544
- **Address**: Block C, Shop No. 410, 1st Floor, Sector – 10, Noida, U.P (INDIA)
- **Website**: www.mftgindia.com

## Notes

- The website uses PHP constants for easy content updates
- Images should be placed in the respective asset directories
- Carousel images are expected in `/assets/carousel/` (1.jpg, 2.jpg, 3.jpg, 4.jpg)
- Form submissions require backend processing (process-contact.php)

## License

Proprietary - All rights reserved by MFTG

