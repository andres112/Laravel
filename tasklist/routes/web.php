
<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

class Task
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public ?string $long_description,
        public bool $completed,
        public Carbon $created_at,
        public Carbon $updated_at
    ) {
    }
}

$tasks = [
    new Task(
        1,
        'Buy groceries',
        'Task 1 description',
        'Task 1 long description',
        false,
        Carbon::parse('2026-03-01 12:00:00'),
        Carbon::parse('2026-03-01 12:00:00')
    ),
    new Task(
        2,
        'Sell old stuff',
        'Task 2 description',
        null,
        false,
        Carbon::parse('2026-03-02 12:00:00'),
        Carbon::parse('2026-03-02 12:00:00')
    ),
    new Task(
        3,
        'Learn programming',
        'Task 3 description',
        'Task 3 long description',
        true,
        Carbon::parse('2026-03-03 12:00:00'),
        Carbon::parse('2026-03-03 12:00:00')
    ),
    new Task(
        4,
        'Take dogs for a walk',
        'Task 4 description',
        null,
        false,
        Carbon::parse('2026-03-04 12:00:00'),
        Carbon::parse('2026-03-04 12:00:00')
    ),
];

Route::get('/', function () use ($tasks) {
    return view('index', [
        'tasks' => $tasks,
    ]);
})->name('home');

// Dynamic route for listing tasks
Route::get('/tasks/{task}', function ($task) {
    return "Displaying task: " . $task;
})->name('tasks.show');

// Redirect route example
Route::permanentRedirect('/old-home', '/')->name('old.home');
Route::redirect('/temp-home', '/', 302)->name('temp.home');

// Display all registered routes
Route::get('/show-routes', function () {
    $routes = collect(Route::getRoutes())->map(function ($route) {
        return [
            'method' => implode('|', $route->methods()),
            'uri' => $route->uri(),
            'name' => $route->getName(),
            'action' => $route->getActionName(),
        ];
    });

    return response()->json($routes, 200, [], JSON_PRETTY_PRINT);
})->name('artisan.routes');

// Fallback route for undefined URLs
Route::fallback(function () {
    return response('Page not found', 404);
})->name('fallback');
