<?php

namespace App\Providers;

use App\Models\PersonalAccessToken;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

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

        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        \Illuminate\Support\Facades\Blade::directive('ziggy', function () {
            return "<?php echo Ziggy::generateRouteList(['api.*']); ?>";
        });
    }
}
