<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Contact extends Model
{
    use HasFactory;

    private static $contact, $contacts;

    protected $fillable = [
      'name',
      'email',
      'number',
      'message',
      'note'
    ];

    public static function createContact($request)
    {
        try {
            self::$contact       = new Contact();
            self::saveBasicInfo(self::$contact, $request);
            self::$contact->save();
            return self::$contact;
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    public static function updateContact($request, $id)
    {
        try {
            self::$contact = Contact::find($id);
            self::saveBasicInfo(self::$contact, $request);
            self::$contact->save();
            return self::$contact;
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    public static function deleteContact($id)
    {
        try {
            self::$contact = Contact::find($id);
            self::$contact->delete();
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    private static function saveBasicInfo($contact, $request)
    {
        self::$contact->name         = $request->name;
        self::$contact->email        = $request->email;
        self::$contact->number       = $request->number;
        self::$contact->message      = $request->message;
        self::$contact->note         = $request->note;
    }


}
