<?php

namespace App\Models\Car;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class Location extends Model
{
    use HasFactory;

    private static $location, $locations;

    public static function createLocation($request)
    {
        try {
            self::$location       = new Location();
            self::saveBasicInfo(self::$location, $request);
            self::$location->save();
            return self::$location;
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    public static function updateLocation($request, $id)
    {
        try {
            self::$location = Location::find($id);
            self::saveBasicInfo(self::$location, $request);
            self::$location->save();
            return self::$location;
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    public static function deleteLocation($id)
    {
        try {
            self::$location = Location::find($id);
            self::$location->delete();
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($location){
            $location->location_slug = Str::slug($location->location, '-');

        });
        self::updating(function($location){
            $location->location_slug = Str::slug($location->location, '-');
        });
    }

    private static function saveBasicInfo($location, $request)
    {
        self::$location->location           = $request->location;
    }

    public function cars()
    {
        return $this->hasMany(Car::class); // Adjust the relationship type as needed
    }

}
