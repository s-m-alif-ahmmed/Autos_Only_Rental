@extends('web.app')

@section('title')
    About Us
@endsection

@section('content')

    <!-- about hero area start  -->
    <section class="about--hero--area rent--posi">
        <div class="container">
            <div class="row">
                {{-- message --}}
                @if(session('message'))
                    <p class="text-center text-success fs-6">{{session('message')}}</p>
                @endif
                <div class="col-xxl-5 col-lg-6 mt_30">
                    <!-- about--hero--text  -->
                    <div class="about--hero--text">
                        <h1>About Us</h1>
                        <p>Our management has over 30+ years of experience maintaining and operating Autos Only Burien, an independent dealership. </p>
                        <p class="mt_20">We believe this experience will translate into our ability to provide a wide selection of quality cars that are budget friendly. </p>
                        <p class="mt_20">We hand select our rentals from our dealership inventory, and use the dealership reconditioning process to maintain our fleet. This creates a higher level of customer satisfaction and repeat business.</p>
                    </div>
                </div>
                <div class="col-xxl-7 col-lg-6 mt_30">
                    <div class="img--area">
                        <img class="w-100" src="{{ asset('/') }}frontEnd/assets/images/about-hero.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <img class="rent-img rent-img1" src="{{ asset('/') }}frontEnd/assets/images/rent.svg" alt="">
        <img class="rent-img rent-img2" src="{{ asset('/') }}frontEnd/assets/images/rent.svg" alt="">
    </section>
    <!-- about hero area end  -->
    <!-- steps area start  -->
    <section class="steps--area" style="background-image: url(./frontEnd/assets/images/steps-bg.png);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>3 Easy Steps To<br> Renting Our Vehicles</h3>
                </div>
                <div class="col-md-4 mt_20">
                    <!-- steps--box  -->
                    <div class="steps--box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="49" height="49" viewBox="0 0 49 49" fill="none">
                            <path d="M41.7376 17.9C39.6576 8.64 31.5776 4.5 24.4975 4.5C24.4975 4.5 24.4975 4.5 24.4775 4.5C17.4175 4.5 9.35755 8.64 7.25755 17.88C4.89755 28.2 11.2175 36.94 16.9375 42.46C19.0575 44.5 21.7775 45.52 24.4975 45.52C27.2176 45.52 29.9376 44.5 32.0376 42.46C37.7576 36.94 44.0776 28.22 41.7376 17.9ZM31.0576 19.56L23.0575 27.56C22.7575 27.86 22.3775 28 21.9975 28C21.6175 28 21.2375 27.86 20.9375 27.56L17.9375 24.56C17.3575 23.98 17.3575 23.02 17.9375 22.44C18.5175 21.86 19.4775 21.86 20.0575 22.44L21.9975 24.38L28.9375 17.44C29.5175 16.86 30.4775 16.86 31.0576 17.44C31.6376 18.02 31.6376 18.98 31.0576 19.56Z" fill="#FF0000"/>
                        </svg>
                        <p>Choose Pickup & Dropoff Dates</p>
                    </div>
                </div>
                <div class="col-md-4 mt_20">
                    <!-- steps--box  -->
                    <div class="steps--box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="49" height="49" viewBox="0 0 49 49" fill="none">
                            <path d="M34.0005 7.62V4.5C34.0005 3.68 33.3205 3 32.5005 3C31.6805 3 31.0005 3.68 31.0005 4.5V7.5H18.0005V4.5C18.0005 3.68 17.3205 3 16.5005 3C15.6805 3 15.0005 3.68 15.0005 4.5V7.62C9.60046 8.12 6.98046 11.34 6.58046 16.12C6.54046 16.7 7.02046 17.18 7.58046 17.18H41.4205C42.0005 17.18 42.4805 16.68 42.4205 16.12C42.0205 11.34 39.4005 8.12 34.0005 7.62Z" fill="#FF0000"/>
                            <path d="M40.5 20.1797H8.5C7.4 20.1797 6.5 21.0797 6.5 22.1797V34.4997C6.5 40.4997 9.5 44.4997 16.5 44.4997H32.5C39.5 44.4997 42.5 40.4997 42.5 34.4997V22.1797C42.5 21.0797 41.6 20.1797 40.5 20.1797ZM18.92 36.9197C18.82 36.9997 18.72 37.0997 18.62 37.1597C18.5 37.2397 18.38 37.2997 18.26 37.3397C18.14 37.3997 18.02 37.4397 17.9 37.4597C17.76 37.4797 17.64 37.4997 17.5 37.4997C17.24 37.4997 16.98 37.4397 16.74 37.3397C16.48 37.2397 16.28 37.0997 16.08 36.9197C15.72 36.5397 15.5 36.0197 15.5 35.4997C15.5 34.9797 15.72 34.4597 16.08 34.0797C16.28 33.8997 16.48 33.7597 16.74 33.6597C17.1 33.4997 17.5 33.4597 17.9 33.5397C18.02 33.5597 18.14 33.5997 18.26 33.6597C18.38 33.6997 18.5 33.7597 18.62 33.8397C18.72 33.9197 18.82 33.9997 18.92 34.0797C19.28 34.4597 19.5 34.9797 19.5 35.4997C19.5 36.0197 19.28 36.5397 18.92 36.9197ZM18.92 29.9197C18.54 30.2797 18.02 30.4997 17.5 30.4997C16.98 30.4997 16.46 30.2797 16.08 29.9197C15.72 29.5397 15.5 29.0197 15.5 28.4997C15.5 27.9797 15.72 27.4597 16.08 27.0797C16.64 26.5197 17.52 26.3397 18.26 26.6597C18.52 26.7597 18.74 26.8997 18.92 27.0797C19.28 27.4597 19.5 27.9797 19.5 28.4997C19.5 29.0197 19.28 29.5397 18.92 29.9197ZM25.92 36.9197C25.54 37.2797 25.02 37.4997 24.5 37.4997C23.98 37.4997 23.46 37.2797 23.08 36.9197C22.72 36.5397 22.5 36.0197 22.5 35.4997C22.5 34.9797 22.72 34.4597 23.08 34.0797C23.82 33.3397 25.18 33.3397 25.92 34.0797C26.28 34.4597 26.5 34.9797 26.5 35.4997C26.5 36.0197 26.28 36.5397 25.92 36.9197ZM25.92 29.9197C25.82 29.9997 25.72 30.0797 25.62 30.1597C25.5 30.2397 25.38 30.2997 25.26 30.3397C25.14 30.3997 25.02 30.4397 24.9 30.4597C24.76 30.4797 24.64 30.4997 24.5 30.4997C23.98 30.4997 23.46 30.2797 23.08 29.9197C22.72 29.5397 22.5 29.0197 22.5 28.4997C22.5 27.9797 22.72 27.4597 23.08 27.0797C23.26 26.8997 23.48 26.7597 23.74 26.6597C24.48 26.3397 25.36 26.5197 25.92 27.0797C26.28 27.4597 26.5 27.9797 26.5 28.4997C26.5 29.0197 26.28 29.5397 25.92 29.9197ZM32.92 36.9197C32.54 37.2797 32.02 37.4997 31.5 37.4997C30.98 37.4997 30.46 37.2797 30.08 36.9197C29.72 36.5397 29.5 36.0197 29.5 35.4997C29.5 34.9797 29.72 34.4597 30.08 34.0797C30.82 33.3397 32.18 33.3397 32.92 34.0797C33.28 34.4597 33.5 34.9797 33.5 35.4997C33.5 36.0197 33.28 36.5397 32.92 36.9197ZM32.92 29.9197C32.82 29.9997 32.72 30.0797 32.62 30.1597C32.5 30.2397 32.38 30.2997 32.26 30.3397C32.14 30.3997 32.02 30.4397 31.9 30.4597C31.76 30.4797 31.62 30.4997 31.5 30.4997C30.98 30.4997 30.46 30.2797 30.08 29.9197C29.72 29.5397 29.5 29.0197 29.5 28.4997C29.5 27.9797 29.72 27.4597 30.08 27.0797C30.28 26.8997 30.48 26.7597 30.74 26.6597C31.1 26.4997 31.5 26.4597 31.9 26.5397C32.02 26.5597 32.14 26.5997 32.26 26.6597C32.38 26.6997 32.5 26.7597 32.62 26.8397C32.72 26.9197 32.82 26.9997 32.92 27.0797C33.28 27.4597 33.5 27.9797 33.5 28.4997C33.5 29.0197 33.28 29.5397 32.92 29.9197Z" fill="#FF0000"/>
                        </svg>
                        <p>Choose Your Vehicle</p>
                    </div>
                </div>
                <div class="col-md-4 mt_20">
                    <!-- steps--box  -->
                    <div class="steps--box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="49" height="49" viewBox="0 0 49 49" fill="none">
                            <path d="M44 16.5002C44 17.3202 43.32 18.0002 42.5 18.0002H6.5C5.68 18.0002 5 17.3202 5 16.5002C5 15.6802 5.68 15.0002 6.5 15.0002H8.54L9.3 11.3802C10.02 7.88016 11.52 4.66016 17.48 4.66016H31.52C37.48 4.66016 38.98 7.88016 39.7 11.3802L40.46 15.0002H42.5C43.32 15.0002 44 15.6802 44 16.5002Z" fill="#FF0000"/>
                            <path d="M44.8631 27.82C44.5631 24.52 43.6831 21 37.2631 21H11.7431C5.3231 21 4.4631 24.52 4.1431 27.82L3.0231 40C2.8831 41.52 3.3831 43.04 4.4231 44.18C5.4831 45.34 6.9831 46 8.5831 46H12.3431C15.5831 46 16.2031 44.14 16.6031 42.92L17.0031 41.72C17.4631 40.34 17.5831 40 19.3831 40H29.6231C31.4231 40 31.4831 40.2 32.0031 41.72L32.4031 42.92C32.8031 44.14 33.4231 46 36.6631 46H40.4231C42.0031 46 43.5231 45.34 44.5831 44.18C45.6231 43.04 46.1231 41.52 45.9831 40L44.8631 27.82ZM18.5031 32H12.5031C11.6831 32 11.0031 31.32 11.0031 30.5C11.0031 29.68 11.6831 29 12.5031 29H18.5031C19.3231 29 20.0031 29.68 20.0031 30.5C20.0031 31.32 19.3231 32 18.5031 32ZM36.5031 32H30.5031C29.6831 32 29.0031 31.32 29.0031 30.5C29.0031 29.68 29.6831 29 30.5031 29H36.5031C37.3231 29 38.0031 29.68 38.0031 30.5C38.0031 31.32 37.3231 32 36.5031 32Z" fill="#FF0000"/>
                        </svg>
                        <p>Choose Pickup Location</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- steps area end  -->
    <!-- contact area start -->
    <section class="contact--area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mt_30">
                    <!-- conatct--info  -->
                    <div class="conatct--info">
                        <h3>Get In Touch</h3>
                        <span>Experience the future of automotive innovation with our latest car models.</span>
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M7.39969 6.31991L15.8897 3.48991C19.6997 2.21991 21.7697 4.29991 20.5097 8.10991L17.6797 16.5999C15.7797 22.3099 12.6597 22.3099 10.7597 16.5999L9.91969 14.0799L7.39969 13.2399C1.68969 11.3399 1.68969 8.22991 7.39969 6.31991Z" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10.1094 13.6501L13.6894 10.0601" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            bookings@autosonlyrentals.com
                        </a>
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M21.97 18.33C21.97 18.69 21.89 19.06 21.72 19.42C21.55 19.78 21.33 20.12 21.04 20.44C20.55 20.98 20.01 21.37 19.4 21.62C18.8 21.87 18.15 22 17.45 22C16.43 22 15.34 21.76 14.19 21.27C13.04 20.78 11.89 20.12 10.75 19.29C9.6 18.45 8.51 17.52 7.47 16.49C6.44 15.45 5.51 14.36 4.68 13.22C3.86 12.08 3.2 10.94 2.72 9.81C2.24 8.67 2 7.58 2 6.54C2 5.86 2.12 5.21 2.36 4.61C2.6 4 2.98 3.44 3.51 2.94C4.15 2.31 4.85 2 5.59 2C5.87 2 6.15 2.06 6.4 2.18C6.66 2.3 6.89 2.48 7.07 2.74L9.39 6.01C9.57 6.26 9.7 6.49 9.79 6.71C9.88 6.92 9.93 7.13 9.93 7.32C9.93 7.56 9.86 7.8 9.72 8.03C9.59 8.26 9.4 8.5 9.16 8.74L8.4 9.53C8.29 9.64 8.24 9.77 8.24 9.93C8.24 10.01 8.25 10.08 8.27 10.16C8.3 10.24 8.33 10.3 8.35 10.36C8.53 10.69 8.84 11.12 9.28 11.64C9.73 12.16 10.21 12.69 10.73 13.22C11.27 13.75 11.79 14.24 12.32 14.69C12.84 15.13 13.27 15.43 13.61 15.61C13.66 15.63 13.72 15.66 13.79 15.69C13.87 15.72 13.95 15.73 14.04 15.73C14.21 15.73 14.34 15.67 14.45 15.56L15.21 14.81C15.46 14.56 15.7 14.37 15.93 14.25C16.16 14.11 16.39 14.04 16.64 14.04C16.83 14.04 17.03 14.08 17.25 14.17C17.47 14.26 17.7 14.39 17.95 14.56L21.26 16.91C21.52 17.09 21.7 17.3 21.81 17.55C21.91 17.8 21.97 18.05 21.97 18.33Z" stroke="#FF0000" stroke-width="1.5" stroke-miterlimit="10"/>
                                <path d="M18.5 9C18.5 8.4 18.03 7.48 17.33 6.73C16.69 6.04 15.84 5.5 15 5.5" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M22 9C22 5.13 18.87 2 15 2" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            844-339-3699
                        </a>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M13 22H5C3 22 2 21 2 19V11C2 9 3 8 5 8H10V19C10 21 11 22 13 22Z" stroke="#FF0000" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10.11 4C10.03 4.3 10 4.63 10 5V8H5V6C5 4.9 5.9 4 7 4H10.11Z" stroke="#FF0000" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 8V13" stroke="#FF0000" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18 8V13" stroke="#FF0000" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M17 17H15C14.45 17 14 17.45 14 18V22H18V18C18 17.45 17.55 17 17 17Z" stroke="#FF0000" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6 13V17" stroke="#FF0000" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 19V5C10 3 11 2 13 2H19C21 2 22 3 22 5V19C22 21 21 22 19 22H13C11 22 10 21 10 19Z" stroke="#FF0000" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            14600 1st Ave S, Burien, WA 98168
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 mt_30">
                    <form class="form--common" action="{{ route('home.contact.store') }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="input--group">
                            <label for="fname">Full name</label>
                            <input type="text" name="name" id="fname" placeholder="Jone Dee" required >
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                        </div>
                        <div class="input--group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" placeholder="jrosstherealt@gmail.com" required >
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                        </div>
                        <div class="input--group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" name="number" id="phone" placeholder="+04 652 23660" required >
                            <x-input-error :messages="$errors->get('number')" class="mt-2 text-danger" />
                        </div>
                        <div class="input--group">
                            <label for="message">Your Message</label>
                            <textarea name="message" placeholder="Message" required ></textarea>
                            <x-input-error :messages="$errors->get('message')" class="mt-2 text-danger" />
                        </div>
                        <button type="submit" class="button">Submit Now</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- contact area end -->

@endsection
