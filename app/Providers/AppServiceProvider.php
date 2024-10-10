<?php

namespace App\Providers;

use App\Models\Car\Car;
use App\Models\Car\CarType;
use App\Models\Car\Location;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {
            $cars = Car::with('reviews')->get();
            $review_counts = $cars->mapWithKeys(function ($car) {
                return [$car->id => $car->reviews->count()];
            });

            $view->with('review_counts', $review_counts);
        });

        View::composer('*', function ($view) {
            $car_types = CarType::with('cars')->get();
            $car_type_counts = $car_types->mapWithKeys(function ($car_type) {
                return [$car_type->id => $car_type->cars->count()]; // Ensure this is cars not car_types
            });

            $view->with('car_type_counts', $car_type_counts);
        });

        View::composer('*', function ($view) {
            $locations = Location::with('cars')->get();
            $location_counts = $locations->mapWithKeys(function ($location) {
                return [$location->id => $location->cars->count()]; // Ensure this is cars not location
            });

            $view->with('location_counts', $location_counts);
        });

    }
}
