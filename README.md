## Installation

### 1. Clone

```sh
git clone https://github.com/MertMustehlik/laravel-authentication-datatable.git
```

```sh
cd laravel-authentication-datatable
```

### 2. Copy .env File

```sh
cp .env.example .env
```

### 3. Install Dependencies

```sh
composer install
```

### 4. Run Migrations and Seed Database

```sh
php artisan migrate --seed
```

### 5. Generate Application Key

```sh
php artisan key:generate
```

### 6. Start the Server

```sh
php artisan serve
```

Server is started: http://127.0.0.1:8000.

### Authenticate

- `POST /api/auth/login`: User login authentication.
- `POST /api/auth/check`: Check authentication status.

### Users

- `GET /api/users`: List all users.
- `POST /api/users`: Create new user.
- `GET /api/users/me`: Get user details.
