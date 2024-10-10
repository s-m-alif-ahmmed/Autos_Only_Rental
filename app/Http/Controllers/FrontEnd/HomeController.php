<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Car\Booking;
use App\Models\Car\Car;
use App\Models\Car\CarType;
use App\Models\Car\Location;
use App\Models\Car\Review;
use App\Models\Faq;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $locations = Location::query()->where('status', 'Published')->latest()->get();
        $cars = Car::query()->where('status', 'Published')->latest()->get();
        return view('web.layouts.home', compact('cars','locations'));
    }

    public function listing(){
        $locations = Location::query()->where('status', 'Published')->latest()->get();
        $car_types = CarType::query()->where('status', 'Published')->latest()->get();
        $cars = Car::query()->where('status', 'Published')->latest()->paginate(12);
        return view('web.layouts.car-listing',[
            'cars' => $cars,
            'car_types' => $car_types,
            'locations' => $locations,
        ]);
    }

    public function carDetail($car_slug){
        $car = Car::query()->where('car_slug', $car_slug)->firstOrFail();

        $more_cars = Car::query()->where('status', 'Published')->latest()->get();
        $reviews = Review::query()->where('car_id', $car->id)->latest()->get();
        $totalReviews = $reviews->count();
        $reviewCount = $reviews->sum('star'); // Sum the star ratings

        // Initialize avgReviews
        $avgReviews = 0;

        // Check if there are any reviews to avoid division by zero
        if ($totalReviews > 0) {
            $avgReviews = $reviewCount / $totalReviews;

            // Round to the nearest whole number
            $avgReviews = round($avgReviews);
        }

        return view('web.layouts.car-detail',[
            'car' => $car,
            'reviews' => $reviews,
            'avgReviews' => $avgReviews,
            'more_cars' => $more_cars,
        ]);
    }

    public function about(){
        return view('web.layouts.about');
    }

    public function faq(){
        $faq = Faq::query();
        $faqs = $faq->where('status', 'Published')->latest()->get();
        return view('web.layouts.faq',[
            'faqs' => $faqs,
        ]);
    }

    public function rentHistory(){
        $user = auth()->user();

//      Get all bookings for the user
        $bookings = Booking::query()->where('user_id', $user->id)->latest()->get();
        $current_bookings = Booking::query()->where('user_id', $user->id)->where('status', 'Current')->latest()->get();
        $completed_bookings = Booking::query()->where('user_id', $user->id)->where('status', 'Completed')->latest()->get();
        $cancelled_bookings = Booking::query()->where('user_id', $user->id)->where('status', 'Cancelled')->latest()->get();

        // Prepare an array to hold car review counts
        $car_review_counts = [];

        // Get the unique car IDs from the bookings
        $car_ids = $bookings->pluck('car_id')->unique();

        // Loop through each car ID and count reviews
        foreach ($car_ids as $car_id) {
            $car_review_counts[$car_id] = Review::where('car_id', $car_id)->count();
        }

        return view('web.layouts.dashboard.rent-history',[
            'bookings' => $bookings,
            'current_bookings' => $current_bookings,
            'completed_bookings' => $completed_bookings,
            'cancelled_bookings' => $cancelled_bookings,
            'car_review_counts' => $car_review_counts,
        ]);
    }

    public function editProfile(){
        return view('web.layouts.dashboard.edit-profile');
    }

}
