<!DOCTYPE html>
<html lang="en">
<head>
    @include('lumen::partials.metadata')
</head>
<body>
@include('lumen::partials.header')
<div class="container">
    @include('lumen::partials.messages')
    @yield('content')
    @include('lumen::partials.footer')
</div>
@include('lumen::partials.js')
</body>
</html>
