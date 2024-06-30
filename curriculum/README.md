# Curriculum Management System

This project is a web application for managing resumes (curriculums). Users can create, search, filter, and list all resumes. Additionally, the application provides an option to download resumes as PDFs. The project uses PHP, MySQL, JavaScript, and jQuery, and is hosted on a XAMPP server.

## Project Structure

### Root Directory (/)
Main entry point for the application.

### Routes
- **Users Listing** (`/users.php`): Displays a list of all users.
- **User Form** (`/user-form.php`): Form for creating and editing user resumes.
- **User Detail** (`/user.php`): Displays detailed information about a single user.
- **Not Found** (`/not-found`): Error page for handling 404 errors.

All these routes can be accessed via the navigation bar.

## Setup Instructions

### Prerequisites
- **XAMPP**: Ensure that you have XAMPP installed on your system.
- **PHP**: PHP should be included with your XAMPP installation.
- **MySQL**: MySQL should be included with your XAMPP installation.

### Steps

1. **Clone the Repository**
    ```bash
    git clone https://github.com/your-username/curriculum-management-system.git
    ```

2. **Start XAMPP**
    - Open XAMPP Control Panel and start the Apache and MySQL services.

3. **Database Setup**
    - Open PHPMyAdmin by navigating to [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
    - Create a new database named `curriculum_db`.
    - Import the `db.sql` file located in the root of the project to set up the necessary tables.

4. **Configure Database Connection**
    - Edit the `db.php` file located in the `assets/php/` directory to match your database configuration.
    ```php
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ```

5. **Place Files in XAMPP's htdocs Directory**
    ```bash
    cp -r curriculum-management-system /path/to/xampp/htdocs/curriculum
    ```

6. **Access the Application**
    - Open your web browser and navigate to [http://localhost/curriculum](http://localhost/curriculum).

## Features

- **Create Resume**
    - Navigate to `/user-form.php` to create a new resume. Fill out the form with the necessary details and submit.
  
- **List All Resumes**
    - Navigate to `/users.php` to see a list of all resumes in the database.

- **Search and Filter Resumes**
    - Use the search functionality on the main page or `/users.php` to filter resumes by various criteria.

- **Download Resume as PDF**
    - Each resume detail page (`/user.php?id=1` for example) provides an option to download the resume as a PDF.

## File Structure

curriculum/
├── assets/
│ ├── css/
│ │ └── styles.css
│ ├── js/
│ │ └── script.js
│ └── php/
│ ├── db.php
│ ├── insertCurriculum.php
│ ├── listCurriculum.php
│ └── searchCurriculum.php
├── pages
│ ├── index.php
│ ├── users.php
│ ├── user-form.php
│ ├── user.php
│ └── not-found.php
└── index.html


## Troubleshooting

- **Database Connection Issues**: Ensure your `db.php` file has the correct database credentials. Enter your local environment in `db.php` and ensure to create the database with the sample name.
- **404 Errors**: Ensure all files are correctly placed in the `htdocs/curriculum` directory and that you are navigating to the correct URL.

