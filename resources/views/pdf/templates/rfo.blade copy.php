<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>RFO Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #2d2d2d;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 140px;
            margin-bottom: 10px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 12px;
            color: #777;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 8px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 6px;
            border: 1px solid #eee;
            vertical-align: top;
        }

        .label {
            width: 30%;
            font-weight: bold;
            background: #f9f9f9;
        }

        .timeline-item {
            border-left: 3px solid #4caf50;
            padding-left: 10px;
            margin-bottom: 10px;
        }

        /* .footer {
            margin-top: 30px;
            font-size: 10px;
            text-align: center;
            color: #999;
        } */
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="header">
        <img src="{{ public_path('/assets/media/auth/paratus-login.png') }}" class="logo">

        <div class="title">
            ROOT CAUSE ANALYSIS REPORT
        </div>

        <div class="subtitle">
            RFO #{{ $rfo->rfo_number }}
        </div>
    </div>

    {{-- BASIC INFO --}}
    <div class="section">
        <div class="section-title">Incident Overview</div>

        <table>
            <tr>
                <td class="label">Title</td>
                <td>{{ $rfo->title }}</td>
            </tr>

            <tr>
                <td class="label">Classification</td>
                <td>{{ ucfirst($rfo->classification) }}</td>
            </tr>

            <tr>
                <td class="label">Prepared By</td>
                <td>
                    {{ $rfo->preparer->name ?? '' }}
                    {{ $rfo->preparer->surname ?? '' }}
                </td>
            </tr>

            <tr>
                <td class="label">Status</td>
                <td>{{ ucfirst($rfo->status) }}</td>
            </tr>

            <tr>
                <td class="label">Created Date</td>
                <td>{{ $rfo->created_at->format('d M Y H:i') }}</td>
            </tr>
        </table>
    </div>

    {{-- INCIDENT DETAILS --}}
    <div class="section">
        <div class="section-title">Incident Details</div>

        <p><strong>Summary:</strong><br>
            {{ $rfo->incident_summary }}
        </p>

        <p><strong>Affected Services:</strong><br>
            {{ $rfo->affected_services }}
        </p>
    </div>

    {{-- RCA --}}
    <div class="section">
        <div class="section-title">Root Cause Analysis</div>

        <p><strong>Root Cause:</strong><br>
            {{ $rfo->root_cause }}
        </p>

        <p><strong>Corrective Actions:</strong><br>
            {{ $rfo->corrective_actions }}
        </p>
    </div>

    {{-- TIMELINE --}}
    <div class="section">
        <div class="section-title">Event Timeline</div>

        @if ($rfo->timelines && count($rfo->timelines))
        @foreach ($rfo->timelines as $t)
        <div class="timeline-item">
            <strong>
                {{ \Carbon\Carbon::parse($t->timeline_time)->format('d M Y H:i') }}
            </strong><br>
            {{ $t->timeline_action }}
        </div>
        @endforeach
        @else
        <p>No timeline events recorded.</p>
        @endif
    </div>

    {{-- FOOTER --}}


</body>

</html>