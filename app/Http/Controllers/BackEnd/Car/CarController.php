<?php

namespace App\Http\Controllers\BackEnd\Car;

use App\Http\Controllers\Controller;
use App\Models\Car\Car;
use App\Models\Car\CarType;
use App\Models\Car\Location;
use App\Models\Car\MoreImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $car = Car::query();
            $cars = $car->latest()->get();
            return view('backend.layouts.car.car.index',[
                'cars' => $cars,
            ]);
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $locations = Location::where('status', 'Published')->latest()->get();
            $car_types = CarType::where('status', 'Published')->latest()->get();
            return view('backend.layouts.car.car.create',[
                'locations' => $locations,
                'car_types' => $car_types,
            ]);
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_id' => 'required',
            'car_type_id' => 'required',
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'seat' => 'required|integer',
            'person' => 'required|integer',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'more_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'day_price' => 'nullable|numeric',
            'week_price' => 'nullable|numeric',
            'month_price' => 'nullable|numeric',
        ]);
        $this->car = Car::createCar($request);
        MoreImage::createCarMoreImage($request, $this->car->id);
        return redirect('/cars')->with('message', 'Car saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            $car = Car::find($decryptID);
            return view('backend.layouts.car.car.detail',[
                'car' => $car,
            ]);
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            $car = Car::find($decryptID);
            $locations = Location::where('status', 'Published')->latest()->get();
            $car_types = CarType::where('status', 'Published')->latest()->get();
            return view('backend.layouts.car.car.edit',[
                'car' => $car,
                'locations' => $locations,
                'car_types' => $car_types,
                'more_images' => MoreImage::all(),
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
        $car = Car::find($decryptID);

        if (!$car) {
            return redirect()->back()->with('error', 'Car not found.');
        }

        $validated = $request->validate([
            'location_id' => 'required',
            'car_type_id' => 'required',
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'more_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity' => 'required|integer',
            'seat' => 'required|integer',
            'person' => 'required|integer',
            'description' => 'required',
            'day_price' => 'nullable|numeric',
            'week_price' => 'nullable|numeric',
            'month_price' => 'nullable|numeric',
        ]);

        // Merge drop_location as JSON
        $dropLocation = $request->input('drop_location', []);
        $request->merge(['drop_location' => json_encode($dropLocation)]);

        Car::updateCar($request, $decryptID);

        if ($request->file('more_image')) {
            MoreImage::updateCarMoreImage($request, $decryptID);
        }

        // Merge drop_location as JSON
        $request->merge(['drop_location' => json_encode($request->drop_location)]);

        return redirect('/cars')->with('message','Car update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Car::deleteCar($id);
            MoreImage::deleteCarMoreImage($id);
            return redirect('/cars')->with('message','Car delete successfully.');
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeStatusCar($id)
    {
        try {
            $location = Car::select('status')->where('id',$id)->first();
            if($location->status == 'Published')
            {
                $status = 'Draft';
            }
            elseif($location->status == 'Draft')
            {
                $status = 'Published';
            }
            Car::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected car status changed successfully.');
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
