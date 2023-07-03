<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
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
        // Store this names instead of the namespace in polymorphic type columns
        Relation::enforceMorphMap([
            'post' => 'App\Models\Post',
            'video' => 'App\Models\Video',

        ]);
    }
}
