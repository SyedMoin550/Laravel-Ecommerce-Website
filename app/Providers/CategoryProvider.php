<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Categorie;

class CategoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $category = Categorie::with(['subCategories' => function ($query) {
            $query->with('subCategories');
        }])->where('parent_id', 0)->get();

        view()->share('category',$category);
    }
}
