# Griya Asri Kost Management System

A modern web application for managing boarding house (kost) operations, built with Laravel 12 and Tailwind CSS.

## Project Overview

Griya Asri is a comprehensive kost management system designed for boarding house owners and operators in Surabaya, Indonesia. The system provides an intuitive interface for managing rooms, galleries, and guest information.

## Features

- **Landing Page**: Modern, responsive landing page with image gallery slider
- **Room Management**: Add, edit, and manage room listings with detailed information
- **Gallery Management**: Upload and organize property images
- **Admin Dashboard**: Secure admin panel for content management
- **Dark Mode Support**: Built-in dark mode for better user experience
- **Responsive Design**: Optimized for desktop, tablet, and mobile devices

## Technology Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Database**: SQLite (configurable to MySQL/PostgreSQL)
- **Build Tools**: Vite
- **Authentication**: Laravel Sanctum

## Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js and NPM
- SQLite or MySQL

### Steps

1. Clone the repository:
```bash
git clone https://github.com/abyanrfq/griya-asri.git
cd griya-asri/kosku
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install JavaScript dependencies:
```bash
npm install
```

4. Create environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Run database migrations:
```bash
php artisan migrate
```

7. Seed the database (optional):
```bash
php artisan db:seed
```

8. Build frontend assets:
```bash
npm run build
```

9. Start the development server:
```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Project Structure

```
kosku/
├── app/
│   ├── Http/Controllers/    # Application controllers
│   ├── Models/              # Eloquent models
│   └── Providers/           # Service providers
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
├── public/                 # Public assets
├── resources/
│   ├── css/               # Stylesheets
│   ├── js/                # JavaScript files
│   └── views/             # Blade templates
└── routes/                # Application routes
```

## Configuration

### Database

Edit the `.env` file to configure your database connection:

```env
DB_CONNECTION=sqlite
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=kosku
# DB_USERNAME=root
# DB_PASSWORD=
```

### Application Settings

```env
APP_NAME="Griya Asri"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000
```

## Usage

### Admin Access

1. Navigate to `/login`
2. Use the credentials set during seeding or create an admin user
3. Access the admin dashboard to manage content

### Managing Gallery

1. Login to admin panel
2. Navigate to Gallery section
3. Upload images with titles and descriptions
4. Images will appear on the landing page slider

### Managing Rooms

1. Access the Rooms section in admin panel
2. Add room details including price, facilities, and images
3. Rooms will be displayed on the public listing page

## Development

### Running in Development Mode

```bash
# Terminal 1: Start Laravel development server
php artisan serve

# Terminal 2: Watch and compile assets
npm run dev
```

### Building for Production

```bash
npm run build
php artisan optimize
```

## License

This project is proprietary software. All rights reserved.

## Contact

For inquiries about Griya Asri Kost:

- **Location**: Jl. Rungkut Asri Timur XIII No.90, Rungkut Kidul, Surabaya
- **WhatsApp**: +62 821-4326-9626
- **Mamikos**: [View Listing](https://mamikos.com/room/kost-surabaya-kost-putri-eksklusif-kost-griya-asri-rungkut-surabaya)

## Acknowledgments

Built with Laravel framework and modern web technologies to provide a seamless kost management experience.
