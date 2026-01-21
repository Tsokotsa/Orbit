@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-5">
        Starlink API Test
        <span class="badge bg-success ms-2">v2</span>
    </h2>

    {{-- ACCOUNT INFO --}}
    <div class="card mb-5">
        <div class="card-header">
            <h3 class="card-title">Account</h3>
        </div>
        <div class="card-body">
            @if(!empty($account))
                <pre class="bg-light p-3 rounded">
{{ json_encode($account, JSON_PRETTY_PRINT) }}
                </pre>
            @else
                <span class="text-muted">No account data</span>
            @endif
        </div>
    </div>

    {{-- TERMINALS --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Terminals</h3>
        </div>
        <div class="card-body">

            @if(!empty($terminals) && count($terminals))
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Terminal ID</th>
                            <th>Status</th>
                            <th>Service Line</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($terminals as $terminal)
                            <tr>
                                <td>
                                    <code>{{ $terminal['id'] ?? '—' }}</code>
                                </td>
                                <td>
                                    <span class="badge bg-light-primary">
                                        {{ $terminal['status'] ?? 'unknown' }}
                                    </span>
                                </td>
                                <td>
                                    {{ $terminal['serviceLineNumber'] ?? '—' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <span class="text-muted">No terminals found</span>
            @endif

        </div>
    </div>

</div>
@endsection
