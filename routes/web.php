<?php

use App\Http\Controllers\Correos\ContactoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Provider\GitHubController;
use App\Http\Livewire\ShowUserPosts;
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
})->name('inicio');

Route::get('auth/github/redirect', [GitHubController::class, 'redirect'])->name('github.redirect');
Route::get('auth/github/callback', [GitHubController::class, 'callback'])->name('github.callback');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('posts', ShowUserPosts::class)->name('posts.show');
    Route::resource('cposts', PostController::class);
});

Route::get('contacto', [ContactoController::class, 'index'])->name('contacto.form');
Route::post('contacto', [ContactoController::class, 'send'])->name('contacto.send');
