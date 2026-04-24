@php
    $countries = file_get_contents(public_path('json/countries.json'));
    $languages = file_get_contents(public_path('json/languages.json'));
@endphp

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{asset('images/global/short-logo.svg')}}">
    <title>BARBERLY</title>
    @vite('resources/stylesheets/customer-portal/style.scss')
    @vite('resources/js/customer-portal/app.js')
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnwCg6XrTqFE9p7D3DNXjTCbVPmUtNYcc&libraries=places"></script>
</head>
<body class="customer-portal">
<div id="app"></div>
<!--Preloader-->
@include('components/preloader')

</body>
<script>

    window.core = {
        @if(\Illuminate\Support\Facades\Auth::guard('customers')->check())
        UserInfo: {!! \Illuminate\Support\Facades\Auth::guard('customers')->user() !!},
        @else
        UserInfo: null,
        @endif
        APP_NAME: 'BARBERLY - ',
        APP_URL: '{{env('APP_URL')}}',
        countries: {!! $countries !!},
        languages: {!! $languages !!},
    };
</script>
</html>
