<?php

namespace App\Models\Car;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class CarType extends Model
{
    use HasFactory;

    private static $car_type, $car_types;

    public static function createCarType($request)
    {
        try {
            self::$car_type       = new CarType();
            self::saveBasicInfo(self::$car_type, $request);
            self::$car_type->save();
            return self::$car_type;
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    public static function updateCarType($request, $id)
    {
        try {
            self::$car_type = CarType::find($id);
            self::saveBasicInfo(self::$car_type, $request);
            self::$car_type->save();
            return self::$car_type;
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    public static function deleteCarType($id)
    {
        try {
            self::$car_type = CarType::find($id);
            self::$car_type->delete();
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($car_type){
            $car_type->car_type_slug = Str::slug($car_type->name, '-');

        });
        self::updating(function($car_type){
            $car_type->car_type_slug = Str::slug($car_type->name, '-');
        });
    }

    private static function saveBasicInfo($car_type, $request)
    {
        self::$car_type->name           = $request->name;
    }

    public function cars()
    {
        return $this->hasMany(Car::class); // Adjust the relationship type as needed
    }

}
