# 👤 User Management System (PHP + MySQL)

## 📌 Project Overview

This project is a **User Management System** developed using **PHP, MySQL, Bootstrap, and JavaScript**.
It allows users to register, login, and manage user data with role-based access and a clean, professional interface.

---

## 🛠️ Technologies Used

* HTML5
* CSS3
* Bootstrap 5
* JavaScript
* PHP
* MySQL
* XAMPP

---

## ✨ Features

* Responsive Login & Registration UI
* User Authentication (Login / Logout)
* Role-Based Access (Admin & User)
* Strong Password Validation
* Show/Hide Password Toggle
* Inline Error & Success Messages
* User Dashboard (Table Format)
* Image Upload & Display
* Edit User Details
* Delete User with Confirmation Popup

---

## 🔒 Password Requirements

* Minimum 6 characters
* At least 1 uppercase letter
* At least 1 lowercase letter
* At least 1 number
* At least 1 special character

---

## 📊 Dashboard Features

* Displays user data in table format
* Shows:

  * ID
  * Name
  * Email
  * Role
  * Profile Image
* Admin can:

  * Edit users
  * Delete users

---

## 📁 Project Structure

```
Apex_Task3/
│── config.php
│── register.php
│── login.php
│── dashboard.php
│── edit.php
│── delete.php
│── uploads/ (ignored in GitHub)
│── README.md
```

---

## ⚙️ Setup Instructions

### 1️⃣ Install & Start XAMPP

* Download and install XAMPP
* Open XAMPP Control Panel
* Start Apache and MySQL

### 2️⃣ Clone Repository

```
git clone https://github.com/YogitaBojanki/Apex_Task3.git
```

### 3️⃣ Move Project to XAMPP

Copy project folder to:

```
C:\xampp\htdocs\
```

Final path:

```
C:\xampp\htdocs\Apex_Task3
```

### 4️⃣ Create Database

Open browser:

```
http://localhost/phpmyadmin/
```

Run:

```
CREATE DATABASE user_system;
```

### 5️⃣ Create Table

Run:

```
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role ENUM('admin','user') DEFAULT 'user',
    image VARCHAR(255)
);
```

### 6️⃣ Configure Database Connection

Open `config.php`:

```
$conn = new mysqli("localhost", "root", "", "user_system", 3308);
```

(Change port if needed)

### 7️⃣ Create Upload Folder

```
uploads/
```

### 8️⃣ Protect Uploads

Create `.gitignore`:

```
uploads/
```

### 9️⃣ Run Project

```
http://localhost/Apex_Task3/register.php
```

---

## 🚀 How to Use

1. Register a new user
2. Login
3. Access dashboard
4. Admin can edit/delete users
5. Upload profile images

---

## 🔐 Security Notes

* Use `password_hash()`
* Validate inputs
* Restrict file uploads

---

## 📌 Future Improvements

* Search feature
* Pagination
* Email verification
* Password reset
* UI enhancements

---

## 📬 Author

**Yogita Bojanki**

---

## ⭐ Contribution

Feel free to fork and improve this project!
