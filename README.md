# WEB BLOG
Web Blog is a blog website that created with Laravel 8 and VueJS 2. Single Page Application (SPA) using Vue JS only on admin dashboard. Laravel is used to display published posts.

# Dashboard (VueJS)
![image](https://user-images.githubusercontent.com/56705867/174574008-5e617b4a-de81-4d91-ad35-2dcea1d4e6f7.png)

# List of Posts (Laravel Blade)
![image](https://user-images.githubusercontent.com/56705867/174574133-85352560-46c1-49b4-8c53-f8414672f35b.png)

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

### 3.1. Add this code to .env (Auth)
```bash
SANCTUM_STATEFUL_DOMAINS=localhost:8000
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
