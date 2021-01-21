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

                        /* book category routes */
                        Route::get('/book-category/index', [App\Http\Controllers\BookCategoryController::class, 'index'])->name('book-category.index');
                        Route::get('/book-category/all', [App\Http\Controllers\BookCategoryController::class, 'all'])->name('book-category.all');

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
                            }
                        );
                    }
                );
            }
        );
    }
);
