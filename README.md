## Translation Management System

This is a Translation Management System built with Laravel 8. It allows users to manage translations for various text in multiple languages, providing APIs for easy integration and management of translations in a multi-language application.

### Requirements

- PHP >= 7.4
- Composer
- MySQL (or another supported database)
- Laravel 8.x

### Installation

1. Clone the Git Repository<br />
git clone https://github.com/yasir-sherwani99/translation-management-system.git
2. Install Composer Dependencies<br />
composer Install
3. Setup .env<br />
Duplicate the .env.example file and rename it to .env<br /><br />
DB_CONNECTION=mysql<br />
DB_HOST=127.0.0.1<br />
DB_PORT=3306<br />
DB_DATABASE=your_database_name<br />
DB_USERNAME=your_database_username<br />
DB_PASSWORD=your_database_password
4. Generate an application key<br />
php artisan key:generate
5. Migrate the Database<br />
php artisan migrate
6. Seed the Database<br />
php artisan db:seed
7. Start the Development Server<br />
php artisan serve

### Features

-- **User Authentication:** Users can signup, login and logout using Laravel Sanctum



