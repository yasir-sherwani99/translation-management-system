## Translation Management System

This is a Translation Management System built with Laravel 8. It allows users to manage translations for various text in multiple languages, providing APIs for easy integration and management of translations in a multi-language application.

### Features

- **User Authentication:** Users can signup, login and logout using Laravel Sanctum
- **Multi-language Support:** Store translations for different languages (e.g. English, French, Spanish)
- **CRUD Operations:** Add, update and retrieve translations through an API
- **Search Translations:** Search translation by tags, language or content
- **Performance:** Optimized for handling large sets of translations
- **Testing:** Unit and featured testing for all critical functionalities including performance testing.

### Requirements

- PHP >= 7.4
- Composer
- MySQL (or another supported database)
- Laravel 8.x

### Installation

1. Clone the Git Repository
```bash
git clone https://github.com/yasir-sherwani99/translation-management-system.git
```
2. Install Composer Dependencies
```bash
composer Install
```
3. Setup .env (Duplicate the .env.example file and rename it to .env)
```bash
DB_CONNECTION=mysql<br />
DB_HOST=127.0.0.1<br />
DB_PORT=3306<br />
DB_DATABASE=your_database_name<br />
DB_USERNAME=your_database_username<br />
DB_PASSWORD=your_database_password 
```
4. Generate an Application Key
```bash
php artisan key:generate
```
5. Migrate the Database
```bash
php artisan migrate
```
6. Seed the Database
```bash
php artisan db:seed
```
7. Start the Development Server
```bash
php artisan serve
```

### API Endpoints

#### Authentication

##### 1. **POST /api/register**
Register a new user and authenticate it<br /><br />
**Request**
```http
POST /api/register
Content-Type: application/json
```
```json
{
    "name": "Yasir Naeem",
    "email": "yasir.sherwani@gmail.com",
    "password": "123456"
}
```
**Response**
```json
{
    "success": true,
    "message": "Well-done! You are loggedin successfully",
    "accessToken": "3|eCbYa1DjnHY5O2z75yPyVGj7LBcjBOHgCut8OMsC"
}
```
##### 2. **POST /api/login**
Login an existing user and retrieve an API token<br /><br />
**Request**
```http
POST /api/login
Content-Type: application/json
```
```json
{
    "email": "yasir.sherwani@gmail.com",
    "password": "123456"
}
```
**Response**
```json
{
    "success": true,
    "message": "Well-done! You are loggedin successfully",
    "accessToken": "3|eCbYa1DjnHY5O2z75yPyVGj7LBcjBOHgCut8OMsC",
    "user": {
        "id": 2,
        "name": "Yasir Naeem",
        "email": "yasir.sherwani@gmail.com",
        "email_verified_at": null,
        "created_at": "2025-02-11T16:45:40.000000Z",
        "updated_at": "2025-02-11T16:45:40.000000Z"
    }
}
```
##### 3. **GET /api/logout**
Logout an existing user and delete an API token<br /><br />
**Request**
```http
GET /api/logout
Content-Type: application/json
```
**Response**
```json
{
    "success": true,
    "message": "You are logged out successfully"
}
```

#### Translation

All translations api endpoints are secure and token is required to access it.

