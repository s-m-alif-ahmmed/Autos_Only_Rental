@extends('backend.app')

@section('title')
    Location
@endsection

@section('content')

    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('locations.index') }}">Locations</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Location Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="">
                <a class="btn all-btn-same rounded-3" href="{{ route('locations.create') }}"> Create Location</a>
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
                                <p class="fs-4 fw-bold my-auto">Location Detail</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <a class="btn btn-primary mx-1" href="{{route('locations.edit', Crypt::encryptString($location->id))}}">
                                    Edit
                                </a>
                                <form action="{{ route('locations.destroy', $location->id )}}" method="post" id="deleteForm{{ $location->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger mx-1" type="button" onclick="return deleteAction('{{ $location->id }}', 'Are you sure to delete this location?', 'btn-danger')">
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
                                        {{ $location->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                    </p>
                                </div>
                                <div class="col-6">
                                    <label class="form-label"> Location </label>
                                    <p class="form-control" >
                                        {{ $location->location }}
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
