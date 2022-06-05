<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('client.css')
</head>
<body>
    <div class="hero_area">
        @include('client.navbar')
        @include('client.index.slider_section')
        @include('client.index.our_product')
        @include('client.index.subscribe_section')
        @include('client.index.footer')
        @include('client.js')
    </div>
</body>
</html>