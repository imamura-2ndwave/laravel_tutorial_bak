<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# website: http://ogp.me/ns/website#">
    <!-- meta -->
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="format-detection" content="telephone=no,address=no,email=no">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name') }}</title>
    @yield('stylesheets')
</head>
<body>
    @yield('app')
    @yield('javascripts')
</body>
</html>
