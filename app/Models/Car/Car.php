<?php

namespace App\Models\Car;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class Car extends Model
{
    use HasFactory;

    private static $car, $cars;
    private static $image, $directory, $imageName, $imageUrl;
    private static $sliderImage, $sliderDirectory, $sliderImageName, $sliderImageUrl;
    protected $fillable = [
        'location_id',
        'car_type_id',
        'name',
        'image',
        'slider_image',
        'quantity',
        'person',
        'seat',
        'engine_type',
        'description',
        'day_price',
        'week_price',
        'month_price',
        'is_available',
    ];

    protected $casts = [
        'drop_location' => 'array', // Cast drop_location to array
    ];

    public static function uploadSliderImage($request)
    {
        try {
            self::$sliderImage = $request->file('slider_image');
            self::$sliderImageName = rand(10000, 99999).'_'.self::$sliderImage->getClientOriginalName();
            self::$sliderDirectory = "backend/images/car/slider-images/";
            self::$sliderImage->move(self::$sliderDirectory, self::$sliderImageName);
            self::$sliderImageUrl = self::$sliderDirectory.self::$sliderImageName;
            return self::$sliderDirectory.self::$sliderImageName;
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    public static function uploadImage($request)
    {
        try {
            self::$image = $request->file('image');
            self::$imageName = rand(10000, 99999).'_'.self::$image->getClientOriginalName();
            self::$directory = "backend/images/car/car/";
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl = self::$directory.self::$imageName;
            return self::$directory.self::$imageName;
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    public static function createCar($request)
    {
        try {
            self::$imageUrl         = self::uploadImage($request);
            self::$sliderImageUrl   = self::uploadSliderImage($request);
            self::$car              = new Car();

            // Ensure drop_location is handled as an array
            $request->merge(['drop_location' => json_encode($request->drop_location)]);

            self::saveBasicInfo(self::$car, $request, self::$imageUrl, self::$sliderImageUrl);
            self::$car->save();
            return self::$car;
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    public static function updateCar($request, $id)
    {
        try {
            self::$car = Car::find($id);
            if($request->file('image'))
            {
                if(file_exists(self::$car->image)){
                    unlink(self::$car->image);
                }
                self::$imageUrl = self::uploadImage($request);
            }
            else{
                self::$imageUrl = self::$car->image;
            }
            if($request->file('slider_image'))
            {
                if(file_exists(self::$car->slider_image)){
                    unlink(self::$car->slider_image);
                }
                self::$sliderImageUrl = self::uploadSliderImage($request);
            }
            else{
                self::$sliderImageUrl = self::$car->slider_image;
            }

            self::$car->drop_location = $request->drop_location;

            self::saveBasicInfo(self::$car, $request, self::$imageUrl, self::$sliderImageUrl);
            self::$car->save();
            return self::$car;
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    public static function deleteCar($id)
    {
        try {
            self::$car = Car::find($id);
            if (file_exists(self::$car->image))
            {
                unlink(self::$car->image);
            }
            if (file_exists(self::$car->slider_image))
            {
                unlink(self::$car->slider_image);
            }
            self::$car->delete();
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($car){
            $car->car_slug = Str::slug(rand(10000, 99999).'-'.$car->name, '-');
            $car->alt = Str::slug($car->name, '-');

        });
        self::updating(function($car){
            $car->car_slug = Str::slug(rand(10000, 99999).'-'.$car->name, '-');
            $car->alt = Str::slug($car->name, '-');
        });
    }

    private static function saveBasicInfo($car, $request, $imageUrl, $sliderImageUrl)
    {
        self::$car->slider_image        = $sliderImageUrl;
        self::$car->image               = $imageUrl;
        self::$car->location_id         = $request->location_id;
        // Decode the JSON back to an array
        self::$car->drop_location = json_decode($request->drop_location);

        self::$car->car_type_id         = $request->car_type_id;
        self::$car->name                = $request->name;
        self::$car->quantity            = $request->quantity;
        self::$car->person              = $request->person;
        self::$car->seat                = $request->seat;
        self::$car->engine_type         = $request->engine_type;
        self::$car->day_price           = $request->day_price;
        self::$car->week_price          = $request->week_price;
        self::$car->month_price         = $request->month_price;
        self::$car->is_available        = $request->is_available;
        self::$car->description         = $request->description;
    }

    public function getDropLocationAttribute($value)
    {
        return is_string($value) ? json_decode($value, true) : (array) $value;
    }


    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function car_type()
    {
        return $this->belongsTo(CarType::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function moreImages()
    {
        return $this->hasMany(MoreImage::class);
    }


}
