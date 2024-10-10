<?php

namespace App\Http\Controllers\BackEnd\Car;

use App\Http\Controllers\Controller;
use App\Models\Car\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $location = Location::query();
            $locations = $location->latest()->get();
            return view('backend.layouts.car.location.index',[
                'locations' => $locations,
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
            return view('backend.layouts.car.location.create');
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
            'location' => ['required', 'unique:'.Location::class],
        ]);
        Location::createLocation($request);
        return redirect('/locations')->with('message', 'Location saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            $location = Location::find($decryptID);
            return view('backend.layouts.car.location.detail',[
                'location' => $location,
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
            $location = Location::find($decryptID);
            return view('backend.layouts.car.location.edit',[
                'location' => $location,
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
            'location' => ['required',
                Rule::unique('locations')->ignore($decryptID),
            ],
        ]);

        Location::updateLocation($request, $decryptID);
        return redirect('/locations')->with('message','Location update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Location::deleteLocation($id);
            return redirect('/locations')->with('message','Location delete successfully.');
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeStatusLocation($id)
    {
        try {
            $location = Location::select('status')->where('id',$id)->first();
            if($location->status == 'Published')
            {
                $status = 'Draft';
            }
            elseif($location->status == 'Draft')
            {
                $status = 'Published';
            }
            Location::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected location status changed successfully.');
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

}
