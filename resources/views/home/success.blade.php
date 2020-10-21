@extends('layouts.app')

@section('content')
    <div class="text-center flex flex-col items-center justify-center p-8 max-w-md mx-auto">
        <div class="text-green-400 border-8 border-green-200 w-32 h-32 rounded-full flex items-center justify-center mb-6">
            <svg class="w-16 h-16" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
        </div>

        <div>
            <h1 class="text-2xl font-bold mb-2">Duplication Complete!</h1>
            <p class="text-gray-700">
                <strong>{{ number_format(count($issues)) }}</strong> issues were successfully copied from <strong>{{ $from }}</strong> to <strong>{{ $to }}</strong>.
            </p>
        </div>

        <div class="mt-16 flex items-center">
            <a href="{{ route('home') }}" class="btn">Try Another Repo</a>
            <a class="text-gray-500 ml-4" href="{{ route('logout') }}">Logout</a>
        </div>
    </div>
@stop

