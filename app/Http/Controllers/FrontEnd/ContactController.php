<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $contact = Contact::query();
            $contacts = $contact->latest()->get();
            return view('backend.layouts.contact.index',[
                'contacts' => $contacts,
            ]);
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string',
            'number' => 'required|regex:/^\d{11}$/',
            'message' => 'required|string',
        ]);
        Contact::createContact($request);
        return redirect()->back()->with('message', 'Contact message sent successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            $contact = Contact::find($decryptID);
            return view('backend.layouts.contact.detail',[
                'contact' => $contact,
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
            'note' => 'required|string',
        ]);

        Contact::updateContact($request, $decryptID);
        return redirect()->back()->with('message','Contact message note update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Contact::deleteContact($id);
            return redirect('/contacts')->with('message','Contact message delete successfully.');
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeStatusContact($id)
    {
        try {
            $contact = Contact::select('status')->where('id',$id)->first();
            if($contact->status == 'Unread')
            {
                $status = 'Read';
            }
            elseif($contact->status == 'Read')
            {
                $status = 'Unread';
            }
            Contact::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected contact message status changed successfully.');
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


}
