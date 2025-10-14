# 🚀 Quick Deployment Checklist - dev.mutesilinda.com

## ✅ Step-by-Step Setup (30 minutes)

### 1. cPanel Setup (10 min)

**In cPanel:**
- [ ] Create subdomain: `dev.mutesilinda.com`
- [ ] Set document root: `/public_html/dev/public`
- [ ] Create MySQL database: `mutesilinda_dev`
- [ ] Create database user with strong password
- [ ] Grant ALL PRIVILEGES to user

**Note credentials:**
```
Database Name: _________________
Database User: _________________
Database Pass: _________________
```

### 2. Upload Files (5 min)

**Via cPanel File Manager:**
- [ ] Go to `/public_html/dev/`
- [ ] Upload project files (or use FTP client)
- [ ] DO NOT upload: `node_modules/`, `vendor/`, `.env`, `.git/`

### 3. Configure .env (5 min)

**Create `/public_html/dev/.env`:**
```env
APP_NAME="Mutesilinda Dev"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://dev.mutesilinda.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_pass

MAIL_MAILER=smtp
MAIL_HOST=mail.mutesilinda.com
MAIL_PORT=587
MAIL_USERNAME=linda@mutesilinda.com
MAIL_PASSWORD=your_email_pass
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=linda@mutesilinda.com
MAIL_FROM_NAME="Mutesilinda"
```

### 4. Run Setup Commands (5 min)

**Via cPanel Terminal or SSH:**
```bash
cd public_html/dev
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
chmod -R 755 storage bootstrap/cache
php artisan make:filament-user
```

### 5. GitHub Secrets (5 min)

**Go to:** https://github.com/ZuriJabari/Mutesilinda/settings/secrets/actions

**Add these secrets:**
- [ ] `FTP_SERVER` = ftp.mutesilinda.com
- [ ] `FTP_USERNAME` = your_ftp_username
- [ ] `FTP_PASSWORD` = your_ftp_password
- [ ] `SSH_HOST` = mutesilinda.com
- [ ] `SSH_USERNAME` = your_cpanel_username
- [ ] `SSH_PASSWORD` = your_cpanel_password
- [ ] `SSH_PORT` = 22

**Get credentials from:**
- cPanel → FTP Accounts (for FTP)
- cPanel → SSH Access (for SSH)
- Or contact your hosting provider

### 6. Enable SSL (2 min)

**In cPanel:**
- [ ] Go to SSL/TLS Status
- [ ] Find `dev.mutesilinda.com`
- [ ] Click "Run AutoSSL"
- [ ] Wait for certificate

### 7. Test Everything (3 min)

- [ ] Visit: https://dev.mutesilinda.com
- [ ] Homepage loads correctly
- [ ] Login to admin: https://dev.mutesilinda.com/admin
- [ ] Create test blog post
- [ ] View blog post on frontend

### 8. Test Auto-Deploy

**On your local machine:**
```bash
cd /Users/zuri/Desktop/LindaDaily-Laravel

# Make a test change
echo "# Auto-deploy test" >> README.md

# Push to GitHub
git add README.md
git commit -m "Test auto-deployment"
git push origin main
```

**Then:**
- [ ] Go to GitHub → Actions tab
- [ ] Watch deployment run
- [ ] Check https://dev.mutesilinda.com updates

---

## 🎉 Success!

Once complete, your workflow is:

1. **Make changes locally** → Edit files
2. **Test locally** → `php artisan serve`
3. **Commit & push** → `git push origin main`
4. **Auto-deploys** → Live in 2-5 minutes!

---

## 📞 Need Help?

**Common Issues:**

**500 Error:**
```bash
chmod -R 755 storage bootstrap/cache
php artisan cache:clear
```

**Database Error:**
- Check `.env` credentials
- Verify database exists
- Check user privileges

**Styles Missing:**
```bash
php artisan storage:link
```

**GitHub Action Fails:**
- Verify all GitHub Secrets are correct
- Check FTP/SSH credentials
- Review Actions logs

---

## 📚 Full Documentation

- **CPANEL_DEPLOYMENT.md** - Complete deployment guide
- **DEPLOYMENT.md** - General deployment info
- **README.md** - Project setup

---

**Ready to go live? Follow the checklist above!** ✨
