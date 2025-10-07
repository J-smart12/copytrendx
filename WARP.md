# WARP.md

This file provides guidance to WARP (warp.dev) when working with code in this repository.

## Project Overview

CopyWavex is a cryptocurrency trading and copy trading platform built with PHP, HTML/CSS/JavaScript. It consists of a public-facing website, user dashboard, admin panel, and REST API server.

## Development Environment Setup

### Local Development (XAMPP)
This project is designed to run in a XAMPP environment on Windows:

```powershell
# Start XAMPP services (Apache and MySQL required)
# Place project in C:\xampp\htdocs\copywavex
```

### Database Configuration
- Local development uses MySQL database named `copywavex`
- Database credentials are configured in multiple places (see Configuration Files section)
- Credentials are gitignored for security

## Architecture Overview

### Core Components

1. **Public Website** (`/` root)
   - Static HTML pages with modern design
   - Landing page, login, register, password recovery
   - Uses Tailwind CSS and Font Awesome
   - jQuery-based form handling with AJAX

2. **API Server** (`/phpapiserver/`)
   - Custom PHP REST API with routing system
   - RESTful endpoints for user management, trading, deposits/withdrawals
   - JWT-based authentication
   - File upload handling
   - Custom router implementation (`router/router.php`)

3. **User Dashboard** (`/dashboard/`)
   - Modern responsive interface built with Tailwind CSS
   - Real-time trading data integration (TradingView widgets)
   - Mobile-first design with bottom navigation
   - Session-based authentication

4. **Admin Panel** (`/admin/`)
   - Bootstrap-based admin interface
   - User management, transaction oversight
   - Revenue analytics and reporting
   - Separate authentication system

### Key Technical Patterns

- **Routing**: Custom PHP router in API server, direct file access elsewhere
- **Authentication**: 
  - API uses token-based auth
  - Dashboard uses PHP sessions
  - Admin panel has separate login system
- **Database**: Direct PDO connections, no ORM
- **Frontend**: Mix of vanilla JS, jQuery, and modern CSS frameworks
- **API Communication**: JSON-based AJAX requests

## Configuration Files

Configuration is spread across multiple files (many gitignored):

- `config/config.php` - Main site configuration (empty template)
- `dashboard/includes/require.php` - Dashboard database config
- `phpapiserver/database/dbconfig.php` - API database config  
- `admin/account/includes/require.php` - Admin database config

## Common Development Commands

### Starting Development Server
```powershell
# Ensure XAMPP Apache and MySQL are running
# Access via http://localhost/copywavex
```

### Database Operations
```powershell
# Access phpMyAdmin at http://localhost/phpmyadmin
# Create database: copywavex
# Import schema if available
```

### Testing API Endpoints
```powershell
# API base URL: http://localhost/copywavex/phpapiserver
# Example: POST /user/login
curl -X POST http://localhost/copywavex/phpapiserver/user/login -H "Content-Type: application/json" -d '{"email":"test@example.com","password":"password"}'
```

## File Structure Guidelines

### Frontend Assets
- `/assets/` - Bootstrap, jQuery, custom CSS/JS for public site
- `/dashboard/` - Tailwind-based user interface
- `/admin/` - Bootstrap-based admin interface

### PHP Backend
- `/phpapiserver/` - API server with MVC-like structure
  - `/router/` - Custom routing system
  - `/controller/` - Business logic
  - `/model/` - Database models
  - `/users/routes/` - User-related API endpoints
- `/dashboard/includes/` - Dashboard backend utilities
- `/admin/account/includes/` - Admin backend utilities

### Configuration Security
- Database credentials are gitignored
- SMTP settings stored in config files
- Local development uses localhost with no password for MySQL root

## Development Workflow

### Making Changes to API
1. Edit routes in `/phpapiserver/users/routes/`
2. Implement controller logic in `/phpapiserver/controller/`
3. Test endpoints via AJAX calls or curl

### Frontend Updates
1. **Public site**: Edit HTML files directly, assets in `/assets/`
2. **Dashboard**: Modern components in `/dashboard/`, uses Tailwind
3. **Admin**: Bootstrap components in `/admin/`, traditional PHP includes

### Database Schema Changes
1. Update schema manually via phpMyAdmin
2. Update relevant model files in `/phpapiserver/model/`
3. Test affected API endpoints

## Important Implementation Notes

- **No build process**: Direct file editing, no webpack/npm builds required
- **Mixed architectures**: Public site uses traditional PHP includes, API uses modern routing
- **Mobile-responsive**: Dashboard designed mobile-first with responsive breakpoints  
- **Real-time data**: Integrates TradingView widgets for live crypto prices
- **File uploads**: API handles image uploads for KYC and support tickets
- **Email system**: SMTP configuration required for notifications

## Common Issues and Solutions

### PHP 8+ Compatibility
- **count() function errors**: PHP 8+ is stricter about the `count()` function requiring arrays. Always check `is_array()` before using `count()`
- **Type checking**: Add proper type validation for function parameters and return values
- **Database result handling**: Always verify array structure before accessing nested keys

### Database Connection Issues
- Ensure XAMPP MySQL service is running
- Check database credentials in configuration files
- Verify database name `copywavex` exists in phpMyAdmin

### Session Management
- Dashboard requires active PHP sessions
- Logout redirects may fail if session variables are not properly cleared
- API authentication uses separate token-based system

## Security Considerations

- Configuration files with credentials are gitignored
- User input sanitization implemented in forms
- SQL injection prevention via PDO prepared statements
- Session management for authenticated areas
- File upload validation and restrictions

## Browser Compatibility

- Modern browsers supported (ES6+ JavaScript)
- Mobile-responsive design
- Font Awesome 6+ icons
- Bootstrap 4+ components (admin)
- Tailwind CSS (dashboard)
