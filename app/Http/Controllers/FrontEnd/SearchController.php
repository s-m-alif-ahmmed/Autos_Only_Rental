<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Car\Booking;
use App\Models\Car\Car;
use App\Models\Car\CarType;
use App\Models\Car\Location;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SearchController extends Controller
{
    public function search(Request $request) {
        // Fetch locations and car types
        $locations = Location::query()->where('status', 'Published')->latest()->get();
        $car_types = CarType::query()->where('status', 'Published')->latest()->get();
        $bookings = Booking::query()->where('status', 'Current')->latest()->get();

        // Initialize the query for available cars
        $query = Car::query()
            ->where('status', 'Published'); // Start with published cars

        // Check for input fields and build the query accordingly
        if ($request->location_id) {
            $query->where('location_id', $request->location_id);
        }

        if ($request->drop_location) {
            $query->whereJsonContains('drop_location', $request->drop_location);
        }

        // Check for input fields and build the query accordingly
        if ($request->location_id && $request->drop_location) {
            $query->where('location_id', $request->location_id)->whereJsonContains('drop_location', $request->drop_location);
        }

        if ($request->pickup_date && $request->drop_date) {
            // Adjust parsing to handle different date formats
            $from_date = Carbon::createFromFormat('d/m/Y', $request->pickup_date)->format('Y-m-d');
            $to_date = Carbon::createFromFormat('d/m/Y', $request->drop_date)->format('Y-m-d');

            // Query for available cars
            $query = Car::leftJoin('bookings', function($join) use ($from_date, $to_date) {
                $join->on('cars.id', '=', 'bookings.car_id')
                    ->where('bookings.status', 'Current')
                    ->where(function($query) use ($from_date, $to_date) {
                        $query->whereBetween('bookings.pickup_date', [$from_date, $to_date])
                            ->orWhereBetween('bookings.drop_date', [$from_date, $to_date])
                            ->orWhere(function($query) use ($from_date, $to_date) {
                                $query->where('bookings.pickup_date', '<=', $from_date)
                                    ->where('bookings.drop_date', '>=', $to_date);
                            });
                    });
            })
                ->whereNull('bookings.id') // Filter for cars that have no overlapping bookings
                ->select('cars.*'); // Change this number as needed for your pagination
        }

        // Get the paginated results
        $searchCars = $query->select('cars.*')->paginate(10)->appends('query');

        return view('web.layouts.search.search-car-listing', [
            'car_types' => $car_types,
            'locations' => $locations,
            'bookings' => $bookings,
            'searchCars' => $searchCars,
        ]);
    }

    public function filterCars(Request $request)
    {
        // Initialize the query for the Car model
        $query = Car::query();

        // Filter by car type
        if ($request->has('car_type') && !empty($request->car_type)) {
            $query->whereIn('car_type_id', $request->input('car_type'));
        }

        // Filter by location
        if ($request->has('location') && !empty($request->location)) {
            $query->whereIn('location_id', $request->input('location'));
        }

        // Filter by price range
        if ($request->has('price-min') && $request->has('price-max')) {
            $query->whereBetween('day_price', [$request->input('price-min'), $request->input('price-max')]);
        }

        // Filter by average star rating
        if ($request->has('star') && !empty($request->star)) {
            // Convert star filter input to an array of integers
            $starValues = array_map('intval', $request->input('star'));

            // Check if star values are valid (non-empty array)
            if (!empty($starValues)) {
                // Use whereHas to ensure all selected stars must match
                $query->whereHas('reviews', function($q) use ($starValues) {
                    $q->select('car_id')
                        ->groupBy('car_id')
                        ->havingRaw('ROUND(AVG(star)) IN (' . implode(',', $starValues) . ')');
                });
            }
        }

        // Fetch the filtered cars with pagination, 10 cars per page
        $cars = $query->paginate(10);

        // Calculate review counts and average star ratings for the filtered cars
        $review_counts = $cars->mapWithKeys(function ($car) {
            return [$car->id => $car->reviews->count()];
        });

        $average_stars = $cars->mapWithKeys(function ($car) {
            return [$car->id => $car->reviews->avg('star')];
        });

        // Prepare the response
        return response()->json([
            'data' => $cars,
            'review_counts' => $review_counts,
            'average_stars' => $average_stars // Include average stars in the response
        ]);
    }

    public function searchFilterCars(Request $request)
    {
        // Retrieve previous search parameters from the session
        $searchParams = $request->session()->get('search_params', []);

        // Apply previous search parameters to the query
        if (isset($searchParams['location_id'])) {
            $query->where('location_id', $searchParams['location_id']);
        }

        if (isset($searchParams['drop_location'])) {
            $query->whereJsonContains('drop_location', $searchParams['drop_location']);
        }

        if (isset($searchParams['pickup_date']) && isset($searchParams['drop_date'])) {
            $from_date = Carbon::createFromFormat('d/m/Y', $searchParams['pickup_date'])->format('Y-m-d');
            $to_date = Carbon::createFromFormat('d/m/Y', $searchParams['drop_date'])->format('Y-m-d');

            // Exclude cars that are booked within the date range
            $query->leftJoin('bookings', function ($join) use ($from_date, $to_date) {
                $join->on('cars.id', '=', 'bookings.car_id')
                    ->where('bookings.status', 'Current')
                    ->where(function ($query) use ($from_date, $to_date) {
                        $query->whereBetween('bookings.pickup_date', [$from_date, $to_date])
                            ->orWhereBetween('bookings.drop_date', [$from_date, $to_date])
                            ->orWhere(function ($query) use ($from_date, $to_date) {
                                $query->where('bookings.pickup_date', '<=', $from_date)
                                    ->where('bookings.drop_date', '>=', $to_date);
                            });
                    });
            })
                ->whereNull('bookings.id'); // Exclude booked cars
        }

        // Preserve the search parameters in the session for filters
        $request->session()->put('search_params', array_merge($searchParams, $request->only('car_type', 'price-min', 'price-max', 'star')));

        // Filter by car type if provided
        if ($request->has('car_type') && !empty($request->car_type)) {
            $query->whereIn('car_type_id', $request->car_type);
        }

        // Filter by price range
        if ($request->has('price-min') && $request->has('price-max')) {
            $minPrice = $request->input('price-min');
            $maxPrice = $request->input('price-max');
            $query->whereBetween('day_price', [$minPrice, $maxPrice]);
        }

        // Filter by average star rating
        if ($request->has('star') && !empty($request->star)) {
            $starValues = array_map('intval', $request->star);

            if (!empty($starValues)) {
                $query->whereHas('reviews', function ($q) use ($starValues) {
                    $q->select('car_id')
                        ->groupBy('car_id')
                        ->havingRaw('ROUND(AVG(star)) IN (' . implode(',', $starValues) . ')');
                });
            }
        }

        // Fetch the filtered cars with pagination, 10 cars per page
        $cars = $query->paginate(10);

        // Calculate review counts and average star ratings for the filtered cars
        $review_counts = $cars->mapWithKeys(function ($car) {
            return [$car->id => $car->reviews->count()];
        });

        $average_stars = $cars->mapWithKeys(function ($car) {
            return [$car->id => round($car->reviews->avg('star'), 1)]; // Rounding for better presentation
        });

        // Prepare the response
        return response()->json([
            'data' => $cars,
            'review_counts' => $review_counts,
            'average_stars' => $average_stars,
            'total' => $cars->total(), // Include total count for pagination
            'current_page' => $cars->currentPage(),
            'last_page' => $cars->lastPage(),
        ]);
    }


}
