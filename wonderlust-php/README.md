# Wonderlust PHP Project — Airline Management System

**Wonderlust** is a fictional airline management system built with **PHP, MySQL** and integrates **APIs** for city info and feedback/blogging.

## Features
- Passenger & Flight Report: view flights and registered passengers.
- Passenger Entry Form: register passengers for a flight.
- Feedback Section: submit feedback, integrated via Blogger API.
- Cities Info: choose a city and see weather, time, and flag via API.

## Technologies
- PHP 7+  
- MySQL (XAMPP)  
- HTML5, CSS3, JavaScript  
- APIs for feedback/blog and city info

## Database
The project uses a MySQL database named `airportdb` with the following tables:
- `Flight` — flight information
- `Passengers` — passenger information
- `Bookings` — link passengers to flights

**Database file:** `airportdb.sql` (included in the project folder)

### Setup in Localhost (XAMPP)
1. Install [XAMPP](https://www.apachefriends.org/index.html) and start **Apache** and **MySQL**.  
2. Copy the project folder to `C:\xampp\htdocs\` (or another folder if you prefer).  
3. Open **phpMyAdmin** (`http://localhost/phpmyadmin/`)  
   - Create a new database called `airportdb` (or use the same name as in `config.php`).  
   - Import the file `airportdb.sql` using the **Import** tab.  
4. Check `config.php` (or database connection in PHP files) and ensure:
```php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airportdb";
