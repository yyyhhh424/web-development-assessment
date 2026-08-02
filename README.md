# Web Development Assessment

A complete technical assessment repository containing:

1. An e-commerce Entity Relationship Diagram (ERD) and MySQL schema
2. A PHP/MySQL to-do list application with CRUD operations
3. A completed browser-based Reversi game

## Deliverables

| Folder | Deliverable | Main file |
|---|---|---|
| `01-erd` | E-commerce ERD and MySQL schema | `ecommerce-erd.png` |
| `02-todo-app` | PHP/MySQL CRUD to-do application | `public/index.php` |
| `03-reversi` | Completed Reversi game | `reversi-game.html` |

## Repository Structure

```text
.
├── .github/
│   └── workflows/
│       └── php-lint.yml
├── 01-erd/
│   ├── ecommerce-erd.md
│   ├── ecommerce-erd.png
│   ├── ecommerce-schema.sql
│   └── ecommerce.dot
├── 02-todo-app/
│   ├── config/
│   ├── public/
│   ├── sql/
│   ├── src/
│   ├── views/
│   ├── Dockerfile
│   └── README.md
├── 03-reversi/
│   ├── reversi-game.html
│   └── README.md
├── docs/
│   ├── assessment-requirements.md
│   └── database-setup.md
├── .env.example
├── .gitignore
├── docker-compose.yml
└── README.md
```

---

## 1. E-commerce ERD

The e-commerce database design includes:

- Customers and customer addresses
- Categories and products
- Orders and order items
- Payments and shipments
- Product reviews

Files:

- ERD image: `01-erd/ecommerce-erd.png`
- Mermaid ERD source: `01-erd/ecommerce-erd.md`
- MySQL schema: `01-erd/ecommerce-schema.sql`

---

## 2. PHP/MySQL To-do List

### Features

- Create tasks
- Read and filter tasks
- Update task details
- Mark tasks as completed or pending
- Delete tasks
- Server-side validation
- PDO prepared statements
- CSRF protection
- Escaped output to reduce XSS risk
- Responsive user interface

The application can be run either **with Docker** or **without Docker**.

---

# Run with Docker

## Requirements

Install Docker Desktop for your operating system:

- macOS: Docker Desktop for Mac
- Windows: Docker Desktop for Windows
- Linux: Docker Engine and Docker Compose plugin

Make sure Docker Desktop is open and running before entering the commands below.

## macOS or Linux

Open Terminal and go to the repository folder:

```bash
cd /path/to/web-development-assessment
```

Create the local environment file:

```bash
cp .env.example .env
```

Build and start the application:

```bash
docker compose up --build
```

Open the application in a browser:

```text
http://localhost:8080
```

Stop the application with `Control + C`, then run:

```bash
docker compose down
```

## Windows PowerShell

Open PowerShell and go to the repository folder. For example:

```powershell
cd "$HOME\Downloads\web-development-assessment"
```

Create the local environment file:

```powershell
Copy-Item .env.example .env
```

Build and start the application:

```powershell
docker compose up --build
```

Open the application in a browser:

```text
http://localhost:8080
```

Stop the application with `Ctrl + C`, then run:

```powershell
docker compose down
```

## Windows Command Prompt

```cmd
cd %USERPROFILE%\Downloads\web-development-assessment
copy .env.example .env
docker compose up --build
```

Open:

```text
http://localhost:8080
```

Stop the application with `Ctrl + C`, then run:

```cmd
docker compose down
```

## Reset the Docker database

The following commands delete the current Docker database volume and create a fresh database:

```bash
docker compose down -v
docker compose up --build
```

---

# Run without Docker

## Requirements

Install the following software:

- PHP 8.1 or later
- MySQL 8 or later
- PHP PDO MySQL extension

Check that PHP and MySQL are available:

```bash
php -v
mysql --version
```

## macOS or Linux

Open Terminal and enter the repository folder:

```bash
cd /path/to/web-development-assessment
```

Create `.env` from the example file:

```bash
cp .env.example .env
```

Edit `.env` and enter the details for your local MySQL installation:

```dotenv
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_app
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

Create the database and task table:

```bash
mysql -u root -p < 02-todo-app/sql/001_create_tasks.sql
```

Enter the MySQL root password when prompted.

Start the PHP development server from the repository root:

```bash
php -S localhost:8080 -t 02-todo-app/public
```

Open:

```text
http://localhost:8080
```

Stop the server with `Control + C`.

## Windows PowerShell

Open PowerShell and go to the repository folder:

```powershell
cd "$HOME\Downloads\web-development-assessment"
```

Create the environment file:

```powershell
Copy-Item .env.example .env
```

Open `.env` with Notepad:

```powershell
notepad .env
```

Enter the local MySQL credentials:

```dotenv
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_app
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

