<?php

namespace App\Http\Controllers\BackEnd\Car;

use App\Http\Controllers\Controller;
use App\Models\Car\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $reviews = Review::query()->latest()->get();
            return view('backend.layouts.car.review.index',[
                'reviews' => $reviews,
            ]);
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function store(Request $request){
        $validated = $request->validate([
            'user_id' => 'nullable',
            'car_id' => 'nullable',
            'booking_id' => 'nullable',
            'star' => 'required|numeric|min:1|max:5',
            'review' => 'required|string',
        ]);
        Review::createReview($request);
        return redirect()->back()->with('message', 'Review sent successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            $review = Review::find($decryptID);
            return view('backend.layouts.car.review.detail',[
                'review' => $review,
            ]);
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Review::deleteReview($id);
            return redirect('/reviews')->with('message','Review delete successfully.');
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeStatusReview($id)
    {
        try {
            $review = Review::select('status')->where('id',$id)->first();
            if($review->status == 'Unread')
            {
                $status = 'Read';
            }
            elseif($review->status == 'Read')
            {
                $status = 'Unread';
            }
            Review::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected review status changed successfully.');
        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

}
