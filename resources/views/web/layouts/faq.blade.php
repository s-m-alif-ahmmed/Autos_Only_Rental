@extends('web.app')

@section('title')
    FAQ
@endsection

@section('content')

    <!-- faq area start  -->
    <section class="faq--area faq--page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="faq--contents">
                        <h3>Frequently <span>Asked Questions</span></h3>
                        <div class="accordion" id="accordionExample">
                            <!-- item  -->
                            @foreach($faqs as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapseTwo">
                                            Q.  {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>B.</p>
                                            <p>
                                                {!! $faq->answer !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- faq area end  -->

@endsection
