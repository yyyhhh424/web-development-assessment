# PHP/MySQL To-do Task List

An object-oriented PHP CRUD application using PDO and MySQL.

## Features

- Create a task
- Display all tasks
- Edit task title, description, due date, priority, and status
- Delete a task
- Mark a task complete or reopen it
- Filter pending and completed tasks
- Server-side validation
- Prepared SQL statements
- CSRF protection
- Responsive interface

## Run with Docker

From the repository root:

```bash
cp .env.example .env
docker compose up --build
```

Open `http://localhost:8080`.

MySQL is exposed on host port `3307` for optional database-client access.

## Run without Docker

From the repository root:

```bash
mysql -u root -p < 02-todo-app/sql/001_create_tasks.sql
cp .env.example .env
```

Edit `.env` and use `DB_HOST=127.0.0.1`, then run:

```bash
php -S localhost:8080 -t 02-todo-app/public
```

Open `http://localhost:8080`.

## Reset the Docker database

```bash
docker compose down -v
docker compose up --build
```
