# 🧩 Item Manager – Coding Challenge

A simple Item Manager built with Laravel 12, Vue 3, Inertia.js, Spatie MediaLibrary, TinyMCE.

## 🚀 Features

- Authenticated item listing with **infinite scroll**
- Item creation with:
  - Title
  - WYSIWYG editor (TinyMCE)
  - Image upload (Spatie Laravel MediaLibrary)
- Edit and update existing items
- Delete items with confirmation

## 🛠 Tech Stack

- Laravel 12 (PHP 8.2+)
- Vue.js 3 (Composition API)
- Inertia.js
- Vite
- Spatie Laravel MediaLibrary
- TinyMCE (via Tiny Cloud)

## 📦 Installation

```bash
git clone https://github.com/your-username/item-manager.git
cd item-manager

composer install
npm install

cp .env.example .env
php artisan key:generate
```

### 🔧 Configure `.env`

Set your database credentials and app URL:

```
APP_URL=http://localhost:8000
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_pass
```

### 🧪 Database Setup

```bash
php artisan migrate --seed
php artisan storage:link
```

> ☑️ Seeds include fake items with images

## 🖼 Image Upload

- Uses Spatie Laravel MediaLibrary
- Images are stored in `storage/app/public`
- Accessed via `/storage` using `php artisan storage:link`

## ✍️ WYSIWYG Editor

- Integrated [TinyMCE](https://www.tiny.cloud) with your own Tiny Cloud API key
- Supports formatting, links, media, etc.

## 📌 Assumptions & Decisions

- Used the provided starter template with Laravel 12 + Inertia
- Used Spatie MediaLibrary for flexible file handling
- TinyMCE chosen for ease of integration and customization
- Focused on functionality and clean code over UI complexity

## 🚧 What I’d Improve with More Time

- Dockerize the app for consistent local development
- Use DDD architecture
- Concentrate more on the design and user experience
- Fully utilize Bootstrap 5 for responsive layout and better UI
- Add frontend validation + form error styling
- Improve mobile responsiveness
- Add soft deletes and trash recovery
- Implement modal-based edit/delete
- Polish UI to match [Qualified Design Style](https://app.qualified.technology)

## ✅ To Run Locally

```bash
php artisan serve
npm run dev
```

Visit: [http://localhost:8000](http://localhost:8000)

---

## 📬 Submission

This project was created as part of the Qualified Full Stack Developer Challenge.  
Feel free to contact me if you'd like a walkthrough of the code or decisions made.
