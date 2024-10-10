@extends('backend.app')

@section('title')
    Car Type
@endsection

@section('content')

    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('car-types.index') }}">Car Types</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create Car Type</li>
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
                    <div class="card-header pt-3 bg-transparent">
                        <p class="mb-0 pb-0 fs-4 fw-bold mx-auto">Create Car Type </p>
                    </div>
                    <div class="card-body">
                        <div class="border-0">
                            <form class="row g-3" action="{{ route('car-types.store') }}" method="POST">
                                @csrf
                                @method('POST')

                                <div class="col-12">
                                    <label for="name" class="form-label"> Car Type </label>
                                    <input class="form-control" type="text" name="name" id="name" placeholder="Enter car type" required />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div class="col-12 text-center">
                                    <button class="btn all-btn-same px-4" type="submit">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
