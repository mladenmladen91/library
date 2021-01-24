<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Interfaces\BookCategoryRepositoryInterface;
use App\Repositories\BookCategoryRepository;
use App\Interfaces\BookRepositoryInterface;
use App\Repositories\BookRepository;
use App\Interfaces\ReservationRepositoryInterface;
use App\Repositories\ReservationRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        $this->app->bind(
            BookCategoryRepositoryInterface::class,
            BookCategoryRepository::class
        );
        $this->app->bind(
            BookRepositoryInterface::class,
            BookRepository::class
        );
        $this->app->bind(
            ReservationRepositoryInterface::class,
            ReservationRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
