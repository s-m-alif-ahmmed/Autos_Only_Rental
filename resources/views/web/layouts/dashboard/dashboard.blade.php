@extends('web.app')

@section('title')
    User Profile
@endsection

@section('content')

    <!-- user profile area start  -->
    <section class="user--profile--area rent--posi">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-7 col-lg-8 col-md-10">
                    <!-- user--profile--form"  -->
                    <div class="user--profile--form">
                        <h1>User Profile</h1>
                        <form class="form--common" action="#">
                            <!-- user--image  -->
                            <div class="user--image">
                                @if(Auth::user()->photo)
                                    <img src="{{ asset(Auth::user()->photo) }}" alt="">
                                @else
                                    <img src="{{ asset('/') }}frontEnd/assets/images/user.jpg" alt="">
                                @endif
                            </div>
                            <div class="input--group">
                                <label for="fname">Full name</label>
                                <input type="text" id="fname" value="{{ Auth::user()->name }}" placeholder="Jone Dee">
                            </div>
                            <div class="input--group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" value="{{ Auth::user()->email }}" placeholder="jrosstherealt@gmail.com">
                            </div>
                            <div class="input--group">
                                <label for="phone">Phone Number</label>
                                <input type="number" id="phone" value="{{ Auth::user()->number }}" placeholder="+04 652 23660">
                            </div>
                            <div class="input--group">
                                <label for="address">Address</label>
                                <input type="text" id="address" value="{{ Auth::user()->address }}" placeholder="3rd Floor, 17/A, DarkStreet, IA2345, London, United Kingdom">
                            </div>
                            <div class="input--group">
                                <label for="password">Password</label>
                                <input type="password" id="password" value="{{ Auth::user()->password }}" placeholder="**************">
                            </div>
                            <a href="{{ route('edit.profile') }}" class="button">Edit Your Profile</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <img class="rent-img rent-img1" src="{{ asset('/') }}frontEnd/assets/images/rent.svg" alt="">
        <img class="rent-img rent-img2" src="{{ asset('/') }}frontEnd/assets/images/rent.svg" alt="">
    </section>
    <!-- user profile area end  -->

@endsection
