# WEB BLOG
Web Blog is a blog website that created with Laravel 8 and VueJS 2. Single Page Application (SPA) using Vue JS only on admin dashboard. Laravel is used to display published posts.

# Dashboard (VueJS)
![Web capture_30-5-2022_171211_127 0 0 1](https://user-images.githubusercontent.com/56705867/170962072-ffb3bae8-58ea-4297-ab84-be7a8326107f.jpeg)

# List of Posts (Laravel Blade)
![Web capture_30-5-2022_171143_127 0 0 1](https://user-images.githubusercontent.com/56705867/170962089-a04da9cc-2bf7-4402-81e7-da92fa2f196e.jpeg)

# INSTALLING

### 1. Clone this repo
```bash
git clone https://github.com/hairullana/web-blog
```

### 2. Change directory
```bash
cd web-blog
```

### 3. Create and `Setup` .env file (DB)
```bash
cp .env.example .env
```

### 4. Generate key
```bash
php artisan key:generate
```

### 5. Migrate database
```bash
php artisan migrate:fresh --seed
```

### 6. Install Composer
```bash
composer install
```

### 7. Install Node Package
```bash
npm install
```

### 7. Storage Link
```bash
php artisan storage:link
```

### 8. Run Laraver Server
```bash
php artisan serve
```

### 9. Combine Vue Component & Other Javascript Files (optional if you want to update VueJS)
```bash
npm run watch
```