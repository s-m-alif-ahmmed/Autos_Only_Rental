@extends('backend.app')

@section('title')
    Dynamic Page
@endsection

@section('content')

    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('dynamic-page.index') }}">Dynamic Pages</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create Dynamic Page</li>
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
                        <p class="mb-0 pb-0 fs-4 fw-bold mx-auto">Create Dynamic Page </p>
                    </div>
                    <div class="card-body">
                        <div class="border-0">
                            <form class="row g-3" action="{{ route('dynamic-page.store') }}" method="POST">
                                @csrf
                                @method('POST')

                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 my-0">
                                    <label for="title" class="form-label"> Page Name </label>
                                    <input class="form-control" type="text" name="title" id="name" placeholder="Enter page name" required />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 my-0">
                                    <label class="form-label"> Content </label>
                                    <textarea name="content" id="editor" cols="30" rows="5" placeholder="Enter content" required></textarea>
                                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
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


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.0/jquery.easing.js" type="text/javascript"></script>

@endsection
