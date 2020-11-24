<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:web', 'role:admin'])->group(function() {
    Route::get(
        'projects/{project}/delete',
        [
            \App\Http\Controllers\ProjectController::class,
            'destroy'
        ]
    )
        ->name('projects.delete');

    Route::resource(
        'projects',
        \App\Http\Controllers\ProjectController::class,
        [
            'names' => [
                'index' => 'projects',
            ],
        ]
    );

    Route::get(
        'customers/{customer}/delete',
        [
            \App\Http\Controllers\CustomerController::class,
            'destroy'
        ]
    )
        ->name('customers.delete');

    Route::resource(
        'customers',
        \App\Http\Controllers\CustomerController::class,
        [
            'names' => [
                'index' => 'customers',
            ],
        ]
    );

    Route::get(
        'activities/{activity}/delete',
        [
            \App\Http\Controllers\ActivityController::class,
            'destroy'
        ]
    )
        ->name('activities.delete');

    Route::resource(
        'activities',
        \App\Http\Controllers\ActivityController::class,
        [
            'names' => [
                'index' => 'activities',
            ],
        ]
    );
});


