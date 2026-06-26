# Ecommerce Project

This is a Laravel-based Ecommerce application.

## Prerequisites

Before you begin, ensure you have the following installed on your machine:
- PHP >= 8.2
- Composer
- Node.js & NPM
- A database (e.g., MySQL, SQLite, PostgreSQL)

## Installation

Follow these steps to set up the project locally:

1. **Install PHP dependencies** using Composer:
   ```bash
   composer install
   ```

2. **Install JavaScript dependencies** using NPM:
   ```bash
   npm install
   ```

3. **Copy the environment file**:
   ```bash
   cp .env.example .env
   ```

4. **Generate the application key**:
   ```bash
   php artisan key:generate
   ```

5. **Configure the database**:
   Open the `.env` file and update your database credentials. For example, if you are using MySQL:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Run database migrations**:
   ```bash
   php artisan migrate
   ```
   *(Note: You can run `php artisan migrate --seed` if you want to populate the database with dummy data)*

## Running the Application

To run the application locally, you need to start both the backend server and the frontend asset bundler (Vite).

### Option 1: Concurrent Command (Recommended)
You can run both Laravel and Vite using the built-in Composer script:
```bash
composer run dev
```

### Option 2: Separate Terminals
Alternatively, you can run them in separate terminals:

1. **Start the Laravel server**:
   ```bash
   php artisan serve
   ```
   *The application will be accessible at `http://localhost:8000`.*

2. **Start the Vite development server**:
   ```bash
   npm run dev
   ```
