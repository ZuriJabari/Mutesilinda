# cPanel Deployment Guide - dev.mutesilinda.com

## 🚀 Auto-Deploy Setup (GitHub → cPanel)

This guide will set up automatic deployment so every push to GitHub deploys to dev.mutesilinda.com.

## Step 1: cPanel Initial Setup

### 1.1 Subdomain (Already Created ✅)
Your subdomain is already set up:
- Subdomain: `dev.mutesilinda.com`
- Document root: `/public_html/MutesiDev`

### 1.2 Upload Files Manually (First Time)
1. In cPanel, go to **File Manager**
2. Navigate to `/public_html/MutesiDev/`
3. Upload all files from your local project EXCEPT:
   - `node_modules/`
   - `vendor/`
   - `.env`
   - `database/database.sqlite`
   - `.git/`

### 1.3 Create .env File on Server
1. In File Manager, navigate to `/public_html/MutesiDev/`
2. Create new file: `.env`
3. Copy content from `.env.example` and update:

```env
APP_NAME="Mutesilinda Dev"
APP_ENV=production
APP_KEY=base64:YOUR_KEY_HERE
APP_DEBUG=false
APP_URL=https://dev.mutesilinda.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

MAIL_MAILER=smtp
MAIL_HOST=mail.mutesilinda.com
MAIL_PORT=587
MAIL_USERNAME=linda@mutesilinda.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=linda@mutesilinda.com
MAIL_FROM_NAME="Mutesilinda"
```

### 1.4 Update Document Root
1. In cPanel, go to **Domains**
2. Click on `dev.mutesilinda.com`
3. Update Document Root to: `/public_html/MutesiDev/public`
4. Save changes

**Important:** The document root must point to the `/public` folder inside MutesiDev!

### 1.5 Create MySQL Database
1. Go to **MySQL Databases**
2. Create new database: `mutesilinda_dev`
3. Create new user with strong password
4. Add user to database with ALL PRIVILEGES
5. Update `.env` with these credentials

### 1.6 Run Initial Setup via Terminal/SSH
```bash
cd public_html/MutesiDev
composer install --optimize-autoloader --no-dev
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 1.7 Set Permissions
```bash
chmod -R 755 storage bootstrap/cache
```

### 1.8 Create Admin User
```bash
php artisan make:filament-user
```

## Step 2: GitHub Secrets Setup

### 2.1 Get FTP Credentials
1. In cPanel, go to **FTP Accounts**
2. Note your FTP server (usually: ftp.mutesilinda.com)
3. Note your FTP username
4. Note your FTP password

### 2.2 Get SSH Credentials
1. SSH Host: Usually same as FTP server or your domain
2. SSH Username: Your cPanel username
3. SSH Password: Your cPanel password
4. SSH Port: Usually 22 (check with host)

### 2.3 Add Secrets to GitHub
1. Go to your GitHub repository: https://github.com/ZuriJabari/Mutesilinda
2. Click **Settings** → **Secrets and variables** → **Actions**
3. Click **New repository secret**
4. Add these secrets:

**Required Secrets:**
- `FTP_SERVER`: ftp.mutesilinda.com
- `FTP_USERNAME`: your_ftp_username
- `FTP_PASSWORD`: your_ftp_password
- `SSH_HOST`: mutesilinda.com (or your server IP)
- `SSH_USERNAME`: your_cpanel_username
- `SSH_PASSWORD`: your_cpanel_password
- `SSH_PORT`: 22 (or your SSH port)

## Step 3: Test Auto-Deploy

### 3.1 Make a Test Change
```bash
cd /Users/zuri/Desktop/LindaDaily-Laravel

# Make a small change
echo "# Test deployment" >> README.md

# Commit and push
git add README.md
git commit -m "Test auto-deployment"
git push origin main
```

### 3.2 Monitor Deployment
1. Go to GitHub repository
2. Click **Actions** tab
3. Watch the deployment progress
4. Should complete in 2-5 minutes

### 3.3 Verify Live Site
1. Visit: https://dev.mutesilinda.com
2. Check homepage loads
3. Login to admin: https://dev.mutesilinda.com/admin

## Step 4: .htaccess Configuration

Create/update `/public_html/dev/public/.htaccess`:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

## Step 5: SSL Certificate

### 5.1 Enable SSL
1. In cPanel, go to **SSL/TLS Status**
2. Find `dev.mutesilinda.com`
3. Click **Run AutoSSL**
4. Wait for certificate to be issued

### 5.2 Force HTTPS
Add to `.env`:
```env
FORCE_HTTPS=true
```

## Troubleshooting

### Issue: 500 Internal Server Error
**Solution:**
```bash
cd public_html/dev
chmod -R 755 storage bootstrap/cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Issue: Database Connection Failed
**Solution:**
1. Check `.env` database credentials
2. Verify database exists in cPanel
3. Verify user has privileges
4. Try connecting via phpMyAdmin

### Issue: Styles Not Loading
**Solution:**
```bash
cd public_html/dev
php artisan storage:link
npm run build
```

### Issue: GitHub Action Fails
**Solution:**
1. Check GitHub Secrets are correct
2. Verify FTP/SSH credentials
3. Check deployment logs in Actions tab
4. Ensure server allows FTP/SSH connections

### Issue: Composer Install Fails
**Solution:**
1. SSH into server
2. Run manually:
```bash
cd public_html/dev
composer install --no-dev --optimize-autoloader
```

## Deployment Workflow

Once set up, your workflow is:

```bash
# 1. Make changes locally
# Edit files in /Users/zuri/Desktop/LindaDaily-Laravel

# 2. Test locally
php artisan serve
# Visit http://localhost:8000

# 3. Commit and push
git add .
git commit -m "Your changes"
git push origin main

# 4. GitHub automatically deploys to dev.mutesilinda.com
# Wait 2-5 minutes, then check https://dev.mutesilinda.com
```

## Manual Deployment (Backup Method)

If GitHub Actions fails, deploy manually:

### Via FTP
1. Use FileZilla or cPanel File Manager
2. Upload changed files to `/public_html/dev/`
3. SSH in and run:
```bash
cd public_html/dev
composer install --no-dev
php artisan migrate --force
php artisan cache:clear
```

### Via Git (If Available)
```bash
cd public_html/dev
git pull origin main
composer install --no-dev
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Performance Optimization

### Enable OPcache
In cPanel → **Select PHP Version** → **Options**:
- Enable `opcache`

### Optimize Composer
```bash
composer install --optimize-autoloader --no-dev --classmap-authoritative
```

### Cache Everything
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

## Monitoring

### Check Logs
```bash
tail -f storage/logs/laravel.log
```

### Check Error Logs
In cPanel → **Errors** → View error_log

## Security Checklist

- [ ] `.env` file is NOT in Git
- [ ] `APP_DEBUG=false` in production
- [ ] SSL certificate installed
- [ ] Strong database password
- [ ] Strong admin password
- [ ] File permissions correct (755/644)
- [ ] `storage/` and `bootstrap/cache/` writable

## Support

**Need help?**
- Check Laravel logs: `storage/logs/laravel.log`
- Check cPanel error logs
- Contact your hosting support
- Review GitHub Actions logs

---

**Once configured, every push to GitHub will automatically deploy to dev.mutesilinda.com!** 🚀
