<?php

namespace App\Domain\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\PageRepository;
use App\Domain\Repositories\Eloquent\UserRepository;
use App\Domain\Repositories\Contracts\UserRepositoryInterface;
use App\Domain\Repositories\Contracts\PageRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        UserRepositoryInterface::class => UserRepository::class,
        PageRepositoryInterface::class => PageRepository::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('static.pages', function ($app) {
            $repository = $app->make(PageRepositoryInterface::class);

            return cache()->rememberForever('pages', function () use ($repository) {
                return $repository->all();
            });
        });
    }
}
