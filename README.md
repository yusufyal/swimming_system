# Swimming Academy Management System

A comprehensive management system for swimming academies built with Laravel 10 and Vite.

## Features

- 👥 User Management with Role-based Access Control
- 🏊‍♂️ Student Registration and Management
- 👨‍🏫 Instructor Management
- 📚 Class Scheduling and Management
- 💰 Payment Tracking
- 📊 Attendance Management
- 📋 Level Management
- 📦 Package Management
- 📱 QR Code Based Attendance System
- 🎓 Student Progress Tracking
- 📊 Comprehensive Reporting System

## Prerequisites

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL/MariaDB
- XAMPP/WAMP/MAMP (for local development)

## Installation

1. Clone the repository
```bash
git clone https://github.com/yusufyal/swimming_system.git
cd swimming_system
```

2. Install PHP dependencies
```bash
composer install
```

3. Install NPM dependencies
```bash
npm install
```

4. Create and configure .env file
```bash
cp .env.example .env
```
Update database credentials in .env file

5. Generate application key
```bash
php artisan key:generate
```

6. Run database migrations and seeders
```bash
php artisan migrate:fresh --seed
```

7. Start the development server
```bash
php artisan serve
```

8. In a separate terminal, start Vite development server
```bash
npm run dev
```

## Default Access

Super Admin Login:
- Email: superadmin@example.com
- Password: password

## Running the Application

The application will be accessible at:
- Laravel Backend: http://127.0.0.1:8000
- Vite Dev Server: http://localhost:5175

## License

[MIT License](LICENSE.md)

## Support

For support, please contact [your contact information]
