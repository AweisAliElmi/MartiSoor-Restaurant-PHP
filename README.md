# MartiSoor Restaurant System

Welcome to the MartiSoor Restaurant Ordering System! Follow this guide to set up and run the project on your local machine.

## 📋 Requirements (Prerequisites)

Before you begin, ensure you have the following software installed:

1.  **Visual Studio Code (VS Code)**: Code editor. [Download Here](https://code.visualstudio.com/)
2.  **PHP**: The scripting language. (Included in XAMPP or install separately). [Download Here](https://www.php.net/downloads)
    *   *Ensure `php` is added to your system environment variables path.*
3.  **PostgreSQL**: The database system. [Download Here](https://www.postgresql.org/download/)
    *   *Create a password you remember during installation (default is usually `postgres`/`root` or whatever you set).*

### VS Code Extensions (Optional but Recommended)
*   **PHP Intelephense** (by Ben Mewburn)
*   **PostgreSQL** (by Chris Kolkman)

---

## 🚀 Installation & Setup Steps

### 1. Configure Database Connection
1.  Open the project in VS Code.
2.  Navigate to `config/database.php`.
3.  Update the database credentials to match your local PostgreSQL setup:
    ```php
    define('DB_HOST', 'localhost');
    define('DB_PORT', '5432');
    define('DB_NAME', 'restaurant_db'); // Ensure this database exists
    define('DB_USER', 'postgres');      // Your PostgreSQL username
    define('DB_PASS', 'your_password'); // Your PostgreSQL password
    ```
4.  **Create the Database**: Open pgAdmin (or your SQL tool) and create a new database named `restaurant_db`.

### 2. Initialize the Database Tables
Open your terminal in VS Code (Ctrl+`) and run the following commands one by one to set up the tables:

```powershell
# 1. Create main tables (Users, Products, Orders)
php scripts/init_db.php

# 2. Add System Settings table
php scripts/update_settings_schema.php

# 3. Add Forgot Password columns to Users table
php scripts/fix_users_table.php
```

---

## 🏃‍♂️ How to Run the App

Once the database is ready, you can start the application.

1.  Open the terminal in the project folder.
2.  Run the following command to start the PHP local server:
    ```powershell
    php -S localhost:8000 -t public
    ```
3.  Open your web browser (Chrome, Edge, etc.).
4.  Go to: **[http://localhost:8000](http://localhost:8000)**

---

## 🔑 Default Accounts

*   **Admin Login**: You may need to register a new account first, then manually change the `role` to `'admin'` in the database users table, OR use the registration page if logic allows.
*   **Customer Login**: Register via the "Join Us" button.

---

## 🛠 Troubleshooting

*   **"php is not recognized"**: You need to add the PHP folder path to your Windows Environment Variables.
*   **Database Connection Failed**: Double-check your username, password, and port in `config/database.php`.
