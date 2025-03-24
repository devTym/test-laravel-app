# Test Laravel App

## Installation

1. Clone the project
2. Enter the project directory and set up dependencies & environment:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

3. Run the server:
```bash
php artisan serve
```

Running tests:
```bash
php artisan test
```
## !!!
"Generate New Link" button:
Allows regenerating the current link (important: it does NOT create a new record, only updates the existing link).
