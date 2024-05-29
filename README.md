<p align="center"><a href="https://banking-system.bdshopexpress.com" target="_blank"><img src="https://banking-system.bdshopexpress.com/banking-system.png" width="400" alt="Banking Software Demo"></a></p>

## About Banking System Project

Welcome to the Banking Deposit and Withdrawal System! This project is developed using Laravel, a powerful PHP framework, to manage banking transactions with various conditions.

## Table of Contents

- [Objective](#Objective)
- [Features](#features)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)

## Objective:

This system provides a robust platform for handling deposits and withdrawals in a banking context. It supports multiple conditions such as minimum and maximum transaction limits, daily transaction limits, and user authentication. This project aims to provide a secure and efficient way to manage banking transactions.

## Features

- User Authentication
- Deposit and Withdrawal Handling
- Transaction Limits
- Daily Transaction Limits
- Transaction History
- Admin Dashboard


## Installation

### Prerequisites

- PHP >= 8.2
- Composer
- MySQL
- Node.js & NPM

### Steps

1. **Clone the repository**
   ```sh
    git clone https://github.com/Md-Tohin/Banking-System.git
    cd Banking-System

2. **Install dependencies**
   ```sh
    composer install
    npm install
    npm run dev

3. **Set up environment variables**
    Copy the .env.example file to .env and configure your database and other settings.

    ```sh
    cp .env.example .env

4. **Generate application key**
   ```sh
    php artisan key:generate

5. **Run database migrations and seeders**
   ```sh
    php artisan migrate --seed

6. **Start the development server**
   ```sh
    php artisan serve


## Configuration

### Environment Variables

- Database Configuration
   ```sh
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password

- Mail Configuration (Optional for notifications)
   ```sh
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS="hello@example.com"
    MAIL_FROM_NAME="${APP_NAME}"


## Usage

### User Registration and Login

1. **Register a new user by navigating to /register.**
2. **Log in with your credentials at /login.**

### Managing Transactions

1. **Dashboard: Navigate to /dashboard short overview Deposit and Withdrawal.**
2. **Deposit: Navigate to /deposit and fill out the form to make a deposit.**
3. **Withdrawal: Navigate to /withdrawal/add and fill out the form to make a withdrawal.**
3. **Withdrawal History: Navigate to /withdrawal/list and see the withdrawal history.**

## Developed By
<a href="https://mdtohin.bdshopexpress.com" target="_blank"><img src="https://mdtohin.bdshopexpress.com/assets/frontend/images/hero.jpg" width="90" height="120" alt="Md. Tohin"></a>

<p align="center">Md. Tohin</p>


### Thank You


