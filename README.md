# Kelly - Dynamic Portfolio & Admin Panel

A dynamic personal portfolio website with a complete admin panel, built using **PHP**, **MySQL**, **HTML5**, **CSS3**, **JavaScript**, and **Bootstrap 5**.

The project allows portfolio content to be managed dynamically through an admin dashboard without directly editing the website source code.

---

## ✨ Features

### 🌐 Public Website

* Dynamic personal profile
* Education section
* Work experience
* Skills with progress indicators
* Services section
* Dynamic portfolio projects
* Portfolio categories
* Project details pages
* Contact information
* Contact form
* Testimonials
* Responsive design

### 🔐 Admin Panel

* Admin login and authentication
* Dashboard with portfolio statistics
* Profile management
* Education management
* Experience management
* Experience items management
* Skills management
* Services management
* Portfolio categories management
* Portfolio projects management
* Contact information management
* Contact messages management
* Logout functionality

---

## 🛠️ Technologies

* PHP
* MySQL
* HTML5
* CSS3
* JavaScript
* Bootstrap 5
* Bootstrap Icons
* PDO
* WAMP

---

## 📁 Project Structure

```text
Kelly/
│
├── admin/
│   ├── assets/
│   │   └── css/
│   │       └── admin.css
│   │
│   ├── includes/
│   │   ├── db.php
│   │   └── sidebar.php
│   │
│   ├── index.php
│   ├── login.php
│   ├── logout.php
│   ├── profile.php
│   ├── education.php
│   ├── experience.php
│   ├── skills.php
│   ├── services.php
│   ├── portfolio.php
│   ├── messages.php
│   └── contact.php
│
├── config/
│   └── database.php
│
├── assets/
│
├── images/
│
├── index.php
├── portfolio.php
├── portfolio-details.php
├── contact.php
│
└── README.md
```

---

## 🗄️ Database

Kelly uses **MySQL** to store and manage portfolio content dynamically.

Main database tables include:

* `admins`
* `profile`
* `education`
* `experience`
* `experience_items`
* `skills`
* `services`
* `portfolio_categories`
* `portfolio_projects`
* `contact_info`
* `contact_messages`
* `testimonials`

The public website retrieves its content dynamically from the database.

---

## ⚙️ Installation

### 1. Clone the Repository

```bash
git clone https://github.com/YOUR_USERNAME/Kelly.git
```

### 2. Move the Project

Place the project inside the WAMP `www` directory:

```text
C:\wamp64\www\Kelly
```

### 3. Create the Database

Create a MySQL database, for example:

```text
kelly_portfolio
```

Import the project's SQL database into MySQL.

### 4. Configure the Database

Update the database credentials in:

```text
config/database.php
```

and, if required:

```text
admin/includes/db.php
```

Example:

```php
$host = 'localhost';
$dbname = 'kelly_portfolio';
$username = 'root';
$password = '';
```

### 5. Start WAMP

Make sure the following services are running:

* Apache
* MySQL

Then open:

```text
http://localhost/Kelly/
```

Admin panel:

```text
http://localhost/Kelly/admin/
```

---

## 🔑 Admin Panel

The admin panel provides a centralized interface for managing the portfolio website.

Administrators can manage:

* Personal information
* Education
* Work experience
* Experience items
* Skills
* Services
* Portfolio categories
* Portfolio projects
* Contact information
* Contact messages

Changes made through the admin panel are reflected dynamically on the public website.

---

## 🔄 Dynamic Portfolio

The portfolio section is connected directly to the MySQL database.

Projects can be:

* Added
* Edited
* Deleted
* Assigned to categories
* Displayed dynamically
* Opened through individual project detail pages

Portfolio categories are also managed through the admin panel.

---

## 📱 Responsive Design

The public website and admin panel are designed to work across different screen sizes.

Supported layouts include:

* Desktop
* Laptop
* Tablet
* Mobile

---

## 🎨 Design

Kelly uses a clean and minimal visual style with:

* Card-based layouts
* Responsive grids
* Consistent typography
* Reusable form components
* Responsive admin sidebar
* Dashboard statistics
* Unified admin panel styling
* Clean and simple user interface

---

## 🔒 Security

The project uses several basic security practices, including:

* PHP sessions for admin authentication
* PDO for database communication
* Prepared statements for database queries
* Server-side form validation
* Session-based access control for admin pages

> This project is primarily intended as a portfolio and learning project. Additional security hardening is recommended before deploying it to a production environment.

---

## 🚀 Future Improvements

Possible future improvements include:

* Image upload management
* Rich text editor for portfolio content
* Pagination for messages and projects
* Advanced admin authentication
* Password hashing and password reset
* CSRF protection
* Improved form validation
* Search and filtering in the admin panel
* Production deployment
* Improved media management

---



## 👩‍💻 Author

**Parisa Shakeri**

Computer Engineer

---

## 📄 License

This project was created for educational, portfolio, and personal development purposes.
