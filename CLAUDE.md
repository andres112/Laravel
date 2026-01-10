# Laravel & PHP Learning Repository

This repository contains training materials for learning PHP and Laravel using Docker environments.

## Current Focus

**tasklist/** - Laravel task management application

## Directory Structure

```
Laravel/
├── fundaments/          # PHP fundamentals learning
│   ├── sections/        # Step-by-step lessons
│   ├── require/         # Configuration files
│   ├── index.php        # Main entry point
│   ├── checker.php      # Type checking examples
│   ├── performance.php  # Performance testing
│   ├── strict.php       # Strict mode examples
│   └── users.csv        # Sample data
├── docker/              # Docker configurations
│   ├── fundaments.Dockerfile   # PHP/Apache for fundamentals
│   └── laravel.Dockerfile      # Laravel environment
└── tasklist/            # Laravel task management app
```

## Prerequisites

- **Docker Desktop** (Windows): [Download](https://www.docker.com/products/docker-desktop/)
- **Visual Studio Code** (recommended)

## Docker Setup

### PHP Fundamentals Container

Build:
```sh
docker build -t php-apache -f fundaments.Dockerfile .
```

Run:
```sh
docker run -d --name php-training -p 8080:80 -v ${PWD}/fundaments:/var/www/html php-apache
```

Access: `http://localhost:8080`

### Laravel Container (tasklist)

Build:
```sh
docker build -t laravel-base -f laravel.Dockerfile .
```

Run:
```sh
docker run -d --name laravel-tasklist -p 8080:80 -v ${PWD}/tasklist:/var/www/html laravel-base
```

Initialize Laravel (first time):
```sh
docker exec -u www-data -it laravel-tasklist bash
composer create-project laravel/laravel .
php artisan key:generate
```

Access: `http://localhost:8080`

## Container Management

Stop container:
```sh
docker stop php-training         # Fundamentals
docker stop laravel-tasklist     # Laravel
```

Remove container:
```sh
docker rm php-training           # Fundamentals
docker rm laravel-tasklist       # Laravel
```

Access container shell:
```sh
docker exec -it php-training bash              # Fundamentals
docker exec -u www-data -it laravel-tasklist bash  # Laravel
```
