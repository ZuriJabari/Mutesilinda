# Deployment Guide - Mutesilinda

## Quick Start (Local Development)

```bash
# 1. Install dependencies
composer install
npm install

# 2. Setup environment
cp .env.example .env
php artisan key:generate

# 3. Configure database (SQLite for dev)
touch database/database.sqlite

# 4. Run migrations
php artisan migrate

# 5. Create admin user
php artisan make:filament-user

# 6. Build assets
npm run build

# 7. Start server
php artisan serve
```

Visit: http://localhost:8000
Admin: http://localhost:8000/admin

## Production Deployment (cPanel)

### 1. Prepare Files

```bash
# Build production assets
npm run build

# Optimize for production
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 2. Upload to cPanel

Upload all files EXCEPT:
- `node_modules/`
- `.env` (create new on server)
- `database/database.sqlite`

### 3. Configure on Server

**Create `.env` file:**
```env
APP_NAME="Mutesilinda"
APP_ENV=production
APP_KEY=base64:YOUR_KEY_HERE
APP_DEBUG=false
APP_URL=https://mutesilinda.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=mail.mutesilinda.com
MAIL_PORT=587
MAIL_USERNAME=linda@mutesilinda.com
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=linda@mutesilinda.com
MAIL_FROM_NAME="Mutesilinda"
```

**Set document root to `/public`**

### 4. Run Migrations

```bash
php artisan migrate --force
```

### 5. Create Admin User

```bash
php artisan make:filament-user
```

### 6. Set Permissions

```bash
chmod -R 755 storage bootstrap/cache
```

## GitHub Pages (Not Recommended)

This is a dynamic Laravel application that requires a PHP server. GitHub Pages only supports static HTML.

**Alternatives:**
- Use Laravel Forge
- Deploy to Vercel/Netlify with serverless functions
- Use traditional hosting (cPanel, VPS)

## Environment Variables

### Required
- `APP_KEY` - Generate with `php artisan key:generate`
- `DB_*` - Database credentials
- `MAIL_*` - Email configuration

### Optional
- `APP_DEBUG=false` - Disable in production
- `APP_URL` - Your domain

## Post-Deployment Checklist

- [ ] Test homepage loads
- [ ] Test admin panel login
- [ ] Create test blog post
- [ ] Test contact form
- [ ] Verify email sending
- [ ] Check all navigation links
- [ ] Test on mobile devices
- [ ] Enable HTTPS
- [ ] Set up backups
- [ ] Configure cron jobs (if needed)

## Troubleshooting

### 500 Error
- Check file permissions (755 for folders, 644 for files)
- Verify `.env` file exists and is configured
- Check error logs in `storage/logs/`

### Admin Panel Not Loading
- Clear cache: `php artisan cache:clear`
- Regenerate config: `php artisan config:cache`

### Styles Not Loading
- Rebuild assets: `npm run build`
- Check public/build folder exists

### Database Connection Failed
- Verify database credentials in `.env`
- Ensure database exists
- Check database user permissions

## Maintenance

### Update Content
1. Login to admin panel
2. Navigate to Blog Posts or Pages
3. Create/Edit content
4. Publish when ready

### Backup Database
```bash
php artisan db:backup
```

### Update Application
```bash
git pull origin main
composer install
npm install && npm run build
php artisan migrate
php artisan cache:clear
```

## Support

For issues or questions:
- Email: linda@mutesilinda.com
- GitHub: https://github.com/ZuriJabari/Mutesilinda

---

Made with ❤️ by Index Digital
