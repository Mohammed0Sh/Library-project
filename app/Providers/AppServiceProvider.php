<?php

namespace App\Providers;

use App\Item_State;
use App\Item_Type;
use App\Maintainer;
use App\Subject;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('user.layouts.search',function ($view)
        {
            $maintainers = Maintainer::all();
            $item_types = Item_Type::all();
            $subjects = Subject::all();
            $item_states = Item_State::all();

            $view->with([
                'maintainers'=>Maintainer::all(),
                'item_types'=>Item_Type::all(),
                'subjects'=>Subject::all(),
                'item_states'=>Item_State::all(),

            ]);

        });
    }
}
