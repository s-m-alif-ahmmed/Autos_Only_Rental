<?php

namespace App\Http\Controllers\BackEnd\Car;

use App\Http\Controllers\Controller;
use App\Models\Car\CarType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class CarTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $car_types = CarType::query()->latest()->get();
            return view('backend.layouts.car.car_type.index',[
                'car_types' => $car_types,
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
            return view('backend.layouts.car.car_type.create');
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
            'name' => ['required', 'unique:'.CarType::class],
        ]);
        CarType::createCarType($request);
        return redirect('/car-types')->with('message', 'Car Type saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            $car_type = CarType::find($decryptID);
            return view('backend.layouts.car.car_type.detail',[
                'car_type' => $car_type,
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
            $car_type = CarType::find($decryptID);
            return view('backend.layouts.car.car_type.edit',[
                'car_type' => $car_type,
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
            'name' => ['required',
                Rule::unique('car_types')->ignore($decryptID),
            ],
        ]);

        CarType::updateCarType($request, $decryptID);
        return redirect('/car-types')->with('message','Car Type update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            CarType::deleteCarType($id);
            return redirect('/car-types')->with('message','Car Type delete successfully.');
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeStatusCarType($id)
    {
        try {
            $car_type = CarType::select('status')->where('id',$id)->first();
            if($car_type->status == 'Published')
            {
                $status = 'Draft';
            }
            elseif($car_type->status == 'Draft')
            {
                $status = 'Published';
            }
            CarType::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected Car Type status changed successfully.');
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

}
