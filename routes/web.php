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

Auth::routes(["register" => false]);

Route::get('/register', [App\Http\Controllers\FrontController::class, 'register'])->name('front.register');
Route::post('/user/register', [App\Http\Controllers\UserController::class, 'register'])->name('register');

/** route for getting available books */
Route::post('/book/all', [App\Http\Controllers\BookController::class, 'all'])->name('book.all');
Route::post('/book/get', [App\Http\Controllers\BookController::class, 'getBook'])->name('book.get');

Route::group(
    ['prefix' => 'admin/'],
    function () {
        Route::group(
            [],
            function () {
                Route::group(
                    ['middleware' => 'auth'],
                    function () {
                        /* token route */
                        Route::get('/token', [App\Http\Controllers\TokenController::class, 'token'])->name('token');
                        /* home route */
                        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

                        /* user routes */
                        Route::get('/user/index', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
                        Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
                        Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
                        Route::get('/user/particular', [App\Http\Controllers\UserController::class, 'particular'])->name('particular.index');
                        Route::get('/user/history', [App\Http\Controllers\UserController::class, 'history'])->name('particular.history');

                        /* book category routes */
                        Route::get('/book-category/index', [App\Http\Controllers\BookCategoryController::class, 'index'])->name('book-category.index');
                        Route::get('/book-category/all', [App\Http\Controllers\BookCategoryController::class, 'all'])->name('book-category.all');

                        /* book routes */
                        Route::get('/book/index', [App\Http\Controllers\BookController::class, 'index'])->name('book.index');
                        Route::get('/book/create', [App\Http\Controllers\BookController::class, 'create'])->name('book.create');
                        Route::get('/book/edit/{id}', [App\Http\Controllers\BookController::class, 'edit'])->name('book.edit');

                        /* book routes */
                        Route::get('/reservation/index', [App\Http\Controllers\ReservationController::class, 'index'])->name('reservation.index');
                    }
                );
            }
        );
    }
);

Route::group(
    ['prefix' => 'api/'],
    function () {
        Route::group(
            [],
            function () {
                /* api routes */
                Route::group(
                    ['middleware' => 'auth:api'],
                    function () {
                        /* api routes for users */
                        Route::post('/user/all', [App\Http\Controllers\UserController::class, 'all'])->name('user.all');
                        Route::post('/user/get', [App\Http\Controllers\UserController::class, 'getUser'])->name('user.get');
                        Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
                        Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
                        Route::post('/user/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
                        Route::post('/user/activate', [App\Http\Controllers\UserController::class, 'activate'])->name('user.activate');

                        /* api routes for categories */
                        Route::post('/book-category/store', [App\Http\Controllers\BookCategoryController::class, 'store'])->name('book-category.store');
                        Route::post('/book-category/update', [App\Http\Controllers\BookCategoryController::class, 'update'])->name('book-category.update');
                        Route::post('/book-category/delete', [App\Http\Controllers\BookCategoryController::class, 'delete'])->name('book-category.delete');

                        /* api routes for books */
                        Route::post('/book/store', [App\Http\Controllers\BookController::class, 'store'])->name('book.store');
                        Route::post('/book/update', [App\Http\Controllers\BookController::class, 'update'])->name('book.update');
                        Route::post('/book/delete', [App\Http\Controllers\BookController::class, 'delete'])->name('book.delete');

                        /* api routes for reservations */
                        Route::post('/reservation/all', [App\Http\Controllers\ReservationController::class, 'all'])->name('reservation.all');
                        Route::post('/reservation/history', [App\Http\Controllers\ReservationController::class, 'history'])->name('reservation.history');
                        Route::get('/reservation/users-and-books', [App\Http\Controllers\ReservationController::class, 'usersBooks'])->name('reservation.usersBooks');
                        Route::post('/reservation/store', [App\Http\Controllers\ReservationController::class, 'store'])->name('reservation.store');
                        Route::post('/reservation/delete', [App\Http\Controllers\ReservationController::class, 'delete'])->name('reservation.delete');
                        Route::post('/reservation/activate', [App\Http\Controllers\ReservationController::class, 'activate'])->name('reservation.activate');
                        Route::post('/reservation/book', [App\Http\Controllers\ReservationController::class, 'book'])->name('reservation.book');
                    }
                );
            }
        );
    }
);
