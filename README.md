<p align="center"><img src="./public/img/cooklens-app.png" width="200" alt="CookLens Logo" style="background: white;"></p>

# CookLens

**Ubah Bahan Makanan Menjadi Masakan Lezat**

CookLens adalah aplikasi web berbasis AI yang dapat mengidentifikasi bahan makanan dari foto yang diunggah dan memberikan rekomendasi resep masakan yang sesuai. Cukup foto bahan yang ada di dapur, biarkan AI bekerja, dan dapatkan inspirasi resep dalam hitungan detik.

## Tech Stack

- **Framework**: Laravel 12, PHP 8.2
- **Database**: MySQL
- **AI**: Google Gemini AI (`google-gemini-php/laravel`)
- **Image Hosting**: Cloudinary (`cloudinary-labs/cloudinary-laravel`)
- **Frontend**: Tailwind CSS v4, Vite
- **Icons**: Blade Heroicons, Blade Remix Icon, Blade Hugeicons
- **Testing**: Pest PHP 3 + PHPUnit 11
- **Dev Tools**: Laravel Sail, Laravel Boost, Laravel Pail, Laravel Pint

## Fitur Utama

| Fitur                      | Detail                                                                             |
| -------------------------- | ---------------------------------------------------------------------------------- |
| 🧠 **AI Food Recognition** | Google Gemini AI mengidentifikasi bahan makanan dari foto                          |
| 📋 **Rekomendasi Resep**   | Hingga 3 resep lengkap dengan match %, difficulty, cooking time, dan langkah masak |
| 📤 **Upload Fleksibel**    | Drag-and-drop, file picker, atau kamera perangkat langsung                         |
| 👁️ **Pratinjau Gambar**    | Melihat gambar sebelum analisis diproses                                           |
| 📚 **Riwayat Analisis**    | Semua analisis tersimpan, dilengkapi pencarian dan filter favorit                  |
| ⭐ **Manajemen Favorit**   | Tandai analisis favorit untuk akses cepat                                          |
| 📱 **Responsif**           | Tampilan optimal di desktop, tablet, maupun mobile                                 |
| ☁️ **Cloudinary**          | Gambar otomatis dihosting di Cloudinary                                            |

## Arsitektur Aplikasi

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php          # Login, register, logout
│   │   │   ├── AnalysisController.php      # CRUD analisis + rekomendasi
│   │   │   └── DashboardController.php     # Halaman utama
│   │   └── Requests/
│   │       ├── Auth/
│   │       │   ├── LoginRequest.php
│   │       │   └── RegisterRequest.php
│   │       └── Analysis/
│   │           └── StoreAnalysisRequest.php # Validasi upload gambar
│   ├── Models/
│   │   ├── User.php
│   │   ├── Analysis.php
│   │   └── RecipeRecommendation.php
│   └── Services/
│       └── GeminiService.php               # Integrasi Google Gemini AI
├── bootstrap/
│   └── app.php                             # Middleware, routing config
├── config/
│   ├── cloudinary.php
│   ├── gemini.php
│   └── ...
├── database/
│   └── migrations/                         # 7 file migrasi
├── resources/
│   └── views/
│       ├── auth/                           # login.blade.php, register.blade.php
│       ├── analisis/                       # index.blade.php, detail.blade.php
│       ├── components/                     # alert, modal, pagination, input-error
│       ├── layouts/                        # app.blade.php, auth.blade.php
│       ├── dashboard.blade.php
│       ├── riwayat.blade.php
│       └── welcome.blade.php
├── routes/
│   ├── web.php                             # Semua route aplikasi
│   └── console.php
└── public/
    └── img/                                # cooklens-app.png, hero.png, examp.jpg
```

## Database Schema

### Entity Relationship

```
users ──1:N──> analyses ──1:N──> recipe_recommendations
```

### Tables

**users**
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint unsigned | Primary Key |
| name | varchar(255) | Nama lengkap |
| email | varchar(255) | Email (unique) |
| password | varchar(255) | Hashed password |
| remember_token | varchar(100) | Remember me |

**analyses**
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint unsigned | Primary Key |
| user_id | bigint unsigned | Foreign Key → users |
| image_path | varchar(255) | Cloudinary URL |
| image_public_id | varchar(255) | Cloudinary public ID |
| detected_ingredients | json | Array bahan terdeteksi |
| is_favorite | tinyint(1) | Status favorit |
| created_at | timestamp | |
| updated_at | timestamp | |

**recipe_recommendations**
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint unsigned | Primary Key |
| analysis_id | bigint unsigned | Foreign Key → analyses |
| recipe_name | varchar(255) | Nama resep |
| match_percentage | int unsigned | 0–100 |
| cooking_time | int unsigned | Estimasi waktu (menit) |
| difficulty | varchar(255) | Mudah / Sedang / Sulit |
| reason | text | Alasan rekomendasi |
| recipe_data | json | {ingredients: [...], steps: [...]} |
| created_at | timestamp | |
| updated_at | timestamp | |

## Routes

| Method | URI                            | Controller                        | Middleware                 | Nama Route         |
| ------ | ------------------------------ | --------------------------------- | -------------------------- | ------------------ |
| GET    | `/`                            | —                                 | guest → redirect dashboard | `welcome`          |
| GET    | `/register`                    | AuthController@showRegisterForm   | guest                      | `register`         |
| GET    | `/login`                       | AuthController@showLoginForm      | guest                      | `login`            |
| POST   | `/login`                       | AuthController@login              | guest                      | —                  |
| POST   | `/register`                    | AuthController@register           | guest                      | —                  |
| GET    | `/dashboard`                   | DashboardController@index         | auth                       | `dashboard`        |
| GET    | `/analisis`                    | AnalysisController@index          | auth                       | `analisis`         |
| POST   | `/analisis`                    | AnalysisController@store          | auth                       | `analisis.store`   |
| GET    | `/riwayat`                     | AnalysisController@history        | auth                       | `riwayat`          |
| GET    | `/riwayat/{analysis}`          | AnalysisController@show           | auth                       | `riwayat.show`     |
| DELETE | `/riwayat/{analysis}`          | AnalysisController@destroy        | auth                       | `riwayat.destroy`  |
| PATCH  | `/riwayat/{analysis}/favorite` | AnalysisController@toggleFavorite | auth                       | `riwayat.favorite` |
| POST   | `/logout`                      | AuthController@logout             | auth                       | `logout`           |

## Alur Analisis

```
User Upload Gambar
       │
       ▼
   Cloudinary (upload & hosting)
       │
       ▼
   Gemini AI (analisis bahan & rekomendasi resep)
       │
       ▼
   Simpan ke Database (Analysis + RecipeRecommendation)
       │
       ▼
   Tampilkan Hasil (bahan terdeteksi + rekomendasi resep)
