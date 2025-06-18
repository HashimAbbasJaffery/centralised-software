<?php

namespace App\Providers;

use App\Models\PersonalAccessToken;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
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

        Str::macro("ordinalWord", function($n) {
            $ordinals = ['First', 'Second', 'Third', 'Fourth', 'Fifth', 'Sixth', 'Seventh', 'Eighth', 'Ninth', 'Tenth'];

            if ($n >= 1 && $n <= count($ordinals)) {
                return $ordinals[$n - 1];
            }

            $v = $n % 100;
            if ($v >= 11 && $v <= 13) {
                $suffix = 'th';
            } else {
                switch ($n % 10) {
                    case 1: $suffix = 'st'; break;
                    case 2: $suffix = 'nd'; break;
                    case 3: $suffix = 'rd'; break;
                    default: $suffix = 'th';
                }
            }

            return $n . $suffix;
        });

        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

    }
}
