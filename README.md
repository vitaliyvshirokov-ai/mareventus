# Mare Ventus Logistics FZCO

A single-page corporate website and protected content administration panel for a Dubai-based maritime logistics company. The project uses Laravel 11, MySQL 8, Blade, Tailwind CSS, Alpine.js, Trix and Vite.

## Requirements

- PHP 8.2 or newer
- Composer 2
- MySQL 8
- Node.js 20 or newer and npm
- A configured SMTP account

## Installation

```bash
composer install
copy .env.example .env
php artisan key:generate
```

Create a MySQL database, then update the `DB_*` and `MAIL_*` values in `.env`. Set `ADMIN_NOTIFICATION_EMAIL` to the address that should receive new website enquiries.

```bash
php artisan migrate --seed
php artisan storage:link
npm install
npm run build
php artisan admin:create
php artisan serve
```

Open the website at `http://127.0.0.1:8000` and the administration panel at `http://127.0.0.1:8000/admin`.

## Dependency-free preview

The visual preview does not require PHP, Composer or installed npm packages:

```bash
npm run dev
```

Open the URL printed in the terminal, normally `http://127.0.0.1:5173`. The preview includes responsive navigation, the fleet lightbox and the local contact-form success state. Run `npm run vite` when developing against a fully installed Laravel environment.

## Administration

Public registration is disabled. Create or update the single administrator with:

```bash
php artisan admin:create
```

The administration panel manages landing-page content, services, fleet images, partners, contact details and incoming enquiries. Fleet uploads receive neutral UUID-based filenames automatically. Upload only imagery that has been reviewed for flags, vessel names, operator marks and watermarks.

## Contact workflow

The public form uses server-side Form Request validation, CSRF protection, a honeypot field and rate limiting. A valid submission is stored in `contact_requests`, notifies the administrator and sends an English auto-reply to the sender.

For local mail testing, use a mail catcher or set `MAIL_MAILER=log`.

## Image workflow

Source photography remains in `foto/` and is not served directly. Approved website images live in `public/assets/images/` under neutral English filenames. `npm run build` runs the WebP optimization script before compiling Vite assets.

## Production checklist

- Set `APP_ENV=production`, `APP_DEBUG=false` and the final `APP_URL`.
- Configure MySQL backups, SMTP credentials, HTTPS and queue workers.
- Run `php artisan config:cache`, `php artisan route:cache` and `php artisan view:cache`.
- Verify the public storage symlink and writable `storage/` directories.
- Review every newly uploaded fleet image before publishing.
