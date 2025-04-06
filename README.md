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



⚙️ Local Development Setup
Install XAMPP from https://www.apachefriends.org
Place the project folder in your htdocs directory.
Start Apache and MySQL via XAMPP Control Panel.
Open phpMyAdmin and import your database (if available).
Open http://localhost/bookmates/ in your browser to run the site locally.
