@extends('layouts.app')

@section('content')
    <div>
        <h1 class="text-xl font-bold mb-3">Copy All Issues</h1>

        <div class="pointer-events-none opacity-50">
            @include('home.partials.from')
            @include('home.partials.to')
            @include('home.partials.labels')
        </div>

        <div class="flex items-center mt-5">
            <a href="{{ route('login.github') }}" class="btn">Login with Github</a>

            <div class="text-gray-500 ml-4">to start</div>
        </div>
    </div>
@stop


