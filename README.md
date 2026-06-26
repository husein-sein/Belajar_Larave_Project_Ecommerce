<div align="center">
  <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel Logo" width="80">
  <img src="https://upload.wikimedia.org/wikipedia/commons/d/d5/Tailwind_CSS_Logo.svg" alt="Tailwind Logo" width="80" style="margin-left: 20px;">
  <br><br>
  <h1>🛒 E-Commerce IT Store</h1>
  <p><b>Modern, Fast, and Responsive E-Commerce Platform Built with Laravel & Tailwind CSS</b></p>
  
  <p>
    <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
    <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
    <img src="https://img.shields.io/badge/Vite-B73BFE?style=for-the-badge&logo=vite&logoColor=FFD62E" alt="Vite">
    <img src="https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white" alt="AlpineJS">
  </p>
</div>

---

## ✨ Features

- **Modern UI/UX**: Designed meticulously with **Tailwind CSS** for a fully responsive and clean layout.
- **Fast Asset Bundling**: Powered by **Vite** for instantaneous Hot Module Replacement (HMR) during frontend development.
- **Interactive Elements**: Uses **Alpine.js** for lightweight, declarative frontend reactivity.
- **Full E-Commerce Flow**: Cart management, checkout processing, and real-time order tracking.
- **Admin Dashboard**: Comprehensive dashboard for managing products, categories, users, and tracking orders with estimated delivery timelines.

## 🛠️ Tech Stack

### Frontend
- **CSS Framework**: Tailwind CSS v4
- **Build Tool**: Vite
- **Icons**: FontAwesome 6
- **Reactivity**: Alpine.js
- **Typography**: Google Fonts (Inter)

### Backend
- **Framework**: Laravel (PHP >= 8.2)
- **Database**: MySQL / SQLite
- **Architecture**: MVC Pattern

---

## 🚀 Getting Started

Follow these instructions to get the project up and running on your local machine.

### Prerequisites

Make sure you have the following installed:
- [PHP](https://www.php.net/) >= 8.2
- [Composer](https://getcomposer.org/)
- [Node.js & npm](https://nodejs.org/) (for Vite & Tailwind)
- A local server environment (e.g., Laragon, XAMPP, or Laravel Herd)

### 1. Installation

Clone the repository and install all required dependencies:

```bash
# Install PHP dependencies
composer install

# Install Frontend dependencies
npm install
```

### 2. Environment Setup

Copy the example environment file and generate your application key:

```bash
cp .env.example .env
php artisan key:generate
```

Don't forget to set up your database credentials in the `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_db
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Database Migration & Seeding

Run the migrations to create the tables, and seed them with dummy data (products, categories, and default users):

```bash
php artisan migrate --seed
```

> **Default Accounts**
> - **Admin:** `admin@ecommerceit.com` | Password: `password`
> - **User:** `user@example.com` | Password: `password`

### 4. Running the Development Servers

Since this project heavily relies on **Vite** for compiling Tailwind CSS and frontend assets, you need to run **both** the backend and frontend servers.

**Run everything concurrently (Recommended):**
```bash
composer run dev
```

**OR run them in separate terminals:**
```bash
# Terminal 1: Start Laravel Backend
php artisan serve

# Terminal 2: Start Vite Frontend (Hot Reload for Tailwind)
npm run dev
```

Visit `http://localhost:8000` in your browser.

---

## 🎨 UI Highlights

- **Glassmorphism & Shadows**: Soft shadows and blurred backgrounds used across cards and modals for a premium feel.
- **Smooth Animations**: Hover states and transitions applied to buttons and tables for a dynamic experience.
- **Typography**: Uses the *Inter* font family for highly legible and modern text rendering.

---
<div align="center">
  <i>Built with ❤️ for a great developer and user experience.</i>
</div>
