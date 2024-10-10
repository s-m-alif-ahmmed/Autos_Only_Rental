@extends('backend.app')

@section('title')
    Car
@endsection

@section('content')

    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('cars.index') }}">Cars</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Car Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="">
                <a class="btn all-btn-same rounded-3" href="{{ route('cars.create') }}"> Create Car</a>
            </div>
        </div>
        <!--end breadcrumb-->

        {{-- message --}}
        @if(session('message'))
            <p class="text-center text-primary">{{session('message')}}</p>
        @endif

        <hr/>
        <div class="container pb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pt-3 pb-2 border-bottom justify-content-between">
                            <div class="">
                                <p class="fs-4 fw-bold my-auto">Car Detail</p>
                            </div>
                            <div class="d-flex align-items-center">
                                @if($car->status == 'Published')
                                    <a href="{{ route('change.status.car', $car->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')" class="btn all-btn-same mx-1">Published</a>
                                @else($car->status == 'Draft')
                                    <a href="{{ route('change.status.car', $car->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger mx-1">Draft</a>
                                @endif
                                <a class="btn btn-primary mx-1" href="{{route('cars.edit', Crypt::encryptString($car->id))}}">
                                    Edit
                                </a>
                                <form action="{{ route('cars.destroy', $car->id )}}" method="post" id="deleteForm{{ $car->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger mx-1" type="button" onclick="return deleteAction('{{ $car->id }}', 'Are you sure to delete this car?', 'btn-danger')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body py-0">
                            <div class="row">

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 py-0 my-0">
                                    <label class="form-label"> Created At </label>
                                    <p class="form-control my-0" >
                                        {{ $car->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                    </p>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 py-0 my-0">
                                    <label class="form-label"> Car Model Name </label>
                                    <p class="form-control my-0" >
                                        {{ $car->name }}
                                    </p>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 py-0 my-0">
                                    <label class="form-label"> Slider Image </label>
                                    <img class="img-fluid m-2" src="{{ asset($car->slider_image) }}" alt="{{ $car->alt }}" style="height: 80px; width: auto;" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 py-0 my-0">
                                    <label class="form-label"> Car Image </label>
                                    <img class="img-fluid m-2" src="{{ asset($car->image) }}" alt="{{ $car->alt }}" style="height: 80px; width: auto;" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 py-0 my-0">
                                    <label class="form-label"> Car More Images </label>
                                    @foreach($car->moreImages as $image)
                                        <img class="img-fluid shadow m-2" src="{{ asset($image->more_image) }}" alt="{{ $image->alt }}" style="height: 80px; width: auto;" />
                                    @endforeach
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 py-0 my-0">
                                    <label class="form-label"> Location </label>
                                    <p class="form-control" >
                                        {{ $car->location->location }}
                                    </p>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 py-0 my-0">
                                    <label class="form-label">Drop Locations</label>
                                    <p class="form-control">
                                        {{ implode(', ', $car->drop_location) }}
                                    </p>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 py-0 my-0">
                                    <label class="form-label"> Car Type </label>
                                    <p class="form-control my-0" >
                                        {{ $car->car_type->name }}
                                    </p>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 py-0 my-0">
                                    <label class="form-label"> Car Quantity </label>
                                    <p class="form-control my-0" >
                                        {{ $car->quantity }}
                                    </p>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 py-0 my-0">
                                    <label class="form-label"> Seat </label>
                                    <p class="form-control my-0" >
                                        {{ $car->seat }}
                                    </p>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 py-0 my-0">
                                    <label class="form-label"> Seating Capacity </label>
                                    <p class="form-control my-0" >
                                        {{ $car->person }}
                                    </p>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 py-0 my-0">
                                    <label class="form-label"> Engine Type </label>
                                    <p class="form-control my-0" >
                                        {{ $car->engine_type }}
                                    </p>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 py-0 my-0">
                                    <label class="form-label"> Day Price </label>
                                    <p class="form-control my-0" >
                                        {{ $car->day_price }}
                                    </p>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 py-0 my-0">
                                    <label class="form-label"> Weekly Price </label>
                                    <p class="form-control my-0" >
                                        {{ $car->week_price }}
                                    </p>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 py-0 my-0">
                                    <label class="form-label"> Monthly Price </label>
                                    <p class="form-control my-0" >
                                        {{ $car->month_price }}
                                    </p>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 py-0 my-0">
                                    <label class="form-label"> Is Available </label>
                                    <p class="form-control my-0" >
                                        {{ $car->is_available }}
                                    </p>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 py-2 ">
                                    <label class="form-label"> Description </label>
                                    <p class="">
                                        {!! $car->description !!}
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
