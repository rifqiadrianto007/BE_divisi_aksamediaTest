# Aksamedia Backend Test API

## Overview

Aksamedia Backend Test API adalah REST API yang dibuat menggunakan
Laravel 12 untuk memenuhi tech test Backend Developer Intern di PT
Aksamedia Mulia Digital. API ini menyediakan fitur autentikasi,
manajemen divisi dan karyawan, serta perhitungan nilai RT dan ST
menggunakan SQL aggregation sesuai requirement.

API menggunakan Laravel Sanctum untuk autentikasi berbasis token dan
MySQL sebagai database utama.

------------------------------------------------------------------------

## Tech Stack

-   Laravel 12
-   PHP 8+
-   MySQL / phpMyAdmin
-   Laravel Sanctum
-   Eloquent ORM
-   Raw SQL Query

------------------------------------------------------------------------

## Setup Project

### 1. Clone repository

git clone https://github.com/USERNAME/aksamedia-backend.git

### 2. Masuk ke folder project

cd aksamedia-backend

### 3. Install dependencies

composer install

### 4. Copy file environment

cp .env.example .env

### 5. Generate application key

php artisan key:generate

### 6. Jalankan migration dan seeder

php artisan migrate --seed

### 7. Import file nilai.sql

Import file nilai.sql ke database menggunakan phpMyAdmin atau HeidiSQL.

### 8. Link storage untuk upload file

php artisan storage:link

### 9. Jalankan server

php artisan serve

API akan berjalan di:

http://127.0.0.1:8000

------------------------------------------------------------------------

## Authentication

API menggunakan Bearer Token (Laravel Sanctum)

Gunakan header:

Authorization: Bearer {token}

------------------------------------------------------------------------

## Default Login Credential

username: admin 

password: pastibisa

------------------------------------------------------------------------

## Fitur Utama

Authentication - Login - Logout - Token based authentication menggunakan
Sanctum

Divisions - Get all divisions - Filter divisions - Pagination

Employees - Get all employees - Create employee - Update employee -
Delete employee - Upload image - Relasi division

------------------------------------------------------------------------

## API Documentation

Base URL:

http://127.0.0.1:8000/api

------------------------------------------------------------------------

### Login

POST /login

Request:

{ 
    "username": "admin", 
    "password": "pastibisa" 
}

------------------------------------------------------------------------

### Logout

POST /logout

Header:

Authorization: Bearer token

------------------------------------------------------------------------

### Get Divisions

GET /divisions

Filter:

GET /divisions?name=Backend

------------------------------------------------------------------------

### Get Employees

GET /employees

Filter:

GET /employees?name=John 

GET /employees?division_id=uuid

------------------------------------------------------------------------

### Create Employee

POST /employees

Body (form-data):

image: file name: string phone: string division: uuid position: string

------------------------------------------------------------------------

### Update Employee

PUT /employees/{uuid}

Body (form-data):

image: file name: string phone: string division: uuid position: string

------------------------------------------------------------------------

### Delete Employee

DELETE /employees/{uuid}

------------------------------------------------------------------------

### Nilai RT

GET /nilaiRT

Deskripsi: Menghitung nilai RT menggunakan SQL aggregation berdasarkan
materi_uji_id 7.

------------------------------------------------------------------------

### Nilai ST

GET /nilaiST

Deskripsi: Menghitung nilai ST menggunakan SQL aggregation berdasarkan
materi_uji_id 4 dengan multiplier sesuai requirement.

------------------------------------------------------------------------

## Author

Nama: Rifqi Adrianto

Github: https://github.com/rifqiadrianto007
