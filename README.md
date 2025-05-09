
# 📚 Bookmates – Your Personal Book Sharing Portal

**Bookmates** is a dynamic web application that allows users to **share, browse, and connect over books**. Built using **HTML, CSS, PHP, and MySQL**, it supports secure user authentication, book uploads, and a clean browsing interface. The platform was developed locally using **XAMPP** and deployed on **InfinityFree** for public access.

---

## 🚀 Features

- 📖 **Browse Books** – Discover books uploaded by other users.
- ➕ **Post a Book** – Submit and share your favorite reads using a PHP-powered form.
- 🔐 **User Login & Signup** – Authenticate securely to access book upload features.
- 🏠 **Home Page** – Main landing page with site overview and links.
- ℹ️ **About Page** – Insight into the goals and mission of Bookmates.
- 📞 **Contact Page** – Send feedback or questions through a simple form.
- 💬 **Chat (Optional)** – Chat feature under development.

---

## 🧰 Tech Stack

| Layer       | Tools/Tech                     |
|-------------|--------------------------------|
| Frontend    | HTML, CSS                      |
| Styling     | `index.css`, `about.css`, `browse-books.css`, `enhanced.css`, etc. |
| Backend     | PHP (`displaybooks.php`)       |
| Hosting     | InfinityFree                   |
| Local Dev   | XAMPP (Apache & MySQL)         |
| Auth System | `login.html`, `signup.html`    |
| Upload Form | `post-a-book.html`             |
| Optional    | JavaScript (`/js/` folder)     |

---

## 🗂️ Project Structure

```bash
/bookmates/
├── .htaccess
├── index.html               # Home page
├── index.css
├── login.html               # Login page
├── signup.html              # Signup page
├── post-a-book.html         # Form to upload a book
├── displaybooks.php         # Handles book form submissions
├── about.html
├── about.css
├── browse-books.html
├── browse-books.css
├── contact.html
├── contact.css
├── chat.html                # Optional chat module
├── enhanced.css             # Extra styling
├── backend.txt              # Development references
├── /js/                     # JavaScript functionality
├── /styles/                 # CSS stylesheets
```

---

## 🛠️ Getting Started with Bookmates

### Requirements

- PHP & Apache (via XAMPP)
- MySQL for database
- A modern web browser

### 📍 Local Installation Guide

#### 🔧 Step 1: Install XAMPP
Download and install the latest version of XAMPP for your OS from https://www.apachefriends.org.

#### 📁 Step 2: Set Up Project Files
Move the entire Bookmates folder into your XAMPP `htdocs` directory:
```
C:/xampp/htdocs/bookmates
```

#### 🚀 Step 3: Start Services
Open the XAMPP Control Panel and start the following services:
- ✅ Apache
- ✅ MySQL

#### 🗃️ Step 4: Import Database
1. Open [phpMyAdmin](http://localhost/phpmyadmin)
2. Create a new database (e.g., `bookmates_db`)
3. Import the provided SQL file if available

#### 🌐 Step 5: Launch in Browser
Visit your local Bookmates site at:
[http://localhost/bookmates](http://localhost/bookmates)

---

## ☁️ Online Hosting Info

Bookmates is deployed using **InfinityFree**, a free PHP hosting platform.

- 💡 **Frontend & Backend**: PHP + HTML + CSS hosted via InfinityFree
- 🗄️ **Database**: MySQL accessed through InfinityFree’s phpMyAdmin
- 🔗 **Live Demo**: [bookmates.ct.ws](http://bookmates.ct.ws)

---

## 📌 Planned Enhancements

- 🔒 Session management and logout functionality
- 🖼️ Book cover image uploads
- 🧠 Smart search and filter by title/author
- 💬 Live chat or discussion threads
- 📱 Fully responsive mobile view

---

## 👥 Developed By

This project was created by the **Bookmates Team** as part of an academic initiative to encourage reading and community sharing.

---

## 📄 License

Free to use, modify, and share for educational and non-commercial purposes.
