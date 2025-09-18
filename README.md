<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="#"><img src="https://img.shields.io/badge/Project-Booking%20System-blue" alt="Project"></a>
<a href="#"><img src="https://img.shields.io/badge/Laravel-12-red" alt="Laravel"></a>
<a href="#"><img src="https://img.shields.io/badge/Database-MySQL-green" alt="Database"></a>
</p>

# 🏥 Booking System API

هذا مشروع **Laravel API** لإدارة الحجوزات بين **Clients** و **Specialists**.  
يدعم تسجيل الدخول والتسجيل، إدارة الخدمات (Services)، وإنشاء وإدارة الحجوزات (Bookings).

---

## 🚀 خطوات تشغيل المشروع

1. **انسخ المشروع**
```bash
git clone https://github.com/nada-khaled30/booking_system.git
cd booking_system
````

2. **ثبت الـ dependencies**

```bash
composer install
npm install && npm run dev
```

3. **انسخ ملف البيئة**

```bash
cp .env.example .env
```

4. **عدل إعدادات قاعدة البيانات** في `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **شغل الـ migrations**

```bash
php artisan migrate
```

6. **شغل السيرفر**

```bash
php artisan serve
```

المشروع هيشتغل على:
👉 [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🔑 Authentication

المشروع يستخدم **Laravel Sanctum**.
بعد التسجيل أو تسجيل الدخول، خدي الـ token واستخدميه في كل request في الـ Header بالشكل التالي:

```
Authorization: Bearer <YOUR_TOKEN>
```

---

## 📌 Endpoints

### 🧑‍💻 Auth

#### Register

`POST /api/register`

**Request**

```json
{
  "name": "Ahmed Ali",
  "email": "ahmed@example.com",
  "password": "123456",
  "role": "client"
}
```

**Response**

```json
{
  "user": {
    "id": 1,
    "name": "Ahmed Ali",
    "email": "ahmed@example.com",
    "role": "client"
  },
  "token": "1|XyZAbC..."
}
```

#### Login

`POST /api/login`

**Request**

```json
{
  "email": "ahmed@example.com",
  "password": "123456"
}
```

**Response**

```json
{
  "user": {
    "id": 1,
    "name": "Ahmed Ali",
    "email": "ahmed@example.com",
    "role": "client"
  },
  "token": "1|XyZAbC..."
}
```

---

### ⚙️ Services

#### Get All Services

`GET /api/services`

**Response**

```json
[
  {
    "id": 1,
    "name": "General Checkup",
    "price": 200,
    "specialist": {
      "id": 1,
      "specialization": "General",
      "user": {
        "id": 2,
        "name": "Dr. Mohamed"
      }
    }
  }
]
```

#### Create Service (Specialist only)

`POST /api/services`

**Request**

```json
{
  "name": "Dental Cleaning",
  "price": 300
}
```

**Response**

```json
{
  "id": 2,
  "name": "Dental Cleaning",
  "price": 300,
  "specialist_id": 1
}
```

#### Update Service

`PUT /api/services/{id}`

**Request**

```json
{
  "name": "Dental Cleaning - Updated",
  "price": 350
}
```

**Response**

```json
{
  "id": 2,
  "name": "Dental Cleaning - Updated",
  "price": 350
}
```

#### Delete Service

`DELETE /api/services/{id}`

**Response**

```json
{
  "message": "Service deleted"
}
```

---

### 📅 Bookings

#### Create Booking

`POST /api/bookings`

**Request**

```json
{
  "service_id": 1,
  "booking_time": "2025-09-20 14:00:00"
}
```

**Response**

```json
{
  "id": 1,
  "client_id": 1,
  "service_id": 1,
  "booking_time": "2025-09-20 14:00:00"
}
```

#### Update Booking

`PUT /api/bookings/{id}`

**Request**

```json
{
  "booking_time": "2025-09-21 10:00:00"
}
```

**Response**

```json
{
  "id": 1,
  "client_id": 1,
  "service_id": 1,
  "booking_time": "2025-09-21 10:00:00"
}
```

#### Delete Booking

`DELETE /api/bookings/{id}`

**Response**

```json
{
  "message": "Booking canceled"
}
```

#### My Bookings (Client)

`GET /api/my-bookings`

**Response**

```json
[
  {
    "id": 1,
    "booking_time": "2025-09-20 14:00:00",
    "service": {
      "id": 1,
      "name": "General Checkup"
    }
  }
]
```

#### Specialist Bookings

`GET /api/specialist-bookings`

**Response**

```json
[
  {
    "id": 1,
    "booking_time": "2025-09-20 14:00:00",
    "service": {
      "id": 1,
      "name": "General Checkup"
    }
  }
]
```

---

## ✅ Roles

* **Client** → يعمل حجز ويشوف حجوزاته فقط.
* **Specialist** → يضيف/يعدل/يحذف خدماته + يشوف الحجوزات اللي عنده.

---

## 🛠️ Tools

* **Laravel 12**
* **Laravel Sanctum** (Auth)
* **MySQL**
