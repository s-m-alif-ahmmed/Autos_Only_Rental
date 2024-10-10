<?php

namespace App\Models\Car;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoreImage extends Model
{
    use HasFactory;

    private static $moreImage, $moreImages, $image, $imageName, $directory, $imageUrl, $extension;

    private static function getImageUrl($image)
    {
        self::$extension = $image->getClientOriginalExtension();
        self::$imageName = rand(1000, 99999).'.'.self::$extension; // 132131.jpg
        self::$directory = 'backend/images/car/more-images/';
        $image->move(self::$directory, self::$imageName);
        return self::$directory.self::$imageName;
    }

    public static function createCarMoreImage($request, $id)
    {
        foreach ($request->more_image as $image)
        {
            self::$moreImage = new MoreImage();
            self::$moreImage->car_id   = $id;
            self::$moreImage->more_image        = self::getImageUrl($image);
            self::$moreImage->save();
        }
    }

    public static function updateCarMoreImage($request, $id)
    {
        self::deleteCarMoreImage($id);
        self::createCarMoreImage($request, $id);
    }

    public static function deleteCarMoreImage($id){
        self::$moreImages = MoreImage::where('car_id', $id)->get();
        foreach (self::$moreImages as $moreImage)
        {
            if (file_exists($moreImage->more_image))
            {
                unlink($moreImage->more_image);
            }
            $moreImage->delete();
        }
    }

}
