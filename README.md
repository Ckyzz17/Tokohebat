<p align="center">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-mark/2%20color/1%20PNG/3%20RGB/1%20Full%20Color/laravel-mark-rgb-red.png" width="120" alt="Code Yoga Logo">
</p>

<h1 align="center">Code Yoga</h1>

<p align="center">
Backend Security Improvement & Vulnerability Remediation Project
</p>

<p align="center">
<a href="#"><img src="https://img.shields.io/badge/Laravel-10-red" alt="Laravel Version"></a>
<a href="#"><img src="https://img.shields.io/badge/PHP-8.2-blue" alt="PHP Version"></a>
<a href="#"><img src="https://img.shields.io/badge/Security-Critical-success" alt="Security Status"></a>
<a href="#"><img src="https://img.shields.io/badge/License-MIT-green" alt="License"></a>
</p>

---

# About Code Yoga

**Code Yoga** adalah project backend Laravel yang berfokus pada proses perbaikan dan hardening keamanan aplikasi dari berbagai vulnerability critical yang sebelumnya ditemukan pada sistem authentication dan authorization.

Project ini dibuat sebagai pembelajaran sekaligus implementasi best practice backend security menggunakan Laravel.

---

# Security Issues Found

Beberapa vulnerability yang ditemukan pada versi awal aplikasi:

- Authentication Bypass
- Privilege Escalation
- Plaintext Password Storage
- Broken Authorization
- Insecure Credential Handling

---

# Vulnerability Analysis

## 1. Authentication Bypass (Login Tanpa Password)

### Vulnerability

Pada versi awal, sistem login hanya memverifikasi email tanpa melakukan validasi password.

### Vulnerable Code

```php
$user = $this->userRepository->findByEmail($request->email);

Auth::login($user);
```

### Dampak

- User dapat login hanya dengan mengetahui email korban
- Account takeover sangat mudah dilakukan
- Data pengguna dapat dicuri
- Akses internal sistem dapat ditembus tanpa autentikasi valid

### Risiko

- Data breach
- Penyalahgunaan akun
- Kerugian bisnis
- Pelanggaran keamanan sistem

### Solusi

Menggunakan autentikasi Laravel yang benar:

```php
Auth::attempt($credentials);
```

---

## 2. Privilege Escalation (Naik Role Menjadi Admin)

### Vulnerability

Role admin diambil langsung dari request parameter.

### Vulnerable Code

```php
if ($request->role !== 'admin')
```

### Dampak

User biasa dapat mengakses panel admin dengan manipulasi URL:

```bash
/admin/dashboard?role=admin
```

### Risiko

- Pengambilalihan admin panel
- Manipulasi data sistem
- Penghapusan data penting
- Full system compromise

### Solusi

Role harus berasal dari user yang telah terautentikasi:

```php
auth()->user()->role
```

Ditambah middleware authorization protection.

---

## 3. Plaintext Password Storage

### Vulnerability

Password disimpan langsung ke database tanpa hashing.

### Vulnerable Code

```php
'password' => $request->password
```

### Dampak

Jika database bocor:

- Seluruh password user dapat langsung dibaca
- Password dapat digunakan ulang di platform lain
- Risiko credential stuffing meningkat drastis

### Risiko

- Mass account takeover
- Identity abuse
- Financial loss
- Compliance violation

### Solusi

Gunakan hashing password Laravel:

```php
Hash::make($password)
```

atau cast bawaan Laravel:

```php
'password' => 'hashed'
```

---

# Security Improvements

Perbaikan keamanan yang diterapkan pada project:

- Secure Authentication using `Auth::attempt()`
- Middleware Authorization
- Role Validation from Database
- Password Hashing
- Laravel Sanctum Authentication
- Secure Session Handling
- Input Validation
- Route Protection

---

# Tech Stack

- Laravel 10
- PHP 8.2
- MySQL
- Laravel Sanctum
- Eloquent ORM

---

# Installation

Clone repository:

```bash
git clone https://github.com/username/code-yoga.git
```

Masuk ke project:

```bash
cd code-yoga
```

Install dependency:

```bash
composer install
```

Copy environment:

```bash
cp .env.example .env
```

Generate app key:

```bash
php artisan key:generate
```

Run migration:

```bash
php artisan migrate
```

Jalankan server:

```bash
php artisan serve
```

---

# Security Conclusion

Ketiga vulnerability utama pada aplikasi termasuk kategori **Critical Vulnerability** karena mempengaruhi:

- Authentication
- Authorization
- Credential Security

Jika dibiarkan di production, aplikasi dapat mengalami:

- Account takeover
- Privilege escalation
- Data breach
- Full system compromise

Dengan implementasi security improvement di atas, aplikasi menjadi lebih aman dan lebih sesuai dengan best practice backend security Laravel.

---

# License

This project is open-sourced software licensed under the MIT license.