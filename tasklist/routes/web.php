
<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index', [
        'title' => 'Home Page',
        'country' => 'Switzerland',
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
