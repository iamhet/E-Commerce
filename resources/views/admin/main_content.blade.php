<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/'.get_option('favicon')) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logo/'.get_option('favicon')) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('logo/'.get_option('favicon')) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{get_option('company_name')}}</title>
    @include('admin.css')
</head>

<body>
    @include('admin.header')
    @include('admin.sidebar')
    @include('pop-up')
    @yield('index')
    @yield('settings')
    @yield('company_information')
    @include('admin.js')
</body>

</html>