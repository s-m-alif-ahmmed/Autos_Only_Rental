@extends('backend.app')

@section('title')
    Car Bookings
@endsection

@section('content')

    <section class="py-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Bookings</li>
                        </ol>
                    </nav>
                </div>
            </div>

{{--            <div class="">--}}
{{--                <a class="btn all-btn-same rounded-3" href="{{ route('bookings.create') }}">Create Booking</a>--}}
{{--            </div>--}}

        </div>
        <!--end breadcrumb-->

        {{-- message --}}
        @if(session('message'))
            <p class="text-center text-muted">{{ session('message') }}</p>
        @endif
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom w-100" id="file-datatable" style="width:100%">
                        <thead>
                        <tr>
                            <th> SL </th>
                            <th> Created At </th>
                            <th> Booking </th>
                            <th> Booking Status </th>
                            <th> Actions </th>
                        </tr>
                        </thead>
                        <tbody id="category-table">
                        @foreach($bookings as $booking)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    {{ $booking->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                </td>
                                <td>{{$booking->car->name}}</td>
                                <td>
                                    <form action="{{ route('change.status.booking', $booking->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group my-auto align-items-center">
                                            <select name="status" onchange="this.form.submit()" class="form-control select2">
                                                <option value="Current" {{ $booking->status == 'Current' ? 'selected' : '' }}>Current</option>
                                                <option value="Completed" {{ $booking->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="Cancelled" {{ $booking->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <span class="d-inline-block ms-2" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="View">
                                            <a href="{{route('bookings.show', Crypt::encryptString($booking->id))}}" class="text-primary mx-1"><i class="fa fa-eye"></i></a>
                                        </span>
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                            <form action="{{ route('bookings.destroy', $booking->id )}}" method="post" id="deleteForm{{ $booking->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-danger border-0" type="button" onclick="return deleteAction('{{ $booking->id }}', 'Are you sure to delete this booking?', 'btn-danger')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

@endsection
