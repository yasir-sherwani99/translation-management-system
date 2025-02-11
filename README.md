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

- **User Authentication:** Users can signup, login and logout using Laravel Sanctum
- **Multi-language Support:** Store translations for different languages (e.g. English, French, Spanish)
- **CRUD Operations:** Add, update and retrieve translations through an API
- **Search Translations:** Search translation by tags, language or content
- **Performance:** Optimized for handling large sets of translations
- **Testing:** Unit and featured testing for all critical functionalities including performance testing.

### API Endpoints

##### Authentication

- **POST** /api/register: Register a new user and authenticate it.
- **POST** /api/login: Login an existing user and retrieve an API token.
- **GET** /api/logout: Logout an existing user and delete an API token.

##### Translation

All translations api endpoints are secure and token is required to access it.

- **POST** /api/translations: Add a new translation.
- **PUT** /api/translations/{translation}: Update a translation.
- **GET** /api/translations: View all translations
- **GET** /api/translations/search: Search a translation by locale, tag or contnet

### Testing

##### Running Tests

You can run tests to verify the functionality of the translation system.

1. **Unit Tests:** Tests for individual translation management methods e.g. (adding, retrieving translations). 
```bash
php artisan test --filter=TranslationTest
```






