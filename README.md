<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## 🕸 Laravel App – `README.md`

```markdown
# Blockchain Voting System – Laravel (Off-Chain Management)

This Laravel app handles the off-chain part of a blockchain voting system using Hyperledger Fabric. It manages users, TPS registration, and interfaces with the blockchain via REST.

## 📁 Features

- Admin panel to manage:
  - Users
  - TPS
- Voter dashboard:
  - View TPS assignment
  - Cast vote (one-time)
- Blockchain Integration via HTTP:
  - Register TPS and users
  - Record vote on blockchain
  - Sync vote result summary

## 🛠️ Setup

### 1. Clone the Repository

```bash
git clone <your-laravel-repo-url>
cd <your-laravel-folder>
````

### 2. Install Dependencies

```bash
composer install
npm install && npm run dev
```

### 3. Configure Environment

Copy `.env.example` to `.env` and update DB credentials.

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Migrate & Seed

```bash
php artisan migrate
php artisan db:seed
```

This will also make HTTP requests to register TPS and users on the blockchain via:

* `/api/assets` – for each TPS
* `/api/register` – for each voter

### 5. Run the App

```bash
php artisan serve
```

App available at: [http://localhost:8000](http://localhost:8000)

## 👥 User Roles

* **Admin**: Can create TPS and assign voters
* **Voter**: Can log in and cast vote once

## 🌐 Routes Overview

| Route        | Role  | Description            |
| ------------ | ----- | ---------------------- |
| `/login`     | All   | Login screen           |
| `/dashboard` | Voter | Cast vote + see status |
| `/users`     | Admin | Manage users           |
| `/tps`       | Admin | Manage TPS             |

## 📡 Blockchain Communication

Laravel uses `Http::post()` to call endpoints from Hyperledger REST API:

* Cast vote
* Register users
* Send summarized vote results

See `VoteController`, `UserSeeder`, and `TpsSeeder` for usage.

## 📌 Notes

* Users are manually seeded; there’s no public registration.
* `nik` is used as blockchain user ID.
* Votes are marked on both DB and blockchain for syncing.
* No vote contents are stored, only participation and counts.
