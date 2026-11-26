<div align="center">

# 💈 Barberly

**A full salon & barbershop platform — business portal, customer marketplace and booking engine in one Laravel + Vue 3 app.**

![Laravel](https://img.shields.io/badge/Laravel_10-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Vue.js](https://img.shields.io/badge/Vue_3-4FC08D?style=for-the-badge&logo=vuedotjs&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap_5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Sass](https://img.shields.io/badge/Sass-CC6699?style=for-the-badge&logo=sass&logoColor=white)

</div>

## 🧭 Overview

Barberly is split into three single-page apps that share one Laravel API:

| App | Who it's for | What it does |
| --- | --- | --- |
| **Business Portal** | Salon owners & staff | Bookings, calendar, services, team, customers, memberships, deals, dashboard |
| **Customer Portal** | Clients | Discover salons, book appointments, favorites, gift cards, memberships, orders |
| **Auth Portal** | Everyone | Registration, login, email/OTP verification, password reset, team invitations |

## ✨ Features

**Business portal**
- 📅 Booking calendar with day, week, list and **resource timeline** views (FullCalendar), drag-and-drop scheduling
- ✂️ Service catalogue with categories and resources (chairs, rooms)
- 👥 Team management and staff invitations
- 🧾 Customer CRM, memberships and promotional deals
- 🏪 Public marketplace profile for each business
- 📊 Dashboard with key business metrics

**Customer portal**
- 🔎 Salon marketplace with profiles, services and pricing
- 🗓️ Appointment booking and history
- ❤️ Favorites, 🎁 gift cards, 💳 memberships and orders
- 📍 Address management with Google Places autocomplete

**Platform**
- 🔐 Token auth with Laravel Sanctum, OTP email verification
- 🖼️ Media uploads with image processing (Intervention Image)
- 🧱 Repository pattern on the API layer for clean, testable controllers

## 🛠️ Tech Stack

| Layer | Tools |
| --- | --- |
| Backend | PHP 8.1+, Laravel 10, Laravel Sanctum, Intervention Image, MySQL |
| Frontend | Vue 3, Vue Router, Axios, FullCalendar, Flatpickr, Splide, AOS |
| Styling | Bootstrap 5, Sass |
| Tooling | Vite, Laravel Vite Plugin |

## 🚀 Getting Started

```bash
git clone https://github.com/asadullahchowdhury/barberly.git
cd barberly

composer install
npm install

cp .env.example .env
php artisan key:generate
# set DB_* values (and a Google Maps key if you need address autocomplete)
php artisan migrate --seed
php artisan storage:link

npm run dev
php artisan serve   # http://127.0.0.1:8000
```

## 👤 Author

**Rahat Chowdhury** — Full-Stack Developer
[Portfolio](https://rahat-chowdhury.vercel.app) · [LinkedIn](https://www.linkedin.com/in/chowdhuryrahat) · [GitHub](https://github.com/asadullahchowdhury)
