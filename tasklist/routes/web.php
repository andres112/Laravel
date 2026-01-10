<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
use Carbon\Carbon;

// NOTE: Dummy data for tasks instead of DB
// class Task
// {
//     public function __construct(
//         public int $id,
//         public string $title,
//         public string $description,
//         public ?string $long_description,
//         public bool $completed,
//         public Carbon $created_at,
//         public Carbon $updated_at
//     ) {
//     }
// }
// $tasks = [
//     new Task(
//         1,
//         'Buy groceries for the week',
//         'Purchase milk, eggs, bread, and vegetables from the supermarket.',
//         'Remember to check for discounts and bring reusable bags.',
//         false,
//         Carbon::parse('2025-12-28 17:30:00'),
//         Carbon::parse('2025-12-28 17:30:00')
//     ),
//     new Task(
//         2,
//         'Finish project report',
//         'Complete the final draft of the annual project report.',
//         'Include the latest sales figures and team feedback. Submit to manager by email.',
//         true,
//         Carbon::parse('2025-12-20 09:00:00'),
//         Carbon::parse('2025-12-22 15:45:00')
//     ),
//     new Task(
//         3,
//         'Call plumber',
//         'Fix the leaking kitchen faucet.',
//         null,
//         false,
//         Carbon::parse('2026-01-02 10:00:00'),
//         Carbon::parse('2026-01-02 10:00:00')
//     ),
//     new Task(
//         4,
//         'Read "Atomic Habits"',
//         'Read at least 50 pages of the book.',
//         'Take notes on key concepts for personal development.',
//         true,
//         Carbon::parse('2025-12-30 20:00:00'),
//         Carbon::parse('2026-01-01 21:00:00')
//     ),
//     new Task(
//         5,
//         'Renew car insurance',
//         'Check offers and renew the car insurance before expiry.',
//         null,
//         false,
//         Carbon::parse('2026-01-03 08:00:00'),
//         Carbon::parse('2026-01-03 08:00:00')
//     ),
//     new Task(
//         6,
//         'Plan birthday party',
//         'Organize a birthday party for Sarah.',
//         'Book a venue, send invitations, and order a cake.',
//         false,
//         Carbon::parse('2025-12-25 12:00:00'),
//         Carbon::parse('2025-12-25 12:00:00')
//     ),
//     new Task(
//         7,
//         'Update LinkedIn profile',
//         'Add recent job experience and skills to LinkedIn.',
//         null,
//         true,
//         Carbon::parse('2025-12-15 14:00:00'),
//         Carbon::parse('2025-12-16 09:30:00')
//     ),
//     new Task(
//         8,
//         'Take dogs for a walk',
//         'Walk Max and Bella in the park for at least 30 minutes.',
//         null,
//         false,
//         Carbon::parse('2026-01-03 07:30:00'),
//         Carbon::parse('2026-01-03 07:30:00')
//     ),
// ];

// Home route
Route::get('/', function () {
    return redirect()->route('tasks.index', request()->query());
})->name('home');

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::all(),
    ]);
})->name('tasks.index');

// Dynamic route for listing tasks
Route::get('/tasks/{taskId}', function ($taskId) {
    return view('show', [
        'task' => Task::findOrFail($taskId),
    ]);
    // NOTE: Returnig dummy data from above array instead of DB
    // $task = collect($tasks)->firstWhere('id', (int) $taskId);
    // if (! $task) {
    //     abort(Response::HTTP_NOT_FOUND, 'Task not found');
    // }
    // return view('show', [
    //     'task' => $task,
    // ]);
    // NOTE: Returning simple string for demonstration
    // return "Displaying task: " . $taskId ."<br><a href='" . route('tasks.index') . "'>Back to task list</a>";
})->name('tasks.show');





// Redirect route example
Route::permanentRedirect('/old-home', '/')->name('old.home');
Route::redirect('/temp-home', '/', Response::HTTP_TEMPORARY_REDIRECT)->name('temp.home');

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

    return response()->json($routes, Response::HTTP_OK, [], JSON_PRETTY_PRINT);
})->name('artisan.routes');

// Fallback route for undefined URLs
Route::fallback(function () {
    return response('Page not found', Response::HTTP_NOT_FOUND);
})->name('fallback');