```

### Detail Proses

1. **Upload**: User memilih gambar via drag-and-drop, file picker, atau kamera
2. **Pratinjau**: Gambar ditampilkan sebelum dikirim
3. **Cloudinary**: Gambar diupload ke Cloudinary dengan folder `cooklens/analysis/{user_id}`
4. **Gemini AI**: Gambar dikirim ke Google Gemini (`gemini-3.5-flash`) dengan prompt JSON untuk mendeteksi bahan dan merekomendasikan resep
5. **Validasi**: Jika AI tidak mendeteksi bahan makanan, gambar Cloudinary dihapus dan user diberi notifikasi
6. **Penyimpanan**: Analysis + RecipeRecommendation disimpan ke database
7. **Tampilan**: Hasil ditampilkan dengan detail resep (bahan, langkah, tingkat kesulitan, waktu masak)

## Prasyarat

- PHP **^8.2**
- Composer **^2**
- Node.js **^18** + npm
- MySQL **^8.0**
- Akun [Cloudinary](https://cloudinary.com/) (free tier cukup)
- API Key [Google Gemini](https://ai.google.dev/)

## Instalasi

### 1. Clone Repository

```bash
git clone <repository-url> cooklens-app
cd cooklens-app
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database

Edit `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cooklens
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Konfigurasi Cloudinary

Dapatkan `CLOUDINARY_URL` dari [Dashboard Cloudinary](https://cloudinary.com/console):

```env
CLOUDINARY_URL=cloudinary://api_key:api_secret@cloud_name
```

### 6. Konfigurasi Gemini AI

Dapatkan API key dari [Google AI Studio](https://aistudio.google.com/):

```env
GEMINI_API_KEY=your_gemini_api_key_here
```

### 7. Environment Variables Lengkap

```env
APP_NAME=CookLens
APP_ENV=local
APP_DEBUG=true
APP_URL=http://cooklens-app.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cooklens
DB_USERNAME=root
DB_PASSWORD=

CLOUDINARY_URL=cloudinary://api_key:api_secret@cloud_name

GEMINI_API_KEY=your_gemini_api_key_here

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
```

### 8. Migrasi Database

```bash
php artisan migrate
```

### 9. Install & Build Frontend

```bash
npm install
npm run build
```

### 10. Selesai

Akses aplikasi di `http://cooklens-app.test` atau sesuai URL lokal Anda.

## Perintah yang Tersedia

### Development

```bash
# Jalankan dev server, queue worker, dan Vite secara bersamaan
composer run dev

# Atau masing-masing:
php artisan serve
php artisan queue:listen --tries=1 --timeout=0
npm run dev
```

### Build Frontend

```bash
npm run build
```

### Testing

```bash
composer run test
# atau
php artisan test --compact
# filter test tertentu:
php artisan test --compact --filter=nama_test
```

### Setup Fresh

```bash
composer run setup
```

### Code Formatting

```bash
vendor/bin/pint --format agent
```

## Error Handling

Aplikasi menangani beberapa skenario error:

- **AI Server Sibuk / Rate Limit**: Menampilkan pesan "Server AI sedang sibuk atau batas penggunaan harian telah tercapai"
- **Timeout**: Menampilkan pesan "Proses analisis terlalu lama"
- **Bukan Makanan**: Jika AI tidak mendeteksi bahan makanan, gambar dihapus dari Cloudinary dan user diberi notifikasi
- **Validasi Gambar**: Format file, ukuran (max 5MB), dan tipe (image/\*) divalidasi

## Testing

Framework testing menggunakan **Pest 3**. Test files:

```
tests/
├── Feature/
│   └── ExampleTest.php
├── Unit/
│   └── ExampleTest.php
├── Pest.php
└── TestCase.php
```

## License

CookLens is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---
