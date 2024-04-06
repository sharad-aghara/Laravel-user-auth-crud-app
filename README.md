# Laravel Product Management App

This Laravel application serves as a product management system, allowing users to perform CRUD (Create, Read, Update, Delete) operations on products.

## Installation

1. Clone the repository to your local machine:

git clone <repository-url>


2. Install composer dependencies:

composer install


3. Create a `.env` file by copying `.env.example` and update the database credentials:

cp .env.example .env


4. Generate an application key:

php artisan key:generate


5. Migrate the database to create necessary tables:

php artisan migrate


6. Link the storage directory:

php artisan storage:link



## Usage

1. Start the development server:

php artisan serve



2. Access the application in your web browser at `http://localhost:8000`.

## Routes

- `/` or `/product`: Display all products.
- `/product/create`: Create a new product.
- `/product/{product}/edit`: Edit an existing product.
- `/product/{product}/destroy`: Delete an existing product.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


