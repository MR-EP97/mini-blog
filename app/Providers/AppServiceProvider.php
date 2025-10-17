<?php

namespace App\Providers;

use App\Livewire\Blog\BlogIndex;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Eloquent\PostRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Services\Contracts\PostServiceInterface::class,
            \App\Services\PostService::class
        );


        $this->app->bind(
            PostRepositoryInterface::class,
            PostRepository::class
        );

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
