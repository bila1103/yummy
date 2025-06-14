<meta name="robots" content="noindex,nofollow">

@php($appName = 'Yummy Recipes')
<title>{{ isset($title) ? $title : $appName }}</title>

<meta name="application-name" content="{{ $appName }}">

<link rel="icon" href="{{ asset('favicon.ico') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
