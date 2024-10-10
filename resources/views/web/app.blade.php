<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- ==== Favicon ==== -->
    <link rel="icon" type="image/png" href="{{ asset('/') }}frontEnd/assets/images/logo-sm.svg" />
    <!-- ==== All Css Links ==== -->
    @include('web.partials.style')
</head>

<body>

<!-- start header  -->
@include('web.partials.header')
<!-- end header  -->

<main>
    @yield('content')
</main>
<!-- start footer  -->
@include('web.partials.footer')
<!-- end footer  -->

<!-- ==== All Js Links ==== -->
@include('web.partials.js')
</body>

</html>
