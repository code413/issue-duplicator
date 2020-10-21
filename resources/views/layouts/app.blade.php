@extends('layouts.master')

@section('main.class', 'flex flex-col justify-center items-center bg-gray-400')

@section('main')
    <div class="container flex justify-center flex-1 px-0 sm:py-12 sm:px-5 sm:items-center">
        <div class="p-6 bg-white border-t border-b sm:border-b-0 sm:border-t-0 sm:shadow-2xl sm:rounded">
            @yield('content')
        </div>
    </div>
@stop

