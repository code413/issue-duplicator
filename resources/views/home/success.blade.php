@extends('layouts.app')

@section('content')
    <div class="text-center flex flex-col items-center justify-center p-8 max-w-md mx-auto">
        <div class="text-green-400 border-8 border-green-200 w-32 h-32 rounded-full flex items-center justify-center mb-6">
            <x-icons.check></x-icons.check>
        </div>

        <div>
            <h1 class="text-2xl font-bold mb-2">Duplication Complete!</h1>

            <p class="text-gray-700">
                <strong>{{ number_format(count($issues)) }}</strong>
                issues were successfully copied from
                <strong>{{ $from }}</strong> to <strong>{{ $to }}</strong>.
            </p>
        </div>

        <div class="mt-16 flex items-center">
            <a href="{{ route('home') }}" class="btn">Copy More Issues</a>

            <a class="text-gray-500 ml-4" href="{{ route('logout') }}">Logout</a>
        </div>
    </div>
@stop

