# Laravel & PHP Learning Repository

This repository is for learning PHP and Laravel. It uses Docker for development environments.

## Directory Structure

```
Laravel/
├── fundaments/          # PHP fundamentals learning
│   ├── sections/        # Step-by-step PHP lessons
│   ├── require/         # Configuration files
│   ├── index.php        # Main entry point
│   ├── checker.php      # Type checking examples
│   ├── performance.php  # Performance testing
│   ├── strict.php       # Strict mode examples
│   └── users.csv        # Sample data
├── docker/              # Docker configurations
│   ├── fundaments.Dockerfile   # PHP/Apache for fundamentals
│   └── laravel.Dockerfile      # Laravel environment
└── tasklist/            # Laravel project - Task management app
```

## Projects

### PHP Fundamentals (`fundaments/`)
Basic PHP learning exercises covering types, strict mode, performance, and file handling.

### Laravel Projects
- **tasklist/** - Task management application (Laravel)

## Development

All projects run in Docker containers. See README.md for setup instructions.

- PHP Fundamentals: `http://localhost:8080` (php-training container)
- Laravel Projects: `http://localhost:8080` (laravel-tasklist container)
