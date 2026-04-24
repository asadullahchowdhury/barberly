@php
    $countries = file_get_contents(public_path('json/countries.json'));
    $currencies = file_get_contents(public_path('json/currencies.json'));
    $languages = file_get_contents(public_path('json/languages.json'));
    $timezones = file_get_contents(public_path('json/timezones.json'));
@endphp

    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{asset('images/global/short-logo.svg')}}">
    <title>BARBERLY</title>

    @vite('resources/stylesheets/auth-portal/styles.scss')
    @vite('resources/js/auth-portal/app.js')
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnwCg6XrTqFE9p7D3DNXjTCbVPmUtNYcc&libraries=places"></script>
</head>
<body class="auth-portal">
<div id="app"></div>
<!--Preloader-->
@include('components/preloader')
</body>
<script>

    window.core = {
        APP_NAME: 'BARBERLY - Portal ',
        @if(\Illuminate\Support\Facades\Auth::check())
        UserInfo: {!! \Illuminate\Support\Facades\Auth::user() !!},
        @else
        UserInfo: null,
        @endif
        APP_URL: '{{env('APP_URL')}}',
        countries: {!! $countries !!},
        currencies: {!! $currencies !!},
        languages: {!! $languages !!},
        timezones: {!! $timezones !!},

    };
</script>
</html>
