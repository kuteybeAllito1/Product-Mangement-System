# 🌟 Product Management System

[![Laravel Version](https://img.shields.io/badge/Laravel-10.x-red)](https://laravel.com)  
[![PHP Version](https://img.shields.io/badge/PHP-8.1+-blue)](https://www.php.net)  
[![MySQL](https://img.shields.io/badge/MySQL-8.x-orange)](https://www.mysql.com)  
[![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)

---

## 🚀 Table of Contents

- [📌 Overview](#-overview)  
- [✨ Features](#-features)  
- [🔧 Tech Stack](#-tech-stack)  
- [⚙️ Installation](#️-installation)  
- [🎬 Usage](#-usage)  
- [🖼️ Screenshots](#️-screenshots)  
- [🤝 Contributing](#-contributing)  
- [📄 License](#-license)  
- [✉️ Contact](#️-contact)

---

## 📌 Overview

A full-featured **Product Management System** built with **Laravel**, **PHP**, **MySQL** and **Blade** templates.  
It provides:

- 🛠 CRUD for products  
- 👥 User registration & email verification  
- 🔒 Role-based access control (RBAC)  
- 🔑 Password reset & profile editing  
- 🛒 Shopping cart integration  

Perfect for learning modern PHP development and building a robust e-commerce backbone.

---

## ✨ Features

1. **Authentication & Verification**  
   - User signup, login & email OTP verification.  
   - Forgot-password workflow with secure token.

2. **Profile Management**  
   - Authenticated users can update their name, email, and password.

3. **Role & Permission System**  
   - **Super Admin**, **Admin**, **Seller**, **User** roles.  
   - Create new roles & granular permissions.  
   - Attach/detach permissions to roles dynamically.

4. **Product Management**  
   - List, create, edit & delete products.  
   - Search by name or description.  
   - UI actions gated by permissions.

5. **Shopping Cart**  
   - Add products to cart from listing.  
   - View cart: update qty, remove items, calculate totals.

---

## 🔧 Tech Stack

- **Framework:** Laravel 10.x  
- **Language:** PHP 8.1+  
- **Database:** MySQL 8.x  
- **Frontend:** Blade, Bootstrap 5, Font Awesome  
- **Email:** Built-in Mail with SMTP support  

---

## ⚙️ Installation

1. **Clone the repo**  
   ```bash
   git clone https://github.com/your-username/product-management.git
   cd product-management
