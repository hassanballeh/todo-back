# Todo App

A simple Todo application built with Laravel and Laravel Sanctum for API authentication.

## Features

-   User authentication with Laravel Sanctum
-   Create, read, update, and delete todo items
-   RESTful API structure

## Requirements

-   PHP >= 8.0
-   Composer
-   MySQL or another supported database
-   Node.js & npm (for frontend assets, if applicable)

## Installation

1. **Clone the repository:**

    ```bash
    git clone <repository-url>
    cd todo-back
    ```

2. **Install PHP dependencies:**

    ```bash
    composer install
    ```

3. **Copy the example environment file and set your variables:**

    ```bash
    cp .env.example .env
    ```

4. **Generate the application key:**

    ```bash
    php artisan key:generate
    ```

5. **Configure your database and other environment variables in `.env`.**

6. **Run migrations:**

    ```bash
    php artisan migrate
    ```

7. **(Optional) Install frontend dependencies:**

    ```bash
    npm install
    npm run dev
    ```

8. **Start the development server:**
    ```bash
    php artisan serve
    ```

## API Authentication

This app uses [Laravel Sanctum](https://laravel.com/docs/10.x/sanctum) for API authentication. Make sure to follow the Sanctum documentation for SPA or mobile authentication flows.

## API Endpoints

> **Note:** List your main API endpoints here, for example:

-   `POST /api/register` – Register a new user
-   `POST /api/login` – Login and receive a token
-   `GET /api/todos` – List all todos
-   `POST /api/todos` – Create a new todo
-   `PUT /api/todos/{id}` – Update a todo
-   `DELETE /api/todos/{id}` – Delete a todo

## Author

Created by **Hassan Balleh**

## License

This project is open-source and available under the [MIT license](LICENSE).
