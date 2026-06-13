# Project Handover Document

**EST Group Corporate Website** (`estgroup.com.my`)  
**Repository:** https://github.com/zahir248/estgroup.com.my.git  
**Last reviewed:** June 2026

---

## 1. Project Summary

| Item | Details |
|------|---------|
| **Project Name** | EST Group Website |
| **Purpose of the system** | Corporate marketing website for EST Group — a Malaysian company focused on renewable energy, solar development, and EV charging solutions. The site presents company information and captures visitor inquiries. |
| **Main features** | Public pages (Home, About, Services, Partners, Contact); contact form with email delivery; admin CMS for site settings, home stats, partner logos, team members, and contact details; maintenance mode toggle |
| **Target users** | **Public:** prospective clients, partners, and investors. **Internal:** EST Group staff managing website content via `/admin` |

---

## 2. System Overview

| Layer | Technology |
|-------|------------|
| **Frontend** | Laravel Blade templates, Bootstrap 5 (CDN), Bootstrap Icons, Google Fonts (Plus Jakarta Sans), inline CSS, minimal vanilla JavaScript |
| **Backend** | PHP 8.2+, Laravel 12 |
| **Database** | SQLite (local default); MySQL/MariaDB supported for production |
| **Overall architecture** | Monolithic server-rendered MVC app. Public pages are mostly static Blade views with selected dynamic content loaded from the database (`settings`, `partner_logos`, `team_members`). A password-protected admin area at `/admin` manages content. No separate API or SPA frontend. |

**Note:** Vite and Tailwind CSS are present in `package.json` but are **not** used in the current views (Bootstrap CDN is used instead).

---

## 3. Project Structure

Brief explanation of important folders and files.

| Folder/File | Purpose |
|------------|----------|
| `app/Http/Controllers/` | Public controllers (`ContactController`, image serving) |
| `app/Http/Controllers/Admin/` | Admin CMS controllers (auth, pages, settings, partners) |
| `app/Http/Middleware/CheckMaintenanceMode.php` | Shows maintenance page to visitors when enabled |
| `app/Models/` | Eloquent models: `Setting`, `PartnerLogo`, `TeamMember`, `User` |
| `app/Mail/ContactFormMail.php` | Email template for contact form submissions |
| `routes/web.php` | All public and admin routes |
| `resources/views/` | Blade templates for public site, admin panel, and emails |
| `resources/views/layouts/app.blade.php` | Main public site layout |
| `resources/views/layouts/admin.blade.php` | Admin panel layout |
| `database/migrations/` | Database schema definitions |
| `database/seeders/` | Default admin user and partner logo seed data |
| `public/` | Web root (images, `index.php`, `.htaccess`) |
| `storage/app/public/` | Uploaded partner logos and team member photos |
| `config/` | Laravel configuration (app, database, mail, etc.) |
| `.env` | Environment-specific secrets and settings (not in git) |
| `.env.example` | Template for required environment variables |

---

## 4. Setup & Run

### 1. Prerequisites

- PHP 8.2 or higher (with extensions: `pdo`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `fileinfo`)
- Composer
- Node.js and npm (optional for asset build; not required for current UI)
- SQLite (local) or MySQL/MariaDB (production)

### 2. Installation

```bash
git clone https://github.com/zahir248/estgroup.com.my.git
cd estgroup.com.my
composer install
cp .env.example .env
php artisan key:generate
```

For SQLite (local default):

```bash
touch database/database.sqlite
php artisan migrate
php artisan db:seed
```

For MySQL, update `DB_*` values in `.env` first, then run migrate and seed.

Ensure upload directory is writable:

```bash
php artisan storage:link   # optional; custom routes serve images without symlink
```

### 3. Environment variables required

| Variable | Purpose |
|----------|---------|
| `APP_NAME` | Site name shown in titles and admin |
| `APP_ENV` | `local` or `production` |
| `APP_KEY` | Laravel encryption key (auto-generated) |
| `APP_DEBUG` | `true` locally; **must be `false` in production** |
| `APP_URL` | Full site URL (e.g. `https://estgroup.com.my`) |
| `DB_CONNECTION` | `sqlite` or `mysql` |
| `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` | MySQL settings (if used) |
| `SESSION_DRIVER` | `database` (default) |
| `MAIL_MAILER` | `smtp` for production; `log` for local testing |
| `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD` | SMTP credentials |
| `MAIL_FROM_ADDRESS`, `MAIL_FROM_NAME` | Sender address for outgoing mail |

### 4. Run commands

**Quick setup (all-in-one):**

```bash
composer run setup
```

**Local development:**

```bash
php artisan serve
# Site available at http://localhost:8000
```

**Admin access:** `/admin/login`  
Default admin is created by `DatabaseSeeder` — change the password immediately after first login.

---

## 5. Deployment

