# Bohol Island Tours

A comprehensive tour booking and management system for Bohol Island Tours, built with PHP (CodeIgniter framework). This website offers tour packages, destination information, car/van rentals, and booking services for exploring Bohol, Philippines.

## Features

- **Tour Package Management**: Multiple tour packages (2-5 days) with detailed itineraries
- **Destination Information**: Comprehensive guide to Bohol's top tourist destinations
- **Booking System**: Full booking lifecycle management for tours and accommodations
- **Room Management**: Manage room inventory and availability (if applicable)
- **Customer Dashboard**: Customer account and booking history
- **Admin Panel**: Comprehensive admin control panel with granular permissions
- **Car/Van Rental**: Vehicle rental services with pricing information
- **Payment Integration**: Booking confirmation and checkout system
- **API Endpoints**: RESTful API for integrations
- **Mobile Responsive**: Fully responsive design optimized for all devices
- **SEO Optimized**: Complete SEO implementation with structured data, meta tags, and sitemap
- **Progressive Web App**: PWA support with service workers

## Project Structure

```
├── admin/                    # Admin panel and API endpoints
│   ├── application/         # CodeIgniter application folder
│   ├── system/              # CodeIgniter system files
│   ├── sql/                 # Database migration scripts
│   └── img/                 # Admin assets
├── docs/                    # Documentation
├── system/                  # CodeIgniter system directory
├── img/                     # Image assets (logo, room images, etc.)
├── video/                   # Video assets
├── index.php                # Main homepage
├── package1.php             # 2 Days 1 Night Tour Package
├── package2.php             # 3 Days 2 Nights Tour Package
├── package3.php             # 4 Days 3 Nights Tour Package
├── package4.php             # 5 Days 4 Nights Tour Package
├── destinations.php         # Tourist destinations guide
├── rental.php               # Car/Van rental page
├── about-bohol.php          # About Bohol information
├── contact.php              # Contact page
├── rooms.php                # Room listing page (if applicable)
├── booking-api.js           # Booking API client
├── style.css                # Main stylesheet
├── script.js                # JavaScript functionality
├── sitemap.xml              # SEO sitemap
├── robots.txt               # SEO robots file
└── manifest.json            # PWA manifest
```

## Pages

### Main Pages
- **Home** (`index.php`) - Hero slider, tour packages overview, destinations preview
- **Tour Packages** - Individual pages for each package duration
- **Destinations** (`destinations.php`) - Complete guide to Bohol destinations
- **About Bohol** (`about-bohol.php`) - Information about Bohol Island
- **Car/Van Rental** (`rental.php`) - Vehicle rental services and rates
- **Contact** (`contact.php`) - Contact form and location

### Tour Package Pages
- `package1.php` - 2 Days 1 Night Bohol Tour Package
- `package2.php` - 3 Days 2 Nights Bohol Tour Package
- `package3.php` - 4 Days 3 Nights Bohol Tour Package
- `package4.php` - 5 Days 4 Nights Bohol Tour Package

## Requirements

- PHP 5.6+
- MySQL 5.7+
- Apache/Nginx with mod_rewrite
- Composer (for PHP dependencies)

## Installation

1. **Download/Extract the project**
   ```bash
   cd boholislandtours
   ```

2. **Install dependencies** (if any)
   ```bash
   composer install
   ```

3. **Database Setup**
   - Create a new MySQL database
   - Import the database schema from `admin/sql/database_schema_extended.sql` (if applicable)
   - Run additional migration scripts as needed from `admin/sql/`

4. **Configuration**
   - Update database credentials in `admin/application/config/database.php`
   - Configure base URL and other settings in CodeIgniter config files
   - Set up proper file permissions for uploads and cache directories

5. **Access the Application**
   - Customer website: `http://localhost/boholislandtours/`
   - Admin panel: `http://localhost/boholislandtours/admin/`

## SEO Features

- **Structured Data**: JSON-LD schema markup for tours, destinations, and organization
- **Meta Tags**: Comprehensive meta tags for all pages
- **Open Graph**: Social media sharing optimization
- **Twitter Cards**: Twitter sharing optimization
- **Sitemap**: XML sitemap for search engines
- **Robots.txt**: Search engine crawler directives
- **Mobile Optimization**: Fully responsive design with mobile-first approach

## API Documentation

See `admin/API_ENDPOINTS_SUMMARY.md` for complete API endpoint documentation (if available).

## Documentation

- [Setup Guide](docs/SETUP_GUIDE.md)
- [Booking System README](docs/BOOKING_SYSTEM_README.md)
- [Admin Panel Complete Guide](docs/ADMIN_PANEL_COMPLETE.md)
- [Granular Permissions](docs/GRANULAR_PERMISSIONS_README.md)
- [Module Generator Guide](docs/MODULE_GENERATOR_GUIDE.md)

## Troubleshooting

For troubleshooting and common issues, see:
- [Troubleshooting Guide](docs/TROUBLESHOOTING_DASHBOARD.md)
- [Production Troubleshooting](admin/PRODUCTION_TROUBLESHOOTING.md) (if available)

## Contact Information

**Bohol Island Tours**
- Tourism Center, Tagbilaran City, Bohol 6300
- Phone: +63 912 529 8818 (Smart), +63 919 080 5294 (Smart), +63 917 950 7562 (Globe)
- Email: boholislandtours@gmail.com

## License

This project is proprietary. All rights reserved.

## Support

For support and inquiries, please contact Bohol Island Tours.
