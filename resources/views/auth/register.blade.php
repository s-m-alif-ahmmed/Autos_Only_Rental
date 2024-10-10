@extends('web.app')

@section('title')
    Register
@endsection

@section('content')

    <!-- login area start  -->
    <section class="login--register--area rent--posi">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-10">
                    <div class="login--form user--profile--form">
                        <h1>Register</h1>
                        <form class="form--common" method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="input--group">
                                <label for="fname">Full Name</label>
                                <input type="text" id="fname" name="name" placeholder="eg. Jon Doe">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="input--group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" placeholder="eg. youremail@email.com">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="input--group">
                                <label for="phone">Phone Number</label>
                                <input type="phone" id="phone" name="number" placeholder="eg. +123 456 7890">
                                <x-input-error :messages="$errors->get('number')" class="mt-2" />
                            </div>
                            <div class="input--group">
                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" placeholder="Your Address">
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                            <div class="input--group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" placeholder="**********">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div class="input--group">
                                <label for="c-password">Confirm Password</label>
                                <input type="password" id="c-password" name="password_confirmation" placeholder="**********">
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                            <button type="submit" class="button">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <img class="rent-img rent-img1" src="assets/images/rent.svg" alt="">
        <img class="rent-img rent-img2" src="assets/images/rent.svg" alt="">
    </section>
    <!-- login area end  -->

@endsection


{{--<x-guest-layout>--}}
{{--    <form method="POST" action="{{ route('register') }}">--}}
{{--        @csrf--}}

{{--        <!-- Name -->--}}
{{--        <div>--}}
{{--            <x-input-label for="name" :value="__('Full Name')" />--}}
{{--            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="eg. Jon Doe" :value="old('name')" required autofocus autocomplete="name" />--}}
{{--            <x-input-error :messages="$errors->get('name')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Email Address -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="eg. youremail@email.com" :value="old('email')" required autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Phone Number -->--}}
{{--        <div>--}}
{{--            <x-input-label for="number" :value="__('Phone Number')" />--}}
{{--            <x-text-input id="number" class="block mt-1 w-full" type="text" name="number" placeholder="eg. +123 456 7890" :value="old('name')" required autofocus autocomplete="name" />--}}
{{--            <x-input-error :messages="$errors->get('number')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Address -->--}}
{{--        <div>--}}
{{--            <x-input-label for="address" :value="__('Address')" />--}}
{{--            <textarea class="form-control" name="address" id="address" cols="30" rows="3"></textarea>--}}
{{--            <x-input-error :messages="$errors->get('address')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Confirm Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />--}}

{{--            <x-text-input id="password_confirmation" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password_confirmation" required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">--}}
{{--                {{ __('Already registered?') }}--}}
{{--            </a>--}}

{{--            <x-primary-button class="ms-4">--}}
{{--                {{ __('Register') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}