| Topic | Details |
|-------|---------|
| **Hosting/server** | Shared hosting on **cPanel** with Apache (inferred from code comments and `.htaccess`). Domain: `estgroup.com.my`. |
| **Deployment process** | Not Identified (no CI/CD pipeline in repository). Typical cPanel flow: upload/pull code via Git, set document root to `public/`, configure `.env` on server, run `composer install --no-dev`, `php artisan migrate --force`, `php artisan config:cache`, `php artisan route:cache`. |
| **Important deployment notes** | Set `APP_DEBUG=false` and `APP_ENV=production`. Configure real SMTP for contact form. Ensure `storage/` and `bootstrap/cache/` are writable. Uploaded images are stored in `storage/app/public/` and served via `/partner-image/` and `/team-image/` routes (no `storage:link` symlink required on cPanel). Health check endpoint: `/up`. |

---

## 6. Database Overview

List of important tables for application functionality.

| Table | Purpose |
|--------|---------|
| `settings` | Key-value store for site name, maintenance mode, contact info, home page stats (`home_energy_stats` JSON) |
| `partner_logos` | Partner/accreditation logos on the home page (sections: `accreditation`, `strategic`, `financial`) |
| `team_members` | Leadership/team profiles on the About page |
| `users` | Admin login accounts |
| `sessions` | Admin session storage |
| `cache` | Laravel database cache |
| `jobs` | Laravel queue jobs (if queue worker is used) |

### Key `settings` keys

| Key | Used for |
|-----|----------|
| `site_name` | Site branding |
| `maintenance_mode` | `1` = show maintenance page to visitors |
| `contact_address`, `contact_email`, `contact_phone` | Footer and contact page |
| `home_energy_stats` | JSON array of 4 stat counters on home page |

---

## 7. API & Integrations

This project has **no REST API**. Integrations are limited to the following:

| Integration | Purpose |
|------------|---------|
| **SMTP / Laravel Mail** | Sends contact form submissions to the configured `contact_email` |
| **Google Fonts** | Loads Plus Jakarta Sans typography (CDN) |
| **Bootstrap 5 & Bootstrap Icons** | UI framework and icons (jsDelivr CDN) |
| **Google Maps Embed** | Office location map on the Contact page |
| **NexTron website** | External link from home page (`https://www.nextron.my/`) |

**Not configured / not in use:** Payment gateway, Google Analytics, SSO, Postmark, Resend, AWS S3, Slack notifications.

---

## 8. Access & Credentials

**Do not commit secrets to git.** Store all production credentials in the server `.env` file or hosting control panel.

| Access Type | Where It Is Stored |
|------------|-------------------|
| Database credentials | Server `.env` (`DB_*` variables) |
| Admin login | `users` table; default seeded via `database/seeders/DatabaseSeeder.php` |
| SMTP / email | Server `.env` (`MAIL_*` variables) |
| Laravel app key | Server `.env` (`APP_KEY`) |
| Uploaded images | `storage/app/public/partners/` and `storage/app/public/team/` |
| Application logs | `storage/logs/laravel.log` |
| Git repository | https://github.com/zahir248/estgroup.com.my.git |

---

## 9. Important Notes

### Admin panel routes

| URL | Function |
|-----|----------|
| `/admin/login` | Admin login |
| `/admin/dashboard` | Dashboard |
| `/admin/settings` | Site name and maintenance mode |
| `/admin/pages/home` | Home stats and partner logos |
| `/admin/pages/about` | Team member management |
| `/admin/pages/contact` | Contact page details |

### Public routes

| URL | Page |
|-----|------|
| `/` | Home |
| `/about` | About (team members from DB) |
| `/what-we-do` | Services |
| `/partner-we-seek` | Partners |
| `/contact` | Contact form |

### Known issues / limitations

- **What We Do page** has placeholder content for some service sections ("Content will be added soon").
- **About page** main text content is hardcoded in the Blade template; only team members are admin-editable.
- **Vite/Tailwind** are installed but unused — UI relies on Bootstrap CDN and inline styles.
- **Default admin password** in `DatabaseSeeder` must be changed after first deployment.
- **No automated tests** beyond Laravel's default example tests.

### Common troubleshooting

| Problem | Likely fix |
|---------|------------|
| Contact form fails | Check `MAIL_*` settings in `.env`; review `storage/logs/laravel.log` |
| Uploaded images not showing | Confirm files exist in `storage/app/public/`; images are served via `/partner-image/` and `/team-image/` routes |
| Site shows maintenance page | Log in to `/admin/settings` and disable maintenance mode |
| 500 error after deploy | Run `php artisan config:clear`; verify `storage/` permissions and `APP_KEY` is set |
| Database errors | Run `php artisan migrate`; verify `DB_*` credentials |

### Things future developers should know

- Content is split between **database-managed** (stats, partners, team, contact info) and **hardcoded Blade templates** (most page copy and layout).
- Maintenance mode is app-level (database setting), separate from Laravel's built-in `php artisan down` command.
- The contact form recipient is the `contact_email` setting, not necessarily `MAIL_FROM_ADDRESS`.
- When adding new upload features, follow the existing pattern: store in `storage/app/public/` and serve via a dedicated controller route (for cPanel compatibility).
- Repository commit history is informal ("update", "update UI") — refer to this document and code for context rather than commit messages.

---

*End of document*