##### 1. **POST /api/translations**
Add a new translation<br /><br />
**Request**
```http
POST /api/translations
Content-Type: application/json
```
```json
{
    "word": "Hello",
    "translation": "Hola",
    "locale": "es",
    "tag": "mobile"
}
```
**Response**
```json
{
    "success": true,
    "translation": {
        "id": 1,
        "word": "Hello",
        "translation": "Hola",
        "locale_id": 3,
        "tag_id": 1,
        "created_at": "2025-02-10T18:21:30.000000Z",
        "updated_at": "2025-02-10T18:21:30.000000Z"
    }
}
```
##### 2. **PUT /api/translations/{translation}**
Update a translation<br /><br />
**Request**
```http
PUT /api/translations/1
Content-Type: application/json
```
```json
{
    "word": "Hello",
    "translation": "Hello",
    "locale": "en",
    "tag": "web"
}
```
**Response**
```json
{
    "success": true,
    "translation": {
        "id": 1,
        "word": "Hello",
        "translation": "Hello",
        "locale_id": 1,
        "tag_id": 3,
        "created_at": "2025-02-10T18:21:30.000000Z",
        "updated_at": "2025-02-10T18:21:30.000000Z"
    }
}
```
##### 3. **GET /api/translations**
View all translations<br /><br />
**Request**
```http
GET /api/translations
Content-Type: application/json
```
**Response**
```json
{
    "success": true,
    "translations": [
        {
            "id": 1,
            "word": "Hello",
            "translation": "Hola",
            "locale_id": 3,
            "tag_id": 1,
            "created_at": "2025-02-10T18:21:30.000000Z",
            "updated_at": "2025-02-10T18:21:30.000000Z",
            "locale": {
                "id": 3,
                "code": "es",
                "name": "Spanish",
                "created_at": "2025-02-10T18:21:25.000000Z",
                "updated_at": "2025-02-10T18:21:25.000000Z"
            },
            "tag": {
                "id": 1,
                "name": "mobile",
                "created_at": "2025-02-10T18:21:25.000000Z",
                "updated_at": "2025-02-10T18:21:25.000000Z"
            }
        },
        {
            "id": 2,
            "word": "Welcome",
            "translation": "Bonjure",
            "locale_id": 2,
            "tag_id": 1,
            "created_at": "2025-02-10T18:21:30.000000Z",
            "updated_at": "2025-02-10T18:21:30.000000Z",
            "locale": {
                "id": 2,
                "code": "fr",
                "name": "French",
                "created_at": "2025-02-10T18:21:25.000000Z",
                "updated_at": "2025-02-10T18:21:25.000000Z"
            },
            "tag": {
                "id": 1,
                "name": "mobile",
                "created_at": "2025-02-10T18:21:25.000000Z",
                "updated_at": "2025-02-10T18:21:25.000000Z"
            }
        }
    ]
}
```
##### 4. **GET /api/translations/search**
Search translations by tag, locale or content<br /><br />
**Request**
```http
GET /api/translations/search?q=Hello&locale=en&tag=mobile
Content-Type: application/json
```
**Response**
```json
{
    "success": true,
    "translations": [
        {
            "id": 1,
            "word": "Hello",
            "translation": "Hola",
            "locale_id": 3,
            "tag_id": 1,
            "created_at": "2025-02-10T18:21:30.000000Z",
            "updated_at": "2025-02-10T18:21:30.000000Z",
            "locale": {
                "id": 3,
                "code": "es",
                "name": "Spanish",
                "created_at": "2025-02-10T18:21:25.000000Z",
                "updated_at": "2025-02-10T18:21:25.000000Z"
            },
            "tag": {
                "id": 1,
                "name": "mobile",
                "created_at": "2025-02-10T18:21:25.000000Z",
                "updated_at": "2025-02-10T18:21:25.000000Z"
            }
        },
        {
            "id": 2,
            "word": "Welcome",
            "translation": "Bonjure",
            "locale_id": 2,
            "tag_id": 1,
            "created_at": "2025-02-10T18:21:30.000000Z",
            "updated_at": "2025-02-10T18:21:30.000000Z",
            "locale": {
                "id": 2,
                "code": "fr",
                "name": "French",
                "created_at": "2025-02-10T18:21:25.000000Z",
                "updated_at": "2025-02-10T18:21:25.000000Z"
            },
            "tag": {
                "id": 1,
                "name": "mobile",
                "created_at": "2025-02-10T18:21:25.000000Z",
                "updated_at": "2025-02-10T18:21:25.000000Z"
            }
        }
    ]
}
```
### Testing

##### Running Tests

You can run tests to verify the functionality of the translation system.

1. **Unit Tests:** Tests for individual translation management methods e.g. (adding, retrieving translations). 
```bash
php artisan test --filter=TranslationTest
```
2. **Feature Tests:** Tests for the complete translation management flow (e.g., adding, searching and updating translations via API).
```bash
php artisan test --filter=TranslationFeatureTest
```
3. **Performance Tests:** Ensure the system handles bulk translations efficiently.
```bash
php artisan test --filter=TranslationPerformanceTest
```




