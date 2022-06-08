<!DOCTYPE html>
<html lang="en">
<head>
    @include('client.css')
</head>
<body>
    @include('client.header')
    @yield('index');
    @include('client.js')
    @include('client.footer')
</body>
</html> 