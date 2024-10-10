<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Faq extends Model
{
    use HasFactory;

    private static $faq, $faqs;

    public static function createFaq($request)
    {
        try {
            self::$faq       = new Faq();
            self::saveBasicInfo(self::$faq, $request);
            self::$faq->save();
            return self::$faq;
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    public static function updateFaq($request, $id)
    {
        try {
            self::$faq = Faq::find($id);
            self::saveBasicInfo(self::$faq, $request);
            self::$faq->save();
            return self::$faq;
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    public static function deleteFaq($id)
    {
        try {
            self::$faq = Faq::find($id);
            self::$faq->delete();
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    private static function saveBasicInfo($faq, $request)
    {
        self::$faq->question         = $request->question;
        self::$faq->answer           = $request->answer;
    }

}
