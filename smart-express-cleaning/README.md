# Smart Express Cleaning Services (Laravel)

Backend starter project for the **Automated Cleaning Management System** from your SRS.

## Stack

- Laravel (PHP)
- MySQL
- REST API routes under `/api`

## Implemented Modules

- User roles on `users`: `admin`, `host`, `cleaner`
- Properties
- Bookings
- Cleaning jobs
- Cleaners
- Payments
- Inventory items
- Job supplies (inventory usage per cleaning job)
- Website contact form connected to database
- Admin panel for inquiry management
- Dynamic CMS-backed frontend content:
  - Site Pages (Home/About/Services/Blogs hero + section content)
  - Services
  - Blog Posts
- Multi-page frontend routes: Home, About Us, Our Services, Blogs

## API Resources

- `api/properties`
- `api/bookings`
- `api/cleaning-jobs`
- `api/cleaners`
- `api/payments`
- `api/inventory-items`

All are scaffolded as `apiResource` CRUD endpoints.

## Quick Start

1. Install dependencies:
   ```bash
   composer install
   ```
2. Configure database in `.env`:
   - `DB_CONNECTION=mysql`
   - `DB_HOST=127.0.0.1`
   - `DB_PORT=3306`
   - `DB_DATABASE=cleaning_services_web`
   - `DB_USERNAME=...`
   - `DB_PASSWORD=...`
3. Run migrations:
   ```bash
   php artisan migrate
   ```
4. Seed demo data:
   ```bash
   php artisan db:seed
   ```
5. Start server:
   ```bash
   php artisan serve
   ```

## Admin Access

- URL: `/admin/login`
- Email: `admin@smartexpresscleaning.com`
- Password: `password`

## Admin CMS CRUD Routes

- `/admin/site-pages` CRUD for page-level content
- `/admin/services` CRUD for services shown on website
- `/admin/blog-posts` CRUD for blog section
- `/admin/contact-inquiries` CRUD/status update for form submissions

## Frontend Routes

- `/` Home
- `/about-us` About Us
- `/our-services` Our Services
- `/blogs` Blog listing
- `/blogs/{slug}` Blog detail

## Frontend File Structure

- `app/Http/Controllers/FrontendController.php`
- `resources/views/frontend/layouts/app.blade.php`
- `resources/views/frontend/partials/navbar.blade.php`
- `resources/views/frontend/partials/footer.blade.php`
- `resources/views/frontend/partials/contact-form.blade.php`
- `resources/views/frontend/home.blade.php`
- `resources/views/frontend/about.blade.php`
- `resources/views/frontend/services.blade.php`
- `resources/views/frontend/blogs/index.blade.php`
- `resources/views/frontend/blogs/show.blade.php`
- `public/css/front.css`

## Notes

- Controllers include validation + basic CRUD JSON responses.
- Relationships are configured between all core entities to support scheduling and operations workflows.
- Admin dashboard now includes CMS stats and quick management links.
