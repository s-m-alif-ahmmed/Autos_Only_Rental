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
                            <!-- upload--area  -->
                            <div class="upload--area">
                                <div class="input--group">
                                    <input type="file" id="image-input" accept="image/*">
                                    <label for="image-input" class="upload-label">
                                        <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <line x1="15" y1="4.37115e-08" x2="15" y2="29" stroke="#FF0000" stroke-width="2"/>
                                            <line x1="29" y1="15" x2="-8.74228e-08" y2="15" stroke="#FF0000" stroke-width="2"/>
                                        </svg>

                                        <div id="image-preview">
                                            <img src="{{ asset('/') }}frontEnd/assets/images/user.jpg" alt="">
                                        </div>
                                    </label>
                                </div>
                                <div class="reminder">
                                    <h5>Add Your Photo</h5>
                                    <p>MAX 100KB</p>
                                </div>
                            </div>

                            <div class="input--group">
                                <label for="fname">Full name</label>
                                <input type="text" id="fname" value="Jone Dee">
                            </div>
                            <div class="input--group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" value="jrosstherealt@gmail.com">
                            </div>
                            <div class="input--group">
                                <label for="phone">Phone Number</label>
                                <input type="number" id="phone" value="656845986399">
                            </div>
                            <div class="input--group">
                                <label for="address">Address</label>
                                <input type="text" id="address" value="3rd Floor, 17/A, DarkStreet, IA2345, London, United Kingdom">
                            </div>
                            <div class="input--group">
                                <label for="password">Password</label>
                                <input type="password" id="password" value="**************">
                            </div>
                            <button type="submit" class="button">Save Changes</button>
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
