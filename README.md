# Announcement System

A simple, role-based announcement board built with core PHP and MySQL. Registered users can post and manage their own announcements, while admins have full control over users and content — no frameworks, just plain PHP and MySQLi.

## Features

- **User authentication** — register, login, and logout with session-based auth
- **Role-based access** — separate `user` and `admin` roles with protected routes
- **Announcements** — create, edit, and delete your own announcements
- **Admin dashboard** — manage all announcements and users, including deleting accounts
- **Public feed** — latest announcements are listed on the homepage for everyone to see

## Tech Stack

- **Backend:** PHP (procedural, MySQLi)
- **Database:** MySQL
- **Frontend:** HTML, CSS (no JS frameworks)

## Project Structure

```
announcement_system/
├── admin/              # Admin-only pages (dashboard, manage users & announcements)
├── announcements/       # Create, edit, delete announcements
├── auth/                # Login, register, logout
├── config/
│   ├── db.php           # Database connection (ignored by git, see setup below)
│   ├── db.example.php   # Template for db.php
│   └── functions.php    # Auth helpers (is_logged_in, is_admin, require_login)
├── partials/            # Shared layout pieces (header, nav)
├── index.php            # Public homepage — latest announcements
├── profile.php          # Logged-in user's profile page
├── style.css
└── database.sql         # Database schema
```

## Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/Kamal-Ashour/announcement_system.git
   ```

2. **Create the database**
   Import `database.sql` into MySQL (e.g. via phpMyAdmin or the CLI):
   ```bash
   mysql -u root -p < database.sql
   ```

3. **Configure the database connection**
   Copy the example config and edit it with your own credentials:
   ```bash
   cp config/db.example.php config/db.php
   ```

4. **Run the project**
   Place the folder inside your local server's web root (e.g. `htdocs` for XAMPP) and visit:
   ```
   http://localhost/announcement_system/
   ```

5. **Create an admin account**
   Register a normal account through the app, then update its role manually in the database:
   ```sql
   UPDATE users SET role = 'admin' WHERE email = 'your@email.com';
   ```

## Notes

- `config/db.php` is excluded from version control via `.gitignore` since it holds local database credentials. Always use `config/db.example.php` as a starting template.
