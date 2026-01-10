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

## Testing workflows

### Tasklist Project
Constrains:
- Just execute the steps
- Not verbose
- Not explain
- Report only after the full test is done

Use playwright to test the following:

Use as base url: http://localhost:8080.
1. / redirects to http://localhost:8080/tasks.
2. old-home redirects to / and then to /tasks.
3. Already in the /tasks check that the pending tasks are first and the completed after. Completed tasks with green view buttons and the pending with orange view buttons.
4. Click in the 3rd pending task view button. Then check that the title has 🔄 icon in the title.
5. come back to the tasks using the red button.
6. Scroll to the bottom of the page and click on the last completed task view button. Then check that the title has ✅ icon in the title.
