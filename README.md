# Task Management System

A simple Task Management System built with **Laravel 12**, **Blade**, and **MySQL**.

The application supports two roles:

* **Admin** – Manage projects, tasks, employees, assignments, priorities, statuses, and dashboard statistics.
* **Employee** – View assigned tasks and update their task status.

The application also includes REST APIs and AJAX-based task status updates.

---

## Tech Stack

* Laravel 12
* PHP 8.2+
* MySQL
* Blade
* Laravel Breeze
* Laravel Sanctum
* JavaScript / AJAX
* Vite

---

## Requirements

Install the following tools:

* PHP 8.2+
* Composer
* MySQL
* Node.js & NPM
* Git

Check installed versions:

```bash
php -v
composer -V
mysql --version
node -v
npm -v
```

---

## Installation

### 1. Clone Repository

```bash
git clone https://github.com/developwithpiyush/TaskManagement.git
```

```bash
cd TaskManagement
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Configure Environment

Copy `.env.example` to `.env`.

Windows:

```bash
copy .env.example .env
```

Linux/macOS:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

---

## Database Setup

Update the database details in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=TaskManagement
DB_USERNAME=root
DB_PASSWORD=root
```

Update the database name, username, and password according to your local MySQL setup.

Create the database before running migrations:

```sql
CREATE DATABASE TaskManagement CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Run migrations and seed sample data:

```bash
php artisan migrate --seed
```

To reset the database and insert fresh sample data:

```bash
php artisan migrate:fresh --seed
```

---

## Run the Application

Start Laravel in one terminal:

```bash
php artisan serve
```

Start Vite in a second terminal for live frontend updates:

```bash
npm run dev
```

For a production-style asset build, use `npm run build` instead.

Open the application:

```text
http://127.0.0.1:8000/login
```

---

## Login Credentials

### Admin

```text
Email: admin@example.com
Password: password
```

### Employee

```text
Email: jane@example.com
Password: password
```

```text
Email: john@example.com
Password: password
```

These accounts are created by the database seeder.

---

## Main Features

### Admin

* Admin dashboard
* Project CRUD
* Task CRUD
* Assign tasks to employees
* Set task priority and status
* Set task due dates
* Search and filter tasks
* View project and task statistics

### Employee

* Employee dashboard
* View assigned tasks
* View task details
* Update own task status
* Restricted access to admin functionality
* Cannot access other employees’ tasks

---

## API

API base URL:

```text
http://127.0.0.1:8000/api/v1/
```

### Task Endpoints

| Method | Endpoint                    | Description        |
| ------ | --------------------------- | ------------------ |
| POST   | `/api/v1/login`             | Log in and get a token |
| GET    | `/api/v1/tasks`             | Get tasks          |
| GET    | `/api/v1/tasks/{id}`        | Get task details   |
| POST   | `/api/v1/tasks`             | Create task        |
| PUT    | `/api/v1/tasks/{id}`        | Update task        |
| DELETE | `/api/v1/tasks/{id}`        | Delete task        |
| PATCH  | `/api/v1/tasks/{id}/status` | Update task status |

The task list supports optional `search`, `project_id`, `assigned_to` (admin only),
`status`, and `priority` query parameters.

Protected API endpoints require authentication.

Example headers:

```http
Authorization: Bearer YOUR_TOKEN
Accept: application/json
Content-Type: application/json
```

The APIs can be tested using **Postman**.

---

## AJAX Functionality

Employees can update the status of their assigned tasks using AJAX without refreshing the page.

---

## Useful Commands

Clear application cache:

```bash
php artisan optimize:clear
```

View all routes:

```bash
php artisan route:list
```

Run migrations:

```bash
php artisan migrate
```

Rollback migrations:

```bash
php artisan migrate:rollback
```

Reset database and seed sample data:

```bash
php artisan migrate:fresh --seed
```
---
