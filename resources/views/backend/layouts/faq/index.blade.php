@extends('backend.app')

@section('title')
    Faq
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
                            <li class="breadcrumb-item active" aria-current="page">Manage Faqs</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="">
                <a class="btn all-btn-same rounded-3" href="{{ route('faqs.create') }}">Create Faq</a>
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
                            <th> Faq </th>
                            <th> Faq Status </th>
                            <th> Actions </th>
                        </tr>
                        </thead>
                        <tbody id="category-table">
                        @foreach($faqs as $faq)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    {{ $faq->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                </td>
                                <td>{{$faq->question}}</td>
                                <td>
                                    @if($faq->status == 'Published')
                                        <a href="{{ route('change.status.faq', $faq->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')" class="btn all-btn-same">Published</a>
                                    @else($faq->status == 'Draft')
                                        <a href="{{ route('change.status.faq', $faq->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger">Draft</a>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <span class="d-inline-block ms-2" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="View">
                                            <a href="{{route('faqs.show', Crypt::encryptString($faq->id))}}" class="text-primary mx-1"><i class="fa fa-eye"></i></a>
                                        </span>
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Edit">
                                            <a href="{{route('faqs.edit', Crypt::encryptString($faq->id))}}" class="text-warning mx-1"><i class="fa fa-edit"></i></a>
                                        </span>
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                            <form action="{{ route('faqs.destroy', $faq->id )}}" method="post" id="deleteForm{{ $faq->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-danger border-0" type="button" onclick="return deleteAction('{{ $faq->id }}', 'Are you sure to delete this faq?', 'btn-danger')">
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
