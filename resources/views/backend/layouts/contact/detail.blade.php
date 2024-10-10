@extends('backend.app')

@section('title')
    Contact Message
@endsection

@section('content')

    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('contacts.index') }}">Contacts</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Contact Message Detail</li>
                        </ol>
                    </nav>
                </div>
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
                                <p class="fs-4 fw-bold my-auto">Contact Message Detail</p>
                            </div>
                            <div class="d-flex align-items-center">
{{--                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">--}}
{{--                                    Note--}}
{{--                                </button>--}}
                                @if($contact->status == 'Unread')
                                    <a href="{{ route('change.status.contact', $contact->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')" class="btn all-btn-same mx-1">Unread</a>
                                @else($contact->status == 'Read')
                                    <a href="{{ route('change.status.contact', $contact->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-success mx-1">Read</a>
                                @endif
                                <form action="{{ route('contacts.destroy', $contact->id )}}" method="post" id="deleteForm{{ $contact->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger mx-1" type="button" onclick="return deleteAction('{{ $contact->id }}', 'Are you sure to delete this contact?', 'btn-danger')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body py-0">
                            <div class="row pb-5">
                                <div class="col-12">
                                    <label class="form-label"> Created At </label>
                                    <p class="form-control" >
                                        {{ $contact->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                    </p>
                                </div>
                                <div class="col-12">
                                    <label class="form-label"> Full Name </label>
                                    <p class="form-control" >
                                        {{ $contact->name }}
                                    </p>
                                </div>
                                <div class="col-12">
                                    <label class="form-label"> Email </label>
                                    <p class="form-control" >
                                        {{ $contact->email }}
                                    </p>
                                </div>
                                <div class="col-12">
                                    <label class="form-label"> Phone Number </label>
                                    <p class="form-control" >
                                        {{ $contact->number }}
                                    </p>
                                </div>
                                <div class="col-12">
                                    <label class="form-label"> Message </label>
                                    <textarea class="form-control bg-white" name="answer" id="answer" cols="30" rows="3" disabled >{{$contact->message}}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
{{--                        <div class="modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">--}}
{{--                            <div class="modal-dialog">--}}
{{--                                <div class="modal-content">--}}
{{--                                    <div class="modal-header border-0">--}}
{{--                                        <p class="modal-title fs-5" id="staticBackdropLabel">Note</p>--}}
{{--                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                                    </div>--}}
{{--                                    <div class="modal-body">--}}
{{--                                        <form action="{{ route('contacts.update', Crypt::encryptString($contact->id)) }}">--}}
{{--                                            @csrf--}}

{{--                                            <div class="col-12">--}}
{{--                                                <label for="note" class="form-label"> Note </label>--}}
{{--                                                <textarea class="form-control" name="note" id="note" cols="30" rows="3" placeholder="Enter note" required ></textarea>--}}
{{--                                                <x-input-error :messages="$errors->get('note')" class="mt-2" />--}}
{{--                                            </div>--}}

{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                    <div class="modal-footer">--}}
{{--                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}
{{--                                        <button type="button" class="btn btn-primary">Understood</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
