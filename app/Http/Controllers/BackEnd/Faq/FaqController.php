<?php

namespace App\Http\Controllers\BackEnd\Faq;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $faq = Faq::query();
            $faqs = $faq->latest()->get();
            return view('backend.layouts.faq.index',[
                'faqs' => $faqs,
            ]);
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('backend.layouts.faq.create');
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => ['required', 'unique:'.Faq::class],
            'answer' => 'required',
        ]);
        Faq::createFaq($request);
        return redirect('/faqs')->with('message', 'Faq saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            $faq = Faq::find($decryptID);
            return view('backend.layouts.faq.detail',[
                'faq' => $faq,
            ]);
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            $faq = Faq::find($decryptID);
            return view('backend.layouts.faq.edit',[
                'faq' => $faq,
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
            'question' => ['required',
                Rule::unique('faqs')->ignore($decryptID),
            ],
            'answer' => 'required',
        ]);

        Faq::updateFaq($request, $decryptID);
        return redirect('/faqs')->with('message','Faq update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Faq::deleteFaq($id);
            return redirect('/faqs')->with('message','Faq delete successfully.');
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeStatusFaq($id)
    {
        try {
            $faq = Faq::select('status')->where('id',$id)->first();
            if($faq->status == 'Published')
            {
                $status = 'Draft';
            }
            elseif($faq->status == 'Draft')
            {
                $status = 'Published';
            }
            Faq::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected faq status changed successfully.');
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
