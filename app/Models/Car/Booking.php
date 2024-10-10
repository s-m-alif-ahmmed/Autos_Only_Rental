<?php

namespace App\Models\Car;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'name',
        'email',
        'number',
        'pickup_location',
        'drop_location',
        'pickup_date',
        'drop_date',
        'package',
        'price',
        'status',
    ];

    private static $booking;

    public static function createBooking(array $data) // Accept an array
    {
        try {
            self::$booking = new Booking();
            self::saveBasicInfo(self::$booking, $data);
            self::$booking->save();
            return self::$booking;
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    public static function updateBooking(array $data, $id)
    {
        try {
            self::$booking = Booking::findOrFail($id); // Use findOrFail to handle missing booking
            self::saveBasicInfo(self::$booking, $data);
            self::$booking->save();
            return self::$booking;
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    public static function deleteBooking($id)
    {
        try {
            self::$booking = Booking::findOrFail($id);
            self::$booking->delete();
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    private static function saveBasicInfo(Booking $booking, array $data) // Expect an array
    {
        $booking->user_id           = $data['user_id'] ?? null;
        $booking->car_id            = $data['car_id'];
        $booking->name              = $data['name'];
        $booking->email             = $data['email'];
        $booking->number            = $data['number'];
        $booking->pickup_location   = $data['pickup_location'];
        $booking->drop_location     = $data['drop_location'];
        $booking->pickup_date       = $data['pickup_date'];
        $booking->drop_date         = $data['drop_date'];
        $booking->package           = $data['package'];
        $booking->price             = $data['price'];
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
