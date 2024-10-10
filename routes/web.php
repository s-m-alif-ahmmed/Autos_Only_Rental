<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\BackEnd\Dashboard\DashboardController;
use App\Http\Controllers\BackEnd\Car\CarController;
use App\Http\Controllers\BackEnd\Car\LocationController;
use App\Http\Controllers\BackEnd\Car\CarTypeController;
use App\Http\Controllers\BackEnd\Faq\FaqController;
use App\Http\Controllers\FrontEnd\ContactController;
use App\Http\Controllers\BackEnd\Car\BookingController;
use App\Http\Controllers\BackEnd\Car\ReviewController;
use App\Http\Controllers\FrontEnd\SearchController;
use App\Http\Controllers\BackEnd\DynamicPage\DynamicPageController;


Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/car-listing',[HomeController::class,'listing'])->name('home.listing');
Route::get('/car-detail/{car_slug}',[HomeController::class,'carDetail'])->name('home.car.detail');
Route::get('/about',[HomeController::class,'about'])->name('home.about');
Route::get('/faq',[HomeController::class,'faq'])->name('home.faq');

//  Search
Route::get('/search',[SearchController::class,'search'])->name('home.search');

//Car Filter
Route::get('/filter-cars', [SearchController::class, 'filterCars'])->name('filter.cars');
Route::get('/search-filter-cars', [SearchController::class, 'searchFilterCars'])->name('search.filter.cars');

//  Contact
Route::post('/contacts/store',[ContactController::class,'store'])->name('home.contact.store');

//  Car Booking
Route::post('/car-bookings/store',[BookingController::class,'store'])->name('home.booking.store');

Route::middleware([UserMiddleware::class])->group(function (){

    Route::get('/user-profile',[DashboardController::class,'userProfile'])->name('user.profile');

    Route::get('/edit-profile', [HomeController::class, 'editProfile'])->name('edit.profile');
    Route::get('/rent-history', [HomeController::class, 'rentHistory'])->name('rent.history');

//    Booking Cancel
    Route::get('/car-bookings/cancel/{id}',[BookingController::class,'changeStatusBookingCancel'])->name('home.booking.cancel');

//  Car Review
    Route::post('/car-review/store',[ReviewController::class,'store'])->name('home.review.store');

});

Route::middleware(['auth', 'verified', AdminMiddleware::class])->group(function (){

//  Dashboard
    Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');

//  Location
    Route::resource('/locations',LocationController::class);
    Route::get('/location/change-status-location/{id}',[LocationController::class,'changeStatusLocation'])->name('change.status.location');

//  Car Type
    Route::resource('/car-types',CarTypeController::class);
    Route::get('/car-type/change-status-car-types/{id}',[CarTypeController::class,'changeStatusCarType'])->name('change.status.car.type');

//  Car
    Route::resource('/cars',CarController::class);
    Route::get('/car/change-status-car/{id}',[CarController::class,'changeStatusCar'])->name('change.status.car');

//  Faqs
    Route::resource('/faqs',FaqController::class);
    Route::get('/faq/change-status-faq/{id}',[FaqController::class,'changeStatusFaq'])->name('change.status.faq');

//  Faqs
    Route::resource('/dynamic-page',DynamicPageController::class);
    Route::get('/dynamic-page/change-status-dynamic-page/{id}',[DynamicPageController::class,'changeStatusDynamicPage'])->name('change.status.dynamic.page');


//  Contact Messages
    Route::get('/contacts',[ContactController::class,'index'])->name('contacts.index');
    Route::get('/contacts/show/{id}',[ContactController::class,'show'])->name('contacts.show');
    Route::patch('/contacts/update/{id}',[ContactController::class,'update'])->name('contacts.update');
    Route::delete('/contacts/delete/{id}',[ContactController::class,'destroy'])->name('contacts.destroy');
    Route::get('/contact/change-status-contact/{id}',[ContactController::class,'changeStatusContact'])->name('change.status.contact');

//  Car Booking
    Route::get('/car-bookings',[BookingController::class,'index'])->name('bookings.index');
    Route::get('/car-bookings/show/{id}',[BookingController::class,'show'])->name('bookings.show');
    Route::patch('/car-bookings/update/{id}',[BookingController::class,'update'])->name('bookings.update');
    Route::delete('/car-bookings/delete/{id}',[BookingController::class,'destroy'])->name('bookings.destroy');
    Route::post('/car-booking/change-status-car-booking/{id}',[BookingController::class,'changeStatusBooking'])->name('change.status.booking');

//  Car Review
    Route::get('/car-reviews',[ReviewController::class,'index'])->name('reviews.index');
    Route::get('/car-reviews/show/{id}',[ReviewController::class,'show'])->name('reviews.show');
    Route::delete('/car-reviews/delete/{id}',[ReviewController::class,'destroy'])->name('reviews.destroy');
    Route::post('/car-review/change-status-car-review/{id}',[ReviewController::class,'changeStatusReview'])->name('change.status.review');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
