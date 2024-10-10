<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class DynamicPage extends Model
{
    use HasFactory;

    private static $dynamicPage, $dynamicPages;

    protected $fillable = [
        'content',
        'title',
    ];

    public static function createDynamicPage($request)
    {
        try {
            self::$dynamicPage = new DynamicPage();
            self::saveBasicInfo(self::$dynamicPage, $request);
            self::$dynamicPage->save();
            return self::$dynamicPage;
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    public static function updateDynamicPage($request, $id)
    {
        try {
            self::$dynamicPage = DynamicPage::find($id);
            self::saveBasicInfo(self::$dynamicPage, $request);
            self::$dynamicPage->save();
            return self::$dynamicPage;
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    public static function deleteDynamicPage($id)
    {
        try {
            self::$dynamicPage = DynamicPage::find($id);
            self::$dynamicPage->delete();
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($dynamicPage){
            $dynamicPage->page_slug = Str::slug($dynamicPage->title, '-');

        });
        self::updating(function($dynamicPage){
            $dynamicPage->page_slug = Str::slug($dynamicPage->title, '-');
        });
    }

    private static function saveBasicInfo($dynamicPage, $request)
    {
        self::$dynamicPage->content = $request->content;
        self::$dynamicPage->title = $request->title;
    }

}

