# ⚙️ BistroBliss - Backend (Laravel 12 API)

This is the **RESTful API** backend for the BistroBliss Restaurant Management System. It handles all data logic, database management, and provides secure endpoints for the React frontend.

---

## 🛠️ Technologies & Tools
* **PHP 8.x** - Core Language.
* **Laravel 12** - Modern PHP Framework.
* **MySQL** - Relational Database.
* **Eloquent ORM** - For clean and efficient database queries.
* **Postman** - Used for API testing and documentation.

---

## ✨ API Features
* **Menu Management:** Full CRUD operations for restaurant categories and food items.
* **Reservation Logic:** Handles table booking requests and stores them in the database.
* **JSON Responses:** Standardized API responses for seamless integration with any frontend.
* **Database Migrations:** Structured schema management for consistent environments.

---

## 🚀 Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/momenahmed450-bit/BistroBliss-Backend.git](https://github.com/momenahmed450-bit/BistroBliss-Backend.git)


    <!-- Install Dependencies: -->

Bash
composer install

Environment Setup:

Copy .env.example to .env.

Update .env with your local database credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

Generate App Key:

Bash
php artisan key:generate

Run Migrations & Seeders:

Bash
php artisan migrate

Start the Server:

Bash
php artisan serve

🔗 Related Repositories
Frontend (React.js): View BistroBliss Frontend


👨‍💻 Momen Ahmed
Junior Full Stack Web Developer based in Alexandria, Egypt.