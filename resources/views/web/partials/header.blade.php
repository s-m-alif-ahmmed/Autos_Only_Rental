@if(Auth::check())
    <!-- start header  -->
    <header class="user--option--header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-3">
                    <!-- logo  -->
                    <a href="{{ route('home') }}" class="logo">
                        <img src="{{ asset('/') }}frontEnd/assets/images/logo.svg" alt="">
                    </a>
                </div>
                <div class="col-9">
                    <div class="options--wrapper d-flex align-items-center justify-content-end">
                        <div class="menu--wrapper">
                            <!-- menu  -->
                            <ul class="menu">
                                <li>
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li>
                                    <a href="{{ route('home.listing') }}">Car Listing</a>
                                </li>
                                <li>
                                    <a href="{{ route('home.about') }}"  >About Us</a>
                                </li>
                                <li>
                                    <a href="{{ route('home.faq') }}">FAQs</a>
                                </li>
                            </ul>
                        </div>
                        <!-- user option  -->
                        <div class="user--options">
                            <a href="#" class="toggle">
                                <span>{{ Auth::user()->name }}</span>
                                <img src="{{ asset('/') }}frontEnd/assets/images/testi3.png" alt="">
                            </a>

                            <!-- dropdown  -->
                            <ul class="dropdown">
                                @if(Auth::user()->role == 'User')
                                    <li>
                                        <a href="{{ route('user.profile') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path d="M9.08906 9.58499C9.03656 9.57749 8.96906 9.57749 8.90906 9.58499C7.58906 9.53999 6.53906 8.45999 6.53906 7.13249C6.53906 5.77499 7.63406 4.67249 8.99906 4.67249C10.3566 4.67249 11.4591 5.77499 11.4591 7.13249C11.4516 8.45999 10.4091 9.53999 9.08906 9.58499Z" stroke="#5A5C5F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M14.0553 14.535C12.7203 15.7575 10.9503 16.5 9.00031 16.5C7.05031 16.5 5.28031 15.7575 3.94531 14.535C4.02031 13.83 4.47031 13.14 5.27281 12.6C7.32781 11.235 10.6878 11.235 12.7278 12.6C13.5303 13.14 13.9803 13.83 14.0553 14.535Z" stroke="#5A5C5F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9 16.5C13.1421 16.5 16.5 13.1421 16.5 9C16.5 4.85786 13.1421 1.5 9 1.5C4.85786 1.5 1.5 4.85786 1.5 9C1.5 13.1421 4.85786 16.5 9 16.5Z" stroke="#5A5C5F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <p>Profile</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('rent.history') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path d="M2.625 13.5V5.25C2.625 2.25 3.375 1.5 6.375 1.5H11.625C14.625 1.5 15.375 2.25 15.375 5.25V12.75C15.375 12.855 15.375 12.96 15.3675 13.065" stroke="#5A5C5F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M4.7625 11.25H15.375V13.875C15.375 15.3225 14.1975 16.5 12.75 16.5H5.25C3.8025 16.5 2.625 15.3225 2.625 13.875V13.3875C2.625 12.21 3.585 11.25 4.7625 11.25Z" stroke="#5A5C5F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M6 5.25H12" stroke="#5A5C5F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M6 7.875H9.75" stroke="#5A5C5F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <p>Rent History</p>
                                        </a>
                                    </li>
                                @endif
                                @if(Auth::user()->role == 'Admin')
                                    <li>
                                        <a href="{{ route('dashboard') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path d="M9.08906 9.58499C9.03656 9.57749 8.96906 9.57749 8.90906 9.58499C7.58906 9.53999 6.53906 8.45999 6.53906 7.13249C6.53906 5.77499 7.63406 4.67249 8.99906 4.67249C10.3566 4.67249 11.4591 5.77499 11.4591 7.13249C11.4516 8.45999 10.4091 9.53999 9.08906 9.58499Z" stroke="#5A5C5F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M14.0553 14.535C12.7203 15.7575 10.9503 16.5 9.00031 16.5C7.05031 16.5 5.28031 15.7575 3.94531 14.535C4.02031 13.83 4.47031 13.14 5.27281 12.6C7.32781 11.235 10.6878 11.235 12.7278 12.6C13.5303 13.14 13.9803 13.83 14.0553 14.535Z" stroke="#5A5C5F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9 16.5C13.1421 16.5 16.5 13.1421 16.5 9C16.5 4.85786 13.1421 1.5 9 1.5C4.85786 1.5 1.5 4.85786 1.5 9C1.5 13.1421 4.85786 16.5 9 16.5Z" stroke="#5A5C5F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <p>Profile</p>
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="" class="logout" onclick="event.preventDefault(); document.getElementById('logoutForm').submit(); ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                            <path d="M6.67188 5.66999C6.90438 2.96999 8.29188 1.86749 11.3294 1.86749H11.4269C14.7794 1.86749 16.1219 3.20999 16.1219 6.56249V11.4525C16.1219 14.805 14.7794 16.1475 11.4269 16.1475H11.3294C8.31438 16.1475 6.92688 15.06 6.67938 12.405" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M11.2538 9H2.71875" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M4.3875 6.48749L1.875 8.99999L4.3875 11.5125" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <p>Log Out</p>
                                    </a>
                                    <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <!-- hamburger menu  -->
                        <div class="hamburger-menu">
                            <span class="line-top"></span>
                            <span class="line-center"></span>
                            <span class="line-bottom"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- end header  -->

@else
    <header>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-3">
                    <!-- logo  -->
                    <a href="{{ route('home') }}" class="logo">
                        <img src="{{ asset('/') }}frontEnd/assets/images/logo.svg" alt="">
                    </a>
                </div>
                <div class="col-9">
                    <div class="menu--wrapper">
                        <!-- menu  -->
                        <ul class="menu">
                            <li>
                                <a href="{{ route('home') }}" class="active">Home</a>
                            </li>
                            <li>
                                <a href="{{ route('home.listing') }}">Car Listing</a>
                            </li>
                            <li>
                                <a href="{{ route('home.about') }}">About Us</a>
                            </li>
                            <li>
                                <a href="{{ route('home.faq') }}">FAQs</a>
                            </li>
                        </ul>
                        <!-- button area  -->
                        <div class="btn--area d-flex align-items-center gap-3">
                            <a href="{{ route('login') }}" class="button">Log In</a>
                            <a href="{{ route('register') }}" class="buttonv2">Register</a>
                        </div>
                    </div>
                    <!-- hamburger menu  -->
                    <div class="hamburger-menu">
                        <span class="line-top"></span>
                        <span class="line-center"></span>
                        <span class="line-bottom"></span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endif
