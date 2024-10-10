@extends('backend.app')

@section('title')
    Car
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
                            <li class="breadcrumb-item active" aria-current="page">Manage Cars</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="">
                <a class="btn all-btn-same rounded-3" href="{{ route('cars.create') }}">Create Car</a>
            </div>

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
                            <th> Car </th>
                            <th> Image </th>
                            <th> Seat </th>
                            <th> Engine Type </th>
                            <th> Status </th>
                            <th> Actions </th>
                        </tr>
                        </thead>
                        <tbody id="category-table">
                        @foreach($cars as $car)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    {{ $car->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                </td>
                                <td>
                                    {{$car->name}}
                                </td>
                                <td>
                                    @if($car->image)
                                        <img class="img-fluid" src="{{ asset($car->image) }}" alt="{{ $car->image_alt }}" style="height: 60px; width: auto;">
                                    @endif
                                </td>
                                <td>
                                    {{$car->seat}}
                                </td>
                                <td>
                                    {{$car->engine_type}}
                                </td>
                                <td>
                                    @if($car->status == 'Published')
                                        <a href="{{ route('change.status.car', $car->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')" class="btn all-btn-same">Published</a>
                                    @else($car->status == 'Draft')
                                        <a href="{{ route('change.status.car', $car->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger">Draft</a>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <span class="d-inline-block ms-2" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="View">
                                            <a href="{{route('cars.show', Crypt::encryptString($car->id))}}" class="text-primary mx-1"><i class="fa fa-eye"></i></a>
                                        </span>
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Edit">
                                            <a href="{{route('cars.edit', Crypt::encryptString($car->id))}}" class="text-warning mx-1"><i class="fa fa-edit"></i></a>
                                        </span>
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                            <form action="{{ route('cars.destroy', $car->id )}}" method="post" id="deleteForm{{ $car->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-danger border-0" type="button" onclick="return deleteAction('{{ $car->id }}', 'Are you sure to delete this car?', 'btn-danger')">
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
