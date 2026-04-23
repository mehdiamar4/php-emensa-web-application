# E-Mensa

E-Mensa is a university canteen web application built with **PHP 8.2**, **MySQL**, and **Blade templating**.  
It allows users to browse canteen dishes, log in with their account, and access personalized content.

This project was developed as part of a web development practical course and focuses on backend logic, templating, routing, and user authentication.

---

## Features

- Browse and display canteen dishes from a MySQL database
- User login and logout with session management
- Personalized content for logged-in users
- Custom front controller and URL routing
- Blade templating with reusable layouts and views
- Prepared SQL statements for safer database queries
- Request and error logging with Monolog

---

## Technologies Used

- PHP 8.2
- MySQL
- BladeOne
- Composer
- Monolog
- HTML / CSS

---

## Project Structure

    config/              database connection
    controllers/         application controllers
    models/              database queries and business logic
    views/               Blade templates and layouts
    routes/web.php       route definitions
    public/index.php     front controller
    public/css/          stylesheets
    public/img/          images and assets
    composer.json        dependencies

---

## How It Works

The application follows a custom MVC-style structure.

### Routing and Controllers

Requests are handled through a front controller and mapped to the correct controller using custom route definitions.

### Database Interaction

Dish data and user data are loaded from a MySQL database.  
Prepared statements are used to execute database queries more safely.

### Authentication

Users can log in and log out through a session-based authentication system.  
Passwords are stored using SHA-1 with salt, following the project requirements.

### Templating

The frontend is rendered using Blade templates with reusable layouts and views, which helps keep the code organized and easier to maintain.

### Logging

Monolog is used to log requests and errors, making debugging and monitoring easier.

---

## Getting Started

### Requirements

- PHP 8.2 or higher
- MySQL
- Composer

### Install dependencies

    composer install

### Start the local server

    php -S localhost:8000 -t public

Then open:

    http://localhost:8000

in your browser.

---

## What I Learned

With this project, I practiced:

- building a web application with PHP and MySQL
- structuring an application with MVC principles
- implementing routing and controllers without a full framework
- working with Blade templating and reusable layouts
- handling login, logout, and session-based authentication
- using prepared statements for safer SQL queries
- organizing dependencies with Composer

---

## Author

Malek Bouaziz  
Ahmed Mehdi Amar
