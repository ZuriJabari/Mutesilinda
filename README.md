# Mutesilinda - Professional Blog & Portfolio

Professional blog and portfolio website for Linda Mutesi, built with Laravel 12, Livewire 3, and Filament 3.

## 🚀 Tech Stack

- **Laravel 12** - PHP Framework
- **Livewire 3** - Full-stack framework for Laravel
- **Filament 3** - Admin panel for content management
- **Tailwind CSS** - Utility-first CSS framework
- **Alpine.js** - Lightweight JavaScript framework
- **MySQL/SQLite** - Database

## ✨ Features

- **Blog Management** - Full-featured blog with Filament admin panel
- **Static Pages** - Manage About, Research Interests, and other pages
- **Responsive Design** - Mobile-first, pixel-perfect design
- **SEO Optimized** - Meta tags, slugs, and structured data
- **Contact Form** - Email integration for inquiries
- **Social Media** - LinkedIn and Medium integration
- **Affiliations** - Showcase of partner organizations

## 📋 Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL (or SQLite for development)

## 🛠️ Installation

### 1. Clone the repository

```bash
git clone https://github.com/ZuriJabari/Mutesilinda.git
cd Mutesilinda
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install NPM dependencies

```bash
npm install
```

### 4. Environment setup

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure database

For MySQL, update `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mutesilinda
DB_USERNAME=root
DB_PASSWORD=
```

For SQLite (development):
```env
DB_CONNECTION=sqlite
```

### 6. Run migrations

```bash
php artisan migrate
```

### 7. Create admin user

```bash
php artisan make:filament-user
```

Follow the prompts to create your admin account.

### 8. Build assets

```bash
npm run build
```

For development with hot reload:
```bash
npm run dev
```

### 9. Start the server

```bash
php artisan serve
```

Visit: `http://localhost:8000`

## 🎨 Admin Panel

Access the Filament admin panel at: `http://localhost:8000/admin`

### Managing Content

- **Blog Posts** - Create, edit, and publish blog articles
- **Pages** - Manage static pages (About, Research Interests, etc.)
- **SEO** - Set meta titles and descriptions for each post/page

## 📁 Project Structure

```
app/
├── Livewire/           # Livewire components
├── Models/             # Eloquent models
└── Filament/           # Filament resources

resources/
├── views/
│   ├── layouts/        # Layout templates
│   ├── livewire/       # Livewire views
│   └── components/     # Blade components
├── css/                # Stylesheets
└── js/                 # JavaScript files

database/
└── migrations/         # Database migrations

routes/
└── web.php            # Web routes
```

## 🚢 Deployment

### For cPanel Hosting

1. Build production assets:
```bash
npm run build
```

2. Upload files via FTP/Git

3. Set up database and update `.env`

4. Run migrations:
```bash
php artisan migrate --force
```

5. Configure web server to point to `/public`

### For GitHub Pages (Static Export)

This is a dynamic Laravel app and requires a server. For static hosting, consider using Laravel's static site generation or exporting to HTML.

## 📧 Email Configuration

Update `.env` with your email settings:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=linda@mutesilinda.com
MAIL_FROM_NAME="Mutesilinda"
```

## 🔒 Security

- Never commit `.env` file
- Keep dependencies updated
- Use strong passwords for admin accounts
- Enable HTTPS in production

## 📝 License

This project is proprietary and confidential.

## 👩🏾‍💼 About

Built for Linda Mutesi - Lawyer, Philanthropist, and Community Builder.

Website: [mutesilinda.com](https://mutesilinda.com)

---

Made with ❤️ by [Index Digital](https://index.ug)
