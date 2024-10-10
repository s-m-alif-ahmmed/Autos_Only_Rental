<?php

namespace App\Http\Controllers\BackEnd\DynamicPage;

use App\Http\Controllers\Controller;
use App\Models\DynamicPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
class DynamicPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $dynamic_pages = DynamicPage::latest()->get();
            return view('backend.layouts.dynamic_page.index', ['dynamic_pages' => $dynamic_pages]);
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
            return view('backend.layouts.dynamic_page.create');
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
            'content' => ['required'],
            'title' => ['required'],
        ]);
        DynamicPage::createDynamicPage($request);
        return redirect('/dynamic-page')->with('message', 'Dynamic Page saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $decryptId = Crypt::decryptString($id);
            $dynamic_page = DynamicPage::findOrFail($decryptId);
            return view('backend.layouts.dynamic_page.detail', ['dynamic_page' => $dynamic_page]);
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
            $decryptId = Crypt::decryptString($id);
            $dynamic_page = DynamicPage::findOrFail($decryptId);
             return view('backend.layouts.dynamic_page.edit', ['dynamic_page' => $dynamic_page]);
         }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'content' => ['required'],
            'title' => ['required'],
        ]);
        $decryptId = Crypt::decryptString($id);
        DynamicPage::updateDynamicPage($request, $decryptId);;
        return redirect('/dynamic-page')->with('message', 'Dynamic Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DynamicPage::deleteDynamicPage($id);
        return redirect('/dynamic-page')->with('message', 'Dynamic Page deleted successfully.');
    }

    /**
     * Change Status the specified resource.
     */
    public function changeStatusDynamicPage($id)
    {
        try {
            $dynamic_page = DynamicPage::select('status')->where('id',$id)->first();
            if($dynamic_page->status == 'Published')
            {
                $status = 'Draft';
            }
            elseif($dynamic_page->status == 'Draft')
            {
                $status = 'Published';
            }
            DynamicPage::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected dynamic page status changed successfully.');
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

}
