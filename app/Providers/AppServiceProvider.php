<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
           Builder::macro('withAndWhereHas', function ($relation, $constraint) {
                return $this->whereHas($relation, $constraint)
                            ->with([$relation => $constraint]);
            });
    }
}
