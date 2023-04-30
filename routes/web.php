<?php

use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
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

Route::any('/', [AppController::class, 'home'])->name('home');

Route::match(['post', 'get'], '/add-event', [EventController::class, 'create_event'])->name('add_event')->middleware('auth');

Route::match(['post', 'get'], '/update/{id}', [EventController::class, 'update_event'])->name('update_event')->middleware('auth');

Route::get('/detail/{id}', [EventController::class, 'view_event'])->where('id', '[0-9]+')->name('detail_event');

Route::get('/event', [EventController::class, 'view_categories_event'])->name('list_event');

Route::get('/profile', [UserController::class, 'view_profile'])->name('profile')->middleware('auth');

Route::get('/about-us', function () {
    return view('about-us');
})->name('about_us');

Route::match(['post', 'get'], '/login', [AppController::class, 'login'])->name('login')->middleware('guest');

Route::match(['post', 'get'], '/register', [AppController::class, 'register'])->name('register');

Route::post('/logout', [AppController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::post('/event', [AdminEventController::class, 'update_event']);
    Route::post('/event/delete', [AdminEventController::class, 'delete_event']);
    Route::get('/event', [AdminEventController::class, 'view_event'])->name('admin.event');

    Route::post('/category', [AdminEventController::class, 'update_category']);
    Route::post('/category/delete', [AdminEventController::class, 'delete_category']);
    Route::post('/category/create', [AdminEventController::class, 'create_category']);

    Route::post('/user', [AdminUserController::class, 'update_user']);
    Route::post('/user/delete', [AdminUserController::class, 'delete_user']);
    Route::get('/user', [AdminUserController::class, 'view_user'])->name('admin.user');;
    Route::get('api/user/{id}', 'App\Http\Controllers\API\UserController@user_detail');
    Route::get('api/event/{id}', 'App\Http\Controllers\API\EventController@event_detail');
});

// Route::get('/', function () {
//     return view('home');
// });

// Route::get('/lists', function () {
//     return view('list-event');
// });


// Route::get('/add-post', function () {
//     return view('add-post');
// });

// Route::post('/add-post', function () {
//     return view('add-post');
// });

// Route::get('/register', function () {
//     return view('register');
// });

// Route::get('/login', function () {
//     return view('login');
// });
