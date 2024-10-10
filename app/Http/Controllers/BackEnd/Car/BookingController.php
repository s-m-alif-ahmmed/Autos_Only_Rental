<?php

namespace App\Http\Controllers\BackEnd\Car;

use App\Http\Controllers\Controller;
use App\Models\Car\Booking;
use App\Models\Car\Car;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $bookings = Booking::query()->latest()->get();
            return view('backend.layouts.car.booking.index',[
                'bookings' => $bookings,
            ]);
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'user_id' => 'nullable',
            'car_id' => 'required',
            'name' => 'required|string',
            'email' => 'required|email|string',
            'number' => 'required|regex:/^\d{11}$/',
            'pickup_location' => 'required|string',
            'drop_location' => 'required|string',
            'pickup_date' => 'required|string',
            'drop_date' => 'required|string',
            'package' => 'required|string',
        ]);

        // Get the car ID from validated data
        $carId = $validated['car_id'];

        // Find the car based on the car ID
        $car = Car::findOrFail($carId);

        try {
            // Convert input date format from d/m/Y to Y-m-d
            $pickupDate = Carbon::createFromFormat('d/m/Y', $validated['pickup_date'])->format('Y-m-d');
            $dropDate = Carbon::createFromFormat('d/m/Y', $validated['drop_date'])->format('Y-m-d');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Invalid date format. Please use dd/mm/yyyy.']);
        }

        // Validate date after conversion
        if (!$pickupDate || !$dropDate) {
            return back()->withErrors(['message' => 'Invalid date format.']);
        }

        $bookedCount = Booking::where('car_id', $carId)
            ->where('status', 'Current')
            ->where(function ($query) use ($pickupDate, $dropDate) {
                // Check if the new booking overlaps with existing bookings
                $query->where(function ($q) use ($pickupDate, $dropDate) {
                    $q->whereBetween('pickup_date', [$pickupDate, $dropDate])
                        ->orWhereBetween('drop_date', [$pickupDate, $dropDate]);
                })
                    ->orWhere(function ($q) use ($pickupDate, $dropDate) {
                        $q->where('pickup_date', '<=', $dropDate)
                            ->where('drop_date', '>=', $pickupDate);
                    });
            })
            ->count();

        if ($bookedCount >= $car->quantity) {
            return back()->withErrors(['message' => 'This car is not available for the selected dates.']);
        }

        // Calculate the number of days (inclusive)
        $days = Carbon::parse($pickupDate)->diffInDays(Carbon::parse($dropDate)) + 1;

        // Validate package selection based on days
        if ($days < 7 && $validated['package'] === 'Rent Weekly') {
            return redirect()->back()->withErrors(['message' => 'Rent Weekly is not available for rentals less than 7 days.']);
        }
        if ($days < 30 && $validated['package'] === 'Rent Monthly') {
            return redirect()->back()->withErrors(['message' => 'Rent Monthly is not available for rentals less than 30 days.']);
        }

        // Initialize price
        $price = 0;


        // Set the price based on the selected package
        if ($validated['package'] === 'Rent Per Day') {
            $price = $days * $car->day_price; // Calculate price based on total days
        } elseif ($validated['package'] === 'Rent Weekly') {
            $week_day_price = $car->week_price / 7; // Calculate daily price based on week price
            $price = $days * $week_day_price; // Calculate price based on week daily price
        } elseif ($validated['package'] === 'Rent Monthly') {
            $month_day_price = $car->month_price / 30;  // Calculate daily price based on month price
            $price = $days * $month_day_price;  // Calculate price based on month daily price
        }

        // Add the calculated price and formatted dates to the validated data
        $validated['pickup_date'] = $pickupDate; // Use formatted pickup date
        $validated['drop_date'] = $dropDate; // Use formatted drop date
        $validated['price'] = $price;

        // Save the booking
        Booking::createBooking($validated);

        return redirect()->back()->with('message', 'Booking successful.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            $booking = Booking::find($decryptID);
            return view('backend.layouts.car.booking.detail',[
                'booking' => $booking,
            ]);
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $decryptID = Crypt::decryptString($id);

        $validated = $request->validate([
            'note' => 'required|string',
        ]);

        Booking::updateBooking($request, $decryptID);
        return redirect()->back()->with('message','Car Booking message note update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Booking::deleteBooking($id);
            return redirect('/car-bookings')->with('message','Car Booking delete successfully.');
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeStatusBookingCancel($id)
    {
        try {
            $booking = Booking::select('status')->where('id',$id)->first();
            if($booking->status == 'Current')
            {
                $status = 'Cancelled';
            }
            Booking::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Car booking cancelled successfully!');
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeStatusBooking(Request $request,$id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $status = $request->input('status');
            $booking->update(['status' => $status]);

            return back()->with('message', 'Selected booking status changed successfully.');
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

}