Create the database and task table:

```powershell
Get-Content 02-todo-app\sql\001_create_tasks.sql | mysql -u root -p
```

Start the PHP development server:

```powershell
php -S localhost:8080 -t 02-todo-app/public
```

Open:

```text
http://localhost:8080
```

Stop the server with `Ctrl + C`.

## Windows Command Prompt

```cmd
cd %USERPROFILE%\Downloads\web-development-assessment
copy .env.example .env
notepad .env
mysql -u root -p < 02-todo-app\sql\001_create_tasks.sql
php -S localhost:8080 -t 02-todo-app/public
```

Open:

```text
http://localhost:8080
```

## Windows using XAMPP

XAMPP may also be used when PHP and MySQL are not installed separately.

1. Install XAMPP.
2. Open the XAMPP Control Panel.
3. Start **Apache** and **MySQL**.
4. Open XAMPP Shell or a terminal where the XAMPP PHP and MySQL commands are available.
5. Go to the repository folder.
6. Copy `.env.example` to `.env`.
7. Use these common XAMPP settings in `.env`:

```dotenv
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_app
DB_USERNAME=root
DB_PASSWORD=
```

8. Import the SQL file using phpMyAdmin:
   - Open `http://localhost/phpmyadmin`
   - Select **Import**
   - Choose `02-todo-app/sql/001_create_tasks.sql`
   - Click **Import**
9. Start the application from the repository root:

```cmd
php -S localhost:8080 -t 02-todo-app/public
```

10. Open `http://localhost:8080`.

> The default XAMPP MySQL root account often has no password. Use the actual password configured on your computer.

---

## 3. Reversi Game

The Reversi game does not require PHP, MySQL, or Docker.

Open this file directly in a browser:

```text
03-reversi/reversi-game.html
```

### macOS

```bash
open 03-reversi/reversi-game.html
```

### Windows PowerShell

```powershell
Start-Process .\03-reversi\reversi-game.html
```

### Linux

```bash
xdg-open 03-reversi/reversi-game.html
```

The game includes:

- Legal move checking
- Opponent piece flipping in eight directions
- Available move indicators
- Live score display
- Undo function
- Suggested move function
- Automatic pass handling
- Win and draw detection
- Player-versus-player mode
- Player-versus-computer mode

The Vue library is loaded through a CDN, so an internet connection is required when the page is opened.

---

## Environment File Policy

The application reads database settings from `.env`.

Do not upload `.env` to GitHub because it may contain local usernames or passwords. The file is excluded through `.gitignore`.

Upload `.env.example` because it contains safe example values that show reviewers which settings are required.

```text
.env.example   Upload to GitHub
.env           Do not upload to GitHub
```

---

## Upload to GitHub

Create an empty GitHub repository, then run the following commands from the project root.

```bash
git init
git add .
git commit -m "Complete web development assessment"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPOSITORY.git
git push -u origin main
```

Replace `YOUR_USERNAME` and `YOUR_REPOSITORY` with the correct GitHub account and repository name.

Recommended repository name:

```text
web-development-assessment
```

Do not commit `.env`.

---

## Troubleshooting

### `docker: command not found`

Docker is not installed or Docker Desktop is not running. Install and open Docker Desktop, then restart the terminal.

### `php: command not found` or `'php' is not recognized`

PHP is not installed or its installation directory is not included in the system `PATH`.

### `mysql: command not found` or `'mysql' is not recognized`

MySQL is not installed or its `bin` directory is not included in the system `PATH`. MySQL Workbench or phpMyAdmin can also be used to import the SQL file.

### Database connection error

Check that:

- MySQL is running
- `.env` exists in the repository root
- The database name is `todo_app`
- The username and password in `.env` are correct
- The SQL initialization file has been imported

### Port 8080 is already in use

Use another port, for example:

```bash
php -S localhost:8081 -t 02-todo-app/public
```

Then open `http://localhost:8081`.

---

## Technical Notes

The to-do application uses plain object-oriented PHP rather than a full framework. This keeps installation lightweight and makes the CRUD, database, validation, and security logic easy to review.
