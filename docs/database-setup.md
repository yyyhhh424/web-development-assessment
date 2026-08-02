# Database Setup

## Environment variables

The application reads the following variables:

| Variable | Purpose | Docker example | Local example |
|---|---|---|---|
| `DB_HOST` | MySQL host | `db` | `127.0.0.1` |
| `DB_PORT` | MySQL port | `3306` | `3306` |
| `DB_DATABASE` | Database name | `todo_app` | `todo_app` |
| `DB_USERNAME` | Database user | `todo_user` | `root` |
| `DB_PASSWORD` | Database password | `todo_password` | local password |
| `DB_ROOT_PASSWORD` | Docker MySQL root password | `root_password` | not required by PHP |

## Docker setup

```bash
cp .env.example .env
docker compose up --build
```

Docker imports `02-todo-app/sql/001_create_tasks.sql` automatically when the MySQL volume is created for the first time.

## Local MySQL setup

```bash
mysql -u root -p < 02-todo-app/sql/001_create_tasks.sql
cp .env.example .env
```

Change `DB_HOST` from `db` to `127.0.0.1` and enter the local MySQL username and password.

Then run:

```bash
php -S localhost:8080 -t 02-todo-app/public
```
