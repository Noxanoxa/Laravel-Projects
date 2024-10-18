# MindCMS Blog

## Prerequisites
- PHP >= 7.3
- Composer
- Node.js & npm
- MySQL or any other supported database
- Redis (for caching and queues)

## Setup Instructions

### 1. Clone the Repository
```sh
git clone https://github.com/Noxanoxa/Laravel-Projects.git
cd Laravel-Projects/mindcms-blog
```

### 2. Install PHP Dependencies
```sh
composer install
```

### 3. Install Node.js Dependencies
```sh
npm install
```

### 4. Environment Configuration
- Copy the `.env.example` file to `.env`
- Update the `.env` file with your database, Redis, and other configurations

```sh
cp .env.example .env
```

### 5. Generate Application Key
```sh
php artisan key:generate
```

### 6. Run Database Migrations
```sh
Ensure that you have created new database called `elmofakir` on phpmyadmin or...  
```

### 7. Run Database Migrations
```sh
php artisan migrate --seed
```

### 8. Start Redis Server
Ensure that the Redis server is running. You can start it using the following command:
```sh
redis-server
```

### 9. Run the Development Server
```sh
php artisan serve
```

### 10. Compile Assets
```sh
npm run dev
```

## Troubleshooting
- Ensure your `.env` file is correctly configured.
- Check if all required services (e.g., database, Redis) are running.

## Contributing
- Fork the repository
- Create a new branch (`git checkout -b feature-branch`)
- Commit your changes (`git commit -m 'Add some feature'`)
- Push to the branch (`git push origin feature-branch`)
- Open a pull request

## License
This project is licensed under the SOL License.
