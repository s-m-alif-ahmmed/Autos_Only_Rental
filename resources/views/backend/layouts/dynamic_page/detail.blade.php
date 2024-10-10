@extends('backend.app')

@section('title')
    Dynamic Page
@endsection

@section('content')

    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('dynamic-page.index') }}">Dynamic Pages</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Dynamic Page Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="">
                <a class="btn all-btn-same rounded-3" href="{{ route('dynamic-page.create') }}"> Create Dynamic Page</a>
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
                                <p class="fs-4 fw-bold my-auto">Dynamic Page Detail</p>
                            </div>
                            <div class="d-flex align-items-center">
                                @if($dynamic_page->status == 'Published')
                                    <a href="{{ route('change.status.dynamic.page', $dynamic_page->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')" class="btn all-btn-same mx-1">Published</a>
                                @else($dynamic_page->status == 'Draft')
                                    <a href="{{ route('change.status.dynamic.page', $dynamic_page->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger mx-1">Draft</a>
                                @endif
                                <a class="btn btn-primary mx-1" href="{{route('dynamic-page.edit', Crypt::encryptString($dynamic_page->id))}}">
                                    Edit
                                </a>
                                <form action="{{ route('dynamic-page.destroy', $dynamic_page->id )}}" method="post" id="deleteForm{{ $dynamic_page->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger mx-1" type="button" onclick="return deleteAction('{{ $dynamic_page->id }}', 'Are you sure to delete this dynamic_page?', 'btn-danger')">
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
                                        {{ $dynamic_page->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                    </p>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 py-0 my-0">
                                    <label class="form-label"> Page Name </label>
                                    <p class="form-control my-0" >
                                        {{ $dynamic_page->title }}
                                    </p>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 py-2 ">
                                    <label class="form-label"> Content </label>
                                    <p class="">
                                        {!! $dynamic_page->content !!}
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
