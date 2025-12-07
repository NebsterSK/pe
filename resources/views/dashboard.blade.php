@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h1>Dashboard</h1>

    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body d-flex justify-content-between">
                    <h2 class="card-title mb-0">Planets</h2>

                    <p class="h2 mb-0">{{ number_format($planetsCount, 0, ',', ' ') }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body d-flex justify-content-between">
                    <h2 class="card-title mb-0">Residents</h2>

                    <p class="h2 mb-0">{{ number_format($residentsCount, 0, ',', ' ') }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body d-flex justify-content-between">
                    <h2 class="card-title mb-0">Logbook entries</h2>

                    <p class="h2 mb-0">{{ number_format($logbookEntriesCount, 0, ',', ' ') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
