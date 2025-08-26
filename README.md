# Bookstore Application

A modern Laravel-based bookstore application with an admin panel, featuring book management, categories, and integration with the Google Books API.

## Prerequisites

- PHP &gt;= 8.1
- Composer
- MySQL
- Git

## Installation

Follow these steps to set up the project locally:

1. **Clone the Repository**

   ```bash
   git clone https://github.com/Abusalba/bookstore.git
   cd bookstore
   ```

2. **Install PHP Dependencies**

   ```bash
   composer install
   ```

3. **Install JavaScript Dependencies**

   ```bash
   npm install
   ```

4. **Configure Environment**

   - Copy the `.env.example` file to `.env`:

     ```bash
     cp .env.example .env
     ```
   - Update the `.env` file with your database credentials:

     ```env
     DB_DATABASE=bookstore
     DB_USERNAME=your_username
     DB_PASSWORD=your_password
     ```
   - Generate an application key:

     ```bash
     php artisan key:generate
     ```
   - Obtain a Google Books API key from Google Cloud Console, enable the Books API, and add it to `.env`:

     ```env
     GOOGLE_BOOKS_API_KEY=your_api_key_here
     ```

5. **Set Up Database**

   - Create a database named `bookstore` (or as specified in `.env`).
   - Run migrations to create tables:

     ```bash
     php artisan migrate
     ```
   - (Optional) Seed the database with sample data:

     ```bash
     php artisan db:seed
     ```

6. **Link Storage**

   ```bash
   php artisan storage:link
   ```

7. **Run the Application**

   ```bash
   php artisan serve
   ```

   Open your browser and visit `http://localhost:8000`.

## Usage

- **Home Page**: View featured books and trending books from Google Books (`/`) \[Route: `web.index`\].
- **Book Listing**: Browse all books with filters (`/books`) \[Route: `web.books.index`\].
- **Book Details**: View book details and Google Books data (`/books/{slug}`) \[Route: `web.books.details`\].
- **Admin Panel**: Log in as an admin to manage books and categories (`/admin`) \[Route: `admin.dashboard`\].
  - Add/Edit/Delete books (`/admin/books`) \[Route: `admin.books.index`\].
  - Manage categories (`/admin/categories`) \[Route: `admin.categories.index`\].

## Authentication

- Register or log in using Laravel Breeze routes (`/login`, `/register`, `/logout`).
- Set an admin user by updating the `role` column in the `users` table:

  ```bash
  php artisan tinker
  App\Models\User::where('email', 'admin@gmail.com')->update(['role' => 'admin']);
  ```

## Additional Notes

- Ensure the `role` column exists in the `users` table (add via migration if missing).
- Clear caches after configuration changes:

  ```bash
  php artisan cache:clear
  php artisan config:clear
  php artisan view:clear
  php artisan route:clear
  ```
- Check `storage/logs/laravel.log` for errors, especially with the Google Books API.

## 

## 