Web Developer Technical Assessment

This repository contains three assessment tasks:

An Entity Relationship Diagram for an e-commerce system

A PHP/MySQL to-do list application with CRUD actions

A completed browser-based Reversi game

Repository Structure

.
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
│   └── README.md
├── 03-reversi/
│   ├── reversi-game.html
│   └── README.md
├── docs/
│   ├── assessment-requirements.md
│   └── database-setup.md
├── .env.example
├── .gitignore
└── README.md

Task 1: E-commerce ERD

The e-commerce database design includes the following main entities:

Customers

Customer addresses

Categories

Products

Orders

Order items

Payments

Shipments

Product reviews

The ERD image is located at:

01-erd/ecommerce-erd.png

The MySQL database schema is located at:

01-erd/ecommerce-schema.sql

To import the e-commerce schema into MySQL:

mysql -u root -p < 01-erd/ecommerce-schema.sql

Task 2: PHP/MySQL To-do List

Features

Create a new task

View all tasks

Edit an existing task

Delete a task

Mark a task as completed

Reopen a completed task

Filter tasks by status

Server-side form validation

PDO prepared statements

CSRF protection

Escaped output to reduce XSS risk

Responsive user interface

Running the To-do Application Without Docker

Requirements

Install the following software before running the application:

PHP 8.1 or later

MySQL 8 or later

PHP PDO MySQL extension

macOS Installation

The following instructions use Homebrew.

Check whether Homebrew is installed:

brew --version

Install PHP and MySQL:

brew install php mysql

Start the MySQL service:

brew services start mysql

Check that PHP and MySQL are available:

php -v
mysql --version

Step 1: Open the Project Folder

Open Terminal and go to the repository folder:

cd ~/Downloads/ecommerce-assessment

Change the path if the project is stored in another folder.

Confirm that the project files are present:

ls

You should see folders such as:

01-erd
02-todo-app
03-reversi

Step 2: Start MySQL

Start MySQL if it is not already running:

brew services start mysql

Test the MySQL connection:

mysql -u root

If the MySQL root account has a password, use:

mysql -u root -p

Type the following command to exit MySQL:

exit;

Step 3: Create the To-do Database

From the repository root, run:

mysql -u root -p < 02-todo-app/sql/001_create_tasks.sql

If the MySQL root account does not have a password, run:

mysql -u root < 02-todo-app/sql/001_create_tasks.sql

The SQL file creates the database and the tasks table required by the application.

Step 4: Create the Environment File

Copy the example environment file:

cp .env.example .env

Open .env using a text editor:

open -e .env

Set the local MySQL details:

DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_app
DB_USERNAME=root
DB_PASSWORD=

If the MySQL root account has a password, enter it after DB_PASSWORD=:

DB_PASSWORD=your_mysql_password

Save the file after editing it.

Step 5: Start the PHP Development Server

From the repository root, run:

php -S localhost:8080 -t 02-todo-app/public

A successful start should display a message similar to:

PHP Development Server started at http://localhost:8080

Keep the Terminal window open while using the application.

Step 6: Open the Application

Open the following address in a browser:

http://localhost:8080

Stop the Application

Return to the Terminal window running the PHP server and press:

Control + C

Start the Application Again

The database only needs to be imported once. For later runs:

cd ~/Downloads/ecommerce-assessment
brew services start mysql
php -S localhost:8080 -t 02-todo-app/public

Then open:

http://localhost:8080

Common Problems

zsh: command not found: php

Install PHP:

brew install php

Close and reopen Terminal, then check:

php -v

zsh: command not found: mysql

Install MySQL:

brew install mysql

Then start it:

brew services start mysql

Connection refused or SQLSTATE[HY000] [2002]

Make sure MySQL is running:

brew services start mysql

Check the service status:

brew services list

Access denied for user 'root'

The username or password in .env does not match the local MySQL account. Update these values:

DB_USERNAME=root
DB_PASSWORD=your_mysql_password

Unknown database 'todo_app'

Import the database again:

mysql -u root -p < 02-todo-app/sql/001_create_tasks.sql

Port 8080 is already in use

Use another port, for example 8081:

php -S localhost:8081 -t 02-todo-app/public

Then open:

http://localhost:8081

Task 3: Reversi Game

The Reversi game does not require PHP or MySQL.

Open it directly from Terminal:

cd ~/Downloads/ecommerce-assessment
open 03-reversi/reversi-game.html

It can also be opened by double-clicking this file in Finder:

03-reversi/reversi-game.html

The game includes:

Legal move validation

Opponent piece flipping

Victory detection

Draw detection

Available move indicators

Live score display

Undo function

Suggested move function

Player-versus-player mode

Player-versus-computer mode

Automatic pass handling when no valid move is available

The Vue library is loaded from a CDN, so an internet connection is required when opening the game.

Environment File Policy

The .env file contains local database credentials and must not be uploaded to GitHub.

The repository includes:

.env.example

Each user should copy it locally:

cp .env.example .env

The .gitignore file excludes .env from Git tracking.

Before uploading the repository, confirm that .env is not being tracked:

git status

Do not use this command:

git add -f .env

Uploading to GitHub

Create an empty GitHub repository, then run the following commands from the project folder:

git init
git add .
git commit -m "Complete web developer technical assessment"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPOSITORY.git
git push -u origin main

Replace the repository address with the actual GitHub repository URL.

Technology Used

PHP

MySQL

PDO

HTML

CSS

JavaScript

Vue.js

Mermaid ERD syntax

Security Considerations

The to-do application uses:

PDO prepared statements for database queries

CSRF tokens for form submissions

Server-side validation

HTML output escaping

Environment variables for database credentials

Assessment Notes

The PHP/MySQL task is implemented using structured plain PHP instead of a full PHP framework. The project separates configuration, database access, repository logic, views, and the public entry point to keep the code clear and easy to review.
