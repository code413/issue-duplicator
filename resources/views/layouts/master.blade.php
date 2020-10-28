<!doctype html>
<html lang='en'>
<head>
    @section('head')
        <title>
            @yield('title')
            @if(!view()->hasSection('title.suffix'))
                @if(view()->hasSection('title')) - @endif Github Issue Duplicator
            @endif
        </title>
        @include('layouts.partials.meta')
        @include('layouts.partials.favicon')
        @include('layouts.partials.styles')
    @show
</head>
<body class="flex flex-col @yield('superclass')">
@if(config('app.env') == 'production')
    @include('layouts.partials.trackers')
@endif
@section('header')
    @include('partials.header')
@show
<main class="flex-1 @yield('main.class')">
    @section('main')

    @show
</main>
<footer>
    @section('footer')
        @include('partials.footer')
    @show
</footer>
@section('scripts')
    @include('layouts.partials.scripts')
@show
</body>
</html>
