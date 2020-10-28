@extends('layouts.app')

@section('description', 'Duplicate Github issues from a source repository to a destination repository.')

@section('content')
    <form method="POST" action="{{ route('issues.copy') }}">
        @csrf

        <h1 class="text-xl font-bold mb-3">Copy All Issues</h1>

        <div>
            @include('home.partials.from')
            @include('home.partials.to')
            @include('home.partials.labels')
        </div>

        <div class="flex items-center mt-5">
            <button class="btn">Go</button>

            <a href="{{ route('logout') }}" class="text-gray-500 ml-4">Logout</a>
        </div>
    </form>
@stop

