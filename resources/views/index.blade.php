@extends('layouts.app')

@section('title', 'Index')

@section('content')
    <div class="container">
        <img src="{{ Vite::asset('resources/images/logo.png') }}" class="img-fluid d-block mx-auto my-5" alt="Logo">

        <h1 class="text-center mb-3">Welcome, Explorer!</h1>

        <p class="text-center">This archaic system will help you find a way home. May the force be with you!</p>
    </div>
@endsection
