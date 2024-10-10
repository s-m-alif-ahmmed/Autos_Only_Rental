@extends('backend.app')

@section('title')
    Car Bookings
@endsection

@section('content')

    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('bookings.index') }}">Bookings</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Car Booking Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>

{{--            <div class="">--}}
{{--                <a class="btn all-btn-same rounded-3" href="{{ route('bookings.create') }}"> Create Booking</a>--}}
{{--            </div>--}}
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
                                <p class="fs-4 fw-bold my-auto">Booking Detail</p>
                            </div>
                            <div class="d-flex align-items-center">
{{--                                <a class="btn btn-primary mx-1" href="{{route('bookings.edit', Crypt::encryptString($booking->id))}}">--}}
{{--                                    Edit--}}
{{--                                </a>--}}
                                <form action="{{ route('change.status.booking', $booking->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group my-auto align-items-center mx-1">
                                        <select name="status" onchange="this.form.submit()" class="form-control select2">
                                            <option value="Current" {{ $booking->status == 'Current' ? 'selected' : '' }}>Current</option>
                                            <option value="Completed" {{ $booking->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="Cancelled" {{ $booking->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>
                                </form>
                                <form action="{{ route('bookings.destroy', $booking->id )}}" method="post" id="deleteForm{{ $booking->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger mx-1" type="button" onclick="return deleteAction('{{ $booking->id }}', 'Are you sure to delete this booking?', 'btn-danger')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body py-0">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label"> Created At </label>
                                    <p class="form-control" >
                                        {{ $booking->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                    </p>
                                </div>
                                @if($booking->user_id)
                                    <div class="col-6">
                                        <label class="form-label"> User Name </label>
                                        <p class="form-control" >
                                            {{ $booking->user->name }}
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label"> User Email </label>
                                        <p class="form-control" >
                                            {{ $booking->email }}
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label"> User Number </label>
                                        <p class="form-control" >
                                            {{ $booking->number }}
                                        </p>
                                    </div>
                                @endif
                                <div class="col-6">
                                    <label class="form-label"> Booking Name </label>
                                    <p class="form-control" >
                                        {{ $booking->name }}
                                    </p>
                                </div>
                                <div class="col-6">
                                    <label class="form-label"> Booking Email </label>
                                    <p class="form-control" >
                                        {{ $booking->email }}
                                    </p>
                                </div>
                                <div class="col-6">
                                    <label class="form-label"> Booking Number </label>
                                    <p class="form-control" >
                                        {{ $booking->number }}
                                    </p>
                                </div>
                                <div class="col-6">
                                    <label class="form-label"> Car Model </label>
                                    <p class="form-control" >
                                        {{ $booking->car->name }}
                                    </p>
                                </div>
                                <div class="col-6">
                                    <label class="form-label"> Car Location </label>
                                    <p class="form-control" >
                                        {{ $booking->car->location->location }}
                                    </p>
                                </div>
                                <div class="col-6">
                                    <label class="form-label"> Pickup Date </label>
                                    <p class="form-control" >
                                        {{ $booking->pickup_date }}
                                    </p>
                                </div>
                                <div class="col-6">
                                    <label class="form-label"> Drop Date </label>
                                    <p class="form-control" >
                                        {{ $booking->drop_date }}
                                    </p>
                                </div>
                                <div class="col-6">
                                    <label class="form-label"> Pickup Location </label>
                                    <p class="form-control" >
                                        {{ $booking->pickup_location }}
                                    </p>
                                </div>
                                <div class="col-6">
                                    <label class="form-label"> Drop Location </label>
                                    <p class="form-control" >
                                        {{ $booking->drop_location }}
                                    </p>
                                </div>
                                <div class="col-6">
                                    <label class="form-label"> Package </label>
                                    <p class="form-control" >
                                        {{ $booking->package }}
                                    </p>
                                </div>
                                <div class="col-6">
                                    <label class="form-label"> Price </label>
                                    <p class="form-control" >
                                        {{ $booking->price }}
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
