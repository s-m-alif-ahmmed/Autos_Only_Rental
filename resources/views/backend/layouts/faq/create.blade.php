@extends('backend.app')

@section('title')
    Faq
@endsection

@section('content')

    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('faqs.index') }}">Faqs</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create Faq</li>
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
                        <p class="mb-0 pb-0 fs-4 fw-bold mx-auto">Create Faq </p>
                    </div>
                    <div class="card-body">
                        <div class="border-0">
                            <form class="row g-3" action="{{ route('faqs.store') }}" method="POST">
                                @csrf
                                @method('POST')

                                <div class="col-12">
                                    <label for="question" class="form-label"> Question </label>
                                    <input class="form-control" type="text" name="question" id="question" placeholder="Enter faq question" required />
                                    <x-input-error :messages="$errors->get('question')" class="mt-2" />
                                </div>

                                <div class="col-12">
                                    <label for="answer" class="form-label"> Answer </label>
                                    <textarea class="form-control" name="answer" id="answer" cols="30" rows="3" placeholder="Enter faq answer" required ></textarea>
                                    <x-input-error :messages="$errors->get('answer')" class="mt-2" />
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
