# SSH Deployment Steps - dev.mutesilinda.com

## 🔐 Step 1: Connect via SSH

Open your terminal and connect to your server:

```bash
ssh your_cpanel_username@mutesilinda.com
# Or if you have a specific SSH host:
ssh your_cpanel_username@your_server_ip
```

**Enter your cPanel password when prompted.**

If you don't know your SSH details:
- Check cPanel → **SSH Access**
- Or contact your hosting provider

---

## 📥 Step 2: Navigate to Your Directory

```bash
cd public_html/MutesiDev
```

---

## 🔄 Step 3: Clone from GitHub

```bash
# Clone the repository
git clone https://github.com/ZuriJabari/Mutesilinda.git .

# Note: The dot (.) at the end means "clone into current directory"
```

If you get an error about directory not being empty:
```bash
# Remove any existing files first
rm -rf *
rm -rf .*
# Then clone again
git clone https://github.com/ZuriJabari/Mutesilinda.git .
```

---

## 📦 Step 4: Install PHP Dependencies

```bash
composer install --no-dev --optimize-autoloader
```

If `composer` command not found, try:
```bash
php composer.phar install --no-dev --optimize-autoloader
```

Or use the full path (check with your host):
```bash
/usr/local/bin/composer install --no-dev --optimize-autoloader
```

---

## 🔑 Step 5: Create .env File

```bash
# Copy the example file
cp .env.example .env

# Edit the .env file
nano .env
```

**Update these values in the editor:**

```env
APP_NAME="Mutesilinda Dev"
APP_ENV=production
APP_KEY=
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

**To save in nano:**
- Press `Ctrl + X`
- Press `Y` to confirm
- Press `Enter` to save

---

## 🔧 Step 6: Run Laravel Setup Commands

```bash
# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate --force

# Create symbolic link for storage
php artisan storage:link

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
chmod -R 755 storage bootstrap/cache
```

---

## 👤 Step 7: Create Admin User

```bash
php artisan make:filament-user
```

**Follow the prompts:**
- Name: Linda Mutesi
- Email: linda@mutesilinda.com
- Password: (choose a strong password)

---

## 🌐 Step 8: Verify Document Root

Make sure your subdomain points to the `/public` folder:

1. Exit SSH (type `exit`)
2. Login to cPanel
3. Go to **Domains**
4. Click on `dev.mutesilinda.com`
5. Set Document Root to: `/public_html/MutesiDev/public`
6. Save

---

## ✅ Step 9: Test Your Site

Visit: https://dev.mutesilinda.com

You should see your homepage!

Admin panel: https://dev.mutesilinda.com/admin

---

## 🔄 Future Updates (Auto-Deploy)

Now that Git is set up, you can enable auto-deployment:

### Add GitHub Secrets

Go to: https://github.com/ZuriJabari/Mutesilinda/settings/secrets/actions

Add these 6 secrets:

1. **FTP_SERVER**: `ftp.mutesilinda.com`
2. **FTP_USERNAME**: Your FTP username
3. **FTP_PASSWORD**: Your FTP password
4. **SSH_HOST**: `mutesilinda.com` (or your server IP)
5. **SSH_USERNAME**: Your cPanel username
6. **SSH_PASSWORD**: Your cPanel password
7. **SSH_PORT**: `22` (or your SSH port)

### How to Get These:
- **FTP credentials**: cPanel → FTP Accounts
- **SSH credentials**: Same as your cPanel login
- **SSH_HOST**: Usually your domain or server IP
- **SSH_PORT**: Usually 22 (ask your host if unsure)

Once secrets are added, every `git push` will automatically deploy to dev.mutesilinda.com!

---

## 🆘 Troubleshooting

### "Permission denied" when cloning
```bash
# Make sure you're in the right directory
cd public_html/MutesiDev
pwd  # Should show: /home/username/public_html/MutesiDev
```

### "composer: command not found"
```bash
# Try with full path
which composer
# Or download composer
curl -sS https://getcomposer.org/installer | php
php composer.phar install --no-dev --optimize-autoloader
```

### "php artisan: command not found"
```bash
# Use full PHP path
which php
/usr/bin/php artisan migrate --force
```

### Database connection error
- Double-check database name, username, password in `.env`
- Make sure database user has ALL PRIVILEGES
- Try connecting via phpMyAdmin to verify credentials

### 500 Internal Server Error
```bash
# Check permissions
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Check Laravel logs
```bash
tail -f storage/logs/laravel.log
```

---

## 📞 Need Help?

If you get stuck at any step, let me know which step and what error message you're seeing!

---

**Ready to start? Open your terminal and begin with Step 1!** 🚀
