@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('issues.copy') }}">
        @csrf

        <h1 class="text-xl font-bold mb-3">Copy All Issues</h1>

        <div class="@guest pointer-events-none opacity-50 @endguest">
            @include('home.partials.from')
            @include('home.partials.to')
            @include('home.partials.labels')
        </div>

        <div class="flex items-center mt-5">
            @auth
                <button class="btn">Go</button>

                <a href="{{ route('logout') }}" class="text-gray-500 ml-4">Logout</a>
            @else
                <a href="{{ route('login') }}" class="btn">Login with Github</a>

                <div class="text-gray-500 ml-4">to start</div>
            @endauth
        </div>
    </form>
@stop

