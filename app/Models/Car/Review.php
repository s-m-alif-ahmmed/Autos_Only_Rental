<?php

namespace App\Models\Car;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'booking_id',
        'star',
        'review',
    ];

    private static $review;

    public static function createReview($request)
    {
        try {
            self::$review = new Review();
            self::saveBasicInfo(self::$review, $request);
            self::$review->save();
            return self::$review;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public static function updateReview($request, $id)
    {
        try {
            self::$review = Review::findOrFail($id);
            self::saveBasicInfo(self::$review, $request);
            self::$review->save();
            return self::$review;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public static function deleteReview($id)
    {
        try {
            self::$review = Review::findOrFail($id);
            self::$review->delete();
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    private static function saveBasicInfo($review, $request)
    {
        $review->user_id           = $request->user_id;
        $review->car_id            = $request->car_id;
        $review->booking_id        = $request->booking_id;
        $review->star              = $request->star;
        $review->review            = $request->review;
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
