# E-Learning (Backend)

Repository: https://github.com/MohammedAkramQudaih/elearning-backend

## About
This repository contains the backend (Laravel) for an E-Learning admin panel. It provides user and role management, courses, categories, authentication, and seeders for initial data.

## Features
- User management with multiple roles (Admin, Team Leader, Project Manager, Employee, etc.)
- Authentication and session management (Laravel Sanctum may be used)
- Migrations and seeders for initial data
- File storage linked to public for uploads

## Requirements
- PHP >= 8.0 (check composer.json for exact compatibility)
- Composer
- MySQL / MariaDB (or other supported DB)
- Node.js + npm/yarn (if front-end assets are needed)
- Git (for cloning)

## Quick Setup (local)
1. Clone the repository
```sh
git clone https://github.com/MohammedAkramQudaih/elearning-backend.git
cd elearning-backend
```

2. Copy the example environment file
- On Git Bash / WSL:
```sh
cp .env.example .env
```
- On Windows CMD:
```bat
copy .env.example .env
```

3. Create a database (example name: elearning) using your preferred tool.

4. Edit `.env` and set database credentials:
```env
DB_DATABASE=elearning
DB_USERNAME=root
DB_PASSWORD=your_password
```

5. Install PHP dependencies
```sh
composer install
```

6. Generate the application key
```sh
php artisan key:generate
```

7. Run migrations and seeders
```sh
php artisan migrate:fresh --seed
```

8. Link storage to public
```sh
php artisan storage:link
```

9. Serve the application
```sh
php artisan serve
```

10. Visit http://localhost:8000

## Default seeded accounts
After running seeders, a default admin account is created:
- Email: admin@example.com
- Password: password


📬 Testing with Postman
A complete Postman collection is included for API testing.

Import the collection:
```bash
# In Postman, import:
postman/E-Learning-API.postman_collection.json
```

Import the environment variables:
```bash
# In Postman, import:
postman/E-Learning-Local.postman_environment.json
```

Use the imported environment to switch base URL and credentials, then run requests or collections as needed.

## Notes & Tips
- Ensure APP_URL, APP_ENV and APP_DEBUG are set appropriately in `.env`.
- If file upload or cache permission errors appear, check permissions for `storage/` and `bootstrap/cache`.
- Use `composer update` only when you need to update dependencies; prefer `composer install` for project setup.

## 🚀 Future Improvements

Role-based permissions

API authentication (Sanctum)

Unit & Feature Tests

Docker Support

CI/CD Pipeline


## 💼 Ready for Submission

This project is structured to meet evaluation criteria including:

Clean architecture

Proper separation of concerns

API usage

Validation handling

Maintainable code structure

