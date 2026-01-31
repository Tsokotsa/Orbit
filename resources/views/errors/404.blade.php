<style>
    @keyframes orbitFloat {
        0% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }

        100% {
            transform: translateY(0);
        }
    }

    .orbit-float {
        animation: orbitFloat 3.5s ease-in-out infinite;
    }
</style>

@extends('layouts.mini')

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center text-center" style="min-height:70vh">

        <h1 class="display-3 fw-bold mb-0">404</h1>
        <h3 class="mb-4">Lost in Orbit</h3>

        <!-- Orbit Logo -->
        <div class="mb-5">
            <img src="{{ asset('assets/media/logos/orbit-logo.png') }}" alt="Orbit Logo" class="orbit-float"
                style="max-width: 180px;">
        </div>

        <p class="text-muted mb-6">
            This page has drifted out of orbit or was never launched.
        </p>

        <a href="{{ url('/land') }}" class="btn btn-primary">
            Return to Dashboard
        </a>

    </div>
@endsection
