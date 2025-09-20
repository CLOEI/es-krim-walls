# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview
This is an inventory management system for ice cream ("es krim") outlets, built using Laravel 11 with PHP 8.2+. The system manages products, stock levels, pricing, and tracks product movements (in/out) across different stalls/outlets.

## Core Architecture

### Domain Models
- **Product**: Core inventory items with barcode, name, and pieces per carton (ppc)
- **Stock**: Inventory levels (carton and piece quantities) linked to products
- **Price**: Purchase and selling prices linked to products
- **Stall**: Individual outlet/store locations
- **ProductIn/ProductOut**: Transaction records for inventory movements
- **User**: System users with role-based access (manager vs regular users)

### Key Relationships
- Products have separate Stock and Price records (1:1 relationships)
- Stock tracking uses both carton and piece quantities
- Product creation involves database transactions across Product, Stock, and Price tables

### Authentication & Authorization
- Uses Laravel Sanctum for authentication
- Role-based middleware: `CheckManagerRole` restricts admin functions
- Installation check middleware: `CheckInstallationStatus` controls registration access

## Common Development Commands

### Laravel/PHP Commands
```bash
# Install dependencies
composer install

# Database operations
php artisan migrate
php artisan migrate:fresh --seed

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Run tests
vendor/bin/phpunit
# or
php artisan test

# Code formatting
vendor/bin/pint
```

### Frontend Commands
```bash
# Install frontend dependencies
npm install

# Development server
npm run dev

# Build for production
npm run build
```

### Development Server
```bash
# Start Laravel development server
php artisan serve
```

## Key File Locations

### Controllers
- `app/Http/Controllers/ProductController.php` - Product CRUD operations
- `app/Http/Controllers/ProductIn/OutController.php` - Inventory movements
- `app/Http/Controllers/*ReportController.php` - Report generation
- `app/Http/Controllers/AuthController.php` - User authentication
- `app/Http/Controllers/AdminController.php` - User management

### Models
- `app/Models/Product.php` - Core product model with stock/price relationships
- `app/Models/Stock.php` - Inventory quantities
- `app/Models/Price.php` - Pricing information
- `app/Models/ProductIn.php` / `ProductOut.php` - Transaction records

### Views
- `resources/views/layout.blade.php` - Main layout template
- `resources/views/dashboard_layout.blade.php` - Dashboard layout
- `resources/views/daftar_*.blade.php` - List/index pages
- `resources/views/cetak/*.blade.php` - Print/report templates

### Routes
- `routes/web.php` - All application routes with auth and role middleware

## Database Schema Notes
- Products use separate related tables for stock and price data
- Stock quantities tracked in both cartons and pieces
- Multiple migrations show evolution of schema (check latest migrations for current structure)
- Foreign key relationships between products, stocks, and prices

## Development Patterns
- Database transactions used for multi-table operations (Product creation/updates)
- Form validation in controllers with redirect patterns
- Blade templating with component reuse
- Role-based route protection using middleware groups

## Testing
- PHPUnit configured in `phpunit.xml`
- Tests located in `tests/` directory
- Use `vendor/bin/phpunit` or `php artisan test` to run tests

## Code Style
- Laravel Pint available for code formatting: `vendor/bin/pint`
- Follow Laravel conventions for naming and structure