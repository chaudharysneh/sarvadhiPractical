# Manage Digital Education System

A simple Laravel app for managing teachers, students, sessions, and payouts.

## Setup

1. Copy `.env.example` to `.env` and set your database and SMTP (already done if you configured `.env`).
2. Run migrations and seed the default Super Admin:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```
3. Start the app: `php artisan serve` (or use XAMPP with the project in `htdocs`).

## Default Super Admin

- **URL:** `/admin/login`
- **Email:** `admin@digitaledu.com` 
- **Password:** `password`

## Login

- **Teachers & Students:** `/login` — use Unique ID, Password, and Role.
- **Admin:** `/admin/login` — use Email and Password.

## Features

- **Admin:** CRUD teachers/students, assign students to teachers, view sessions (filter by date/student), view payouts (filter by date/student), send monthly session report email to parent.
- **Teacher:** Add sessions (with daily/weekly limits and no overlap rules), view sessions/assigned students/payouts.
- **Student:** View sessions and assigned teachers.

Session documents (docx, pdf, txt) are stored under `storage/app/session-docs/`.
