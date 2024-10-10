@extends('backend.app')

@section('title')
    Car
@endsection

@section('content')

    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('cars.index') }}">Cars</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Car</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        {{-- message --}}
        @if(session('message'))
            <p class="text-center text-primary">{{session('message')}}</p>
        @endif

        <hr>
        <!-- Create Category Form-->
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <p class="mb-0 pb-0 fs-4 fw-bold mx-auto">Edit Car </p>
                    </div>
                    <div class="card-body">
                        <div class="border-0 ">
                            <form class="row g-3" method="post" action="{{route('cars.update', Crypt::encryptString($car->id) )}}" enctype="multipart/form-data">
                                @csrf
                                @method('patch')

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-0">
                                    <label for="location_id" class="form-label"> Location </label>
                                    <div class="form-group my-0">
                                        <select class="form-control select2" name="location_id" id="location_id" data-placeholder="Choose one location" required >
                                            <option value="">Select Location</option>
                                            @foreach($locations as $location)
                                                <option value="{{ $location->id }}" {{ $location->id == $car->location_id ? 'selected' : '' }}>{{ $location->location }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('location_id')" class="mt-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-0">
                                    <label for="drop_location" class="form-label">Drop Locations</label>
                                    <div class="form-group my-0">
                                        <select class="form-control select2" name="drop_location[]" id="drop_location" multiple required>
                                            @php
                                                // Ensure $car->drop_location is either an array or JSON string
                                                $dropLocations = is_string($car->drop_location)
                                                    ? json_decode($car->drop_location, true)
                                                    : (array) $car->drop_location;
                                            @endphp

                                            @foreach($locations as $location)
                                                <option value="{{ $location->location }}"
                                                    {{ in_array($location->location, $dropLocations) ? 'selected' : '' }}>
                                                    {{ $location->location }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('drop_location')" class="mt-2" />
                                </div>


                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-0">
                                    <label for="car_type_id" class="form-label"> Car Type </label>
                                    <div class="form-group my-0">
                                        <select class="form-control select2" name="car_type_id" id="car_type_id" data-placeholder="Choose one car type" required >
                                            <option value="">Select Car Type</option>
                                            @foreach($car_types as $type)
                                                <option value="{{ $type->id }}" {{ $type->id == $car->car_type_id ? 'selected' : '' }}>{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('car_type_id')" class="mt-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-0">
                                    <label for="name" class="form-label"> Car Model Name </label>
                                    <input class="form-control" type="text" name="name" id="name" placeholder="Enter car model name" value="{{ $car->name }}" required />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-0">
                                    <label for="quantity" class="form-label"> Car Quantity </label>
                                    <input class="form-control" type="number" name="quantity" id="quantity" placeholder="Enter car quantity" value="{{ $car->quantity }}" required />
                                    <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-0">
                                    <label for="slider_image" class="form-label"> Slider Image </label>
                                    <input class="form-control" type="file" name="slider_image" id="slider_image" value="{{ $car->slider_image }}" accept="image/jpeg, image/png, image/jpg" />
                                    <img class="img-fluid m-2" src="{{ asset($car->slider_image) }}" alt="{{ $car->alt }}" style="height: 80px; width: auto;" />
                                    <x-input-error :messages="$errors->get('slider_image')" class="mt-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-0">
                                    <label for="image" class="form-label"> Image </label>
                                    <input class="form-control" type="file" name="image" id="image" value="{{ $car->image }}" accept="image/jpeg, image/png, image/jpg" />
                                    <img class="img-fluid m-2" src="{{ asset($car->image) }}" alt="{{ $car->alt }}" style="height: 80px; width: auto;" />
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-0">
                                    <label for="more_image" class="form-label"> More Images </label>
                                    <input class="form-control" type="file" name="more_image[]" id="more_image" value="{{ $car->more_image }}" accept="image/jpeg, image/png, image/jpg" multiple />
                                    @foreach($car->moreImages as $image)
                                        <img class="img-fluid shadow px-3" src="{{ asset($image->more_image) }}" alt="{{ $image->alt }}" style="height: 80px; width: auto;" />
                                    @endforeach
                                    <x-input-error :messages="$errors->get('more_image')" class="mt-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-0">
                                    <label for="seat" class="form-label"> Car Seat </label>
                                    <input class="form-control" type="number" name="seat" id="seat" placeholder="Enter car seat" value="{{ $car->seat }}" required />
                                    <x-input-error :messages="$errors->get('seat')" class="mt-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-0">
                                    <label for="person" class="form-label"> Seating Person Capacity </label>
                                    <input class="form-control" type="number" name="person" id="person" placeholder="Enter car seating person capacity" value="{{ $car->person }}" required />
                                    <x-input-error :messages="$errors->get('person')" class="mt-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-0">
                                    <label for="engine_type" class="form-label"> Car Engine </label>
                                    <input class="form-control" type="text" name="engine_type" id="engine_type" placeholder="Enter car engine type" value="{{ $car->engine_type }}" required />
                                    <x-input-error :messages="$errors->get('engine_type')" class="mt-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-0">
                                    <label for="day_price" class="form-label"> Day Price </label>
                                    <input class="form-control" type="text" name="day_price" id="day_price" placeholder="Enter day price" value="{{ $car->day_price }}" required />
                                    <x-input-error :messages="$errors->get('day_price')" class="mt-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-0">
                                    <label for="week_price" class="form-label"> Weekly Price </label>
                                    <input class="form-control" type="text" name="week_price" id="week_price" placeholder="Enter week price" value="{{ $car->week_price }}" required />
                                    <x-input-error :messages="$errors->get('week_price')" class="mt-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-0">
                                    <label for="month_price" class="form-label"> Monthly Price </label>
                                    <input class="form-control" type="text" name="month_price" id="month_price" placeholder="Enter month price" value="{{ $car->month_price }}" required />
                                    <x-input-error :messages="$errors->get('month_price')" class="mt-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-0">
                                    <label for="is_available" class="form-label"> Is Available </label>
                                    <div class="form-group my-0">
                                        <select class="form-control select2" name="is_available" id="is_available" data-placeholder="Choose one" required >
                                            <option value="{{ $car->is_available }}" selected>{{ $car->is_available }}</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('is_available')" class="mt-2" />
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 my-0">
                                    <label class="form-label"> Description </label>
                                    <textarea name="description" id="editor" cols="30" rows="5" placeholder="Enter description" required>{{ $car->description }}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>

                                <div class="col-12 text-center">
                                    <button class="btn all-btn-same px-4" type="submit">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
