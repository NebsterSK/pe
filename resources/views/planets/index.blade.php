@extends('layouts.app')

@section('title', 'Planets')

@section('content')
    <div class="container-fluid">
        <h1>Planets</h1>

        <livewire:planets-table />
    </div>
@endsection
