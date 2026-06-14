<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #3f4254;
            line-height: 1.6;
            background: #ffffff;
        }

        /* ==========================================
       LAYOUT
    ========================================== */

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            color: #1E3C96;
            margin-top: 10px;
        }

        .subtitle {
            color: #7e8299;
            font-size: 12px;
        }

        .rfo-section {
            background: #ffffff;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 18px;
            page-break-inside: avoid;
        }

        .section-heading {
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            color: #3F4254;
            margin-bottom: 12px;
            border-left: 4px solid #A1A5B7;
            padding-left: 8px;
        }

        .section-paragraph {
            font-size: 13px;
            line-height: 1.8;
            text-align: justify;
            color: #181C32;
        }

        /* ==========================================
       PRIMARY SECTION TITLE
    ========================================== */

        .rfo-title {
            background: #1E3C96;
            color: #fff;
            border-radius: 10px 10px 0 0;
            padding: 10px 15px;
            font-weight: 600;
            font-size: 14px;
        }

        /* ==========================================
       SUMMARY TABLE
    ========================================== */

        .rfo-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border: 1px solid #E4E6EF;
            border-radius: 0 0 10px 10px;
            overflow: hidden;
            background: #fff;
        }

        .rfo-table th {
            background: #F5F8FA;
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #E4E6EF;
            font-weight: 600;
            font-size: 11px;
            color: #3F4254;
        }

        .rfo-table td {
            padding: 10px;
            border-bottom: 1px solid #E4E6EF;
        }

        .rfo-table tr:last-child td {
            border-bottom: none;
        }

        /* ==========================================
       TIMELINE
    ========================================== */

        .timeline-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border: 1px solid #E4E6EF;
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
        }

        .timeline-table th {
            background: #F5F8FA;
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #E4E6EF;
            font-weight: 600;
            font-size: 11px;
            color: #3F4254;
        }

        .timeline-table td {
            padding: 12px;
            border-bottom: 1px solid #E4E6EF;
            vertical-align: top;
        }

        .timeline-table tr:last-child td {
            border-bottom: none;
        }

        .timeline-time {
            width: 25%;
            background: #FAFBFC;
            color: #7E8299;
            font-weight: 600;
            border-right: 1px solid #E4E6EF;
            white-space: nowrap;
        }

        .timeline-description {
            color: #3F4254;
            line-height: 1.6;
        }

        /* ==========================================
       IMPACT CARDS
    ========================================== */

        .impact-grid {
            width: 100%;
            border-collapse: separate;
            border-spacing: 10px;
        }

        .impact-grid td {
            width: 50%;
            vertical-align: top;
        }

        .impact-card {
            border: 1px solid #E4E6EF;
            border-radius: 8px;
            overflow: hidden;
            height: 100%;
            background: #fff;
        }

        .impact-card-title {
            background: #F8F9FA;
            color: #3F4254;
            font-weight: 600;
            padding: 10px;
            border-left: 4px solid #7C7E80;
        }

        .impact-card-body {
            padding: 12px;
            line-height: 1.6;
            color: #181C32;
        }

        /* ==========================================
       APOLOGY SECTION
    ========================================== */

        .apology-box {
            margin-top: 20px;
            padding: 18px 22px;
            border-left: 5px solid #1E3C96;
            background: #F8F9FB;
            border-radius: 6px;
        }

        .apology-text {
            font-style: italic;
            font-size: 13px;
            line-height: 1.6;
            color: #333;
            margin-bottom: 10px;
            text-align: justify;
        }

        .apology-text strong {
            font-style: normal;
            color: #000;
        }

        /* ==========================================
       CONTACT TABLE
    ========================================== */

        .contact-table {
            width: 100%;
            border: 1px solid #E4E6EF;
            border-radius: 8px;
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
            background: #fff;
        }

        .contact-table td {
            padding: 12px 14px;
            font-size: 11px;
            vertical-align: middle;
        }

        .contact-table td+td {
            border-left: 1px solid #E4E6EF;
        }

        .contact-table tr:not(:last-child) td {
            border-bottom: 1px solid #E4E6EF;
        }

        .contact-label {
            width: 28%;
            background: #F5F8FA;
            color: #3F4254;
            font-weight: 600;
            border-left: 3px solid #A1A5B7;
        }

        .contact-value {
            background: #fff;
            color: #3F4254;
        }

        /* ==========================================
       BADGES
    ========================================== */

        .badge {
            display: inline-block;
            padding: 3px 8px;
            font-size: 10px;
            border-radius: 12px;
            font-weight: 700;
            margin-right: 6px;
        }

        .badge.green {
            background: #50CD89;
            color: #fff;
        }

        .service-badge {
            background: #F5F8FA;
            color: #3F4254;
            border-left: 3px solid #A1A5B7;
            border-radius: 6px;
        }

        /* ==========================================
       SEVERITY
    ========================================== */

        .severity-low,
        .severity-medium,
        .severity-high {
            padding: 4px 10px;
            border-radius: 12px;
            font-weight: bold;
            font-size: 10px;
            display: inline-block;
        }

        .severity-low {
            background: #50CD89;
            color: #fff;
        }

        .severity-medium {
            background: #FFC700;
            color: #000;
        }

        .severity-high {
            background: #F1416C;
            color: #fff;
        }

        /* ==========================================
       CONTENT BOX
    ========================================== */

        .content-box {
            border: 1px solid #E4E6EF;
            border-radius: 8px;
            padding: 15px;
            background: #fff;
        }
    </style>


</head>

<body>

    {{-- HEADER --}}
    <div class="header">


        <div class="title">
            ROOT CAUSE ANALYSIS (RFO)
        </div>

        <div class="subtitle">
            Reference: {{ $rfo->rfo_number }}
        </div>
    </div>

    {{-- BASIC INFO --}}
    <div class="rfo-section">
        <div class="rfo-title">1. INCIDENT SUMMARY</div>

        <table class="rfo-table">
            <tr>
                <th>RFO Number</th>
                <td>{{ $rfo->rfo_number }}</td>

                <th>Severity</th>
                <td>
                    @if ($rfo->severity == 'high')
                        <span class="severity-high">HIGH</span>
                    @elseif($rfo->severity == 'medium')
                        <span class="severity-medium">MEDIUM</span>
                    @else
                        <span class="severity-low">LOW</span>
                    @endif
                </td>
            </tr>

            <tr>
                <th>Incident Title</th>
                <td colspan="3">{{ $rfo->title }}</td>
            </tr>

            <tr>
                <th>Detection Time</th>
                <td>{{ $rfo->detection_time }}</td>

                <th>Restoration Time</th>
                <td>{{ $rfo->full_restore_time }}</td>
            </tr>

            <tr>
                <th>Duration</th>
                <td> {{ \Carbon\CarbonInterval::minutes($rfo->total_duration_minutes)->cascade()->forHumans() }}</td>

                <th>Affected Service</th>
                <td>
                    @foreach ($rfo->affected_services as $service)
                        <span class="badge service-badge">
                            {{ $service['value'] }}
                        </span>
                    @endforeach
                </td>
            </tr>
        </table>
    </div>


    {{-- ROOT CAUSE --}}
    <div class="rfo-section">

        <h3 class="section-heading" style="color: #1E3C96;">
            2. Root Cause Analysis
        </h3>

        <p class="section-paragraph">
            {!! $rfo->root_cause !!}
        </p>

    </div>

    {{-- TImeline --}}
    <div class="rfo-section">
        <h3 class="section-heading" style="color: #1E3C96;">
            3. INCIDENT TIMELINE
        </h3>
        <table class="timeline-table">
            <thead>
                <tr>
                    <th width="25%">Timestamp</th>
                    <th>Description</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($rfo->timelines as $timeline)
                    <tr>
                        <td class="timeline-time">
                            {{ $timeline->timeline_time }}
                        </td>

                        <td class="timeline-description">
                            {{ $timeline->timeline_action }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- IMPACT ASSESS --}}
    <div class="rfo-section">

        <h3 class="section-heading" style="color: #1E3C96;">
            4. IMPACT ASSESSMENT
        </h3>

        <table class="impact-grid">
            <tr>
                <td>
                    <div class="impact-card">
                        <div class="impact-card-title">Service Impact</div>
                        <div class="impact-card-body">
                            {{ $rfo->service_impact }}
                        </div>
                    </div>
                </td>

                <td>
                    <div class="impact-card">
                        <div class="impact-card-title">Partial Restoration</div>
                        <div class="impact-card-body">
                            {{ $rfo->partial_restoration_notes }}
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="impact-card">
                        <div class="impact-card-title">Full Restoration</div>
                        <div class="impact-card-body">
                            {{ $rfo->full_restoration_notes }}
                        </div>
                    </div>
                </td>

                <td>
                    <div class="impact-card">
                        <div class="impact-card-title">Data Integrity</div>
                        <div class="impact-card-body">
                            {{ $rfo->data_integrity }}
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    {{-- CORRECTIVE PREVENTIVE  --}}
    <div class="rfo-section">

        <h3 class="section-heading" style="color: #1E3C96;">
            5. CORRECTIVE ACTIONS
        </h3>

        <p class="section-paragraph">
            {!! nl2br(e($rfo->corrective)) !!}
        </p>

    </div>

    {{-- STATEMENT APPOLOGY --}}
    <div class="rfo-section">

        <h3 class="section-heading" style="color: #1E3C96;">
            6. STATTEMENT OF APPOLOGY
        </h3>

        <div class="apology-box">
            <p class="apology-text">
                “Paratus Telecom Mozambique sincerely apologises to all clients and stakeholders affected by this
                service
                disruption.
                We recognise the impact that any loss of connectivity has on your operations and take this matter
                seriously.”
            </p>

            <p class="apology-text">
                Our technical teams acted promptly to investigate and restore services as quickly and safely as
                possible.
                We remain committed to delivering a reliable, resilient network and maintaining clear communication
                during
                any service-impacting incidents.
            </p>

            <p class="apology-text">
                We appreciate your patience and continued trust in <strong>Paratus Telecom Mozambique</strong> as
                we
                continuously
                improve our network performance and service reliability.
            </p>
        </div>

    </div>

    {{-- CONTACT INFO --}}
    <div class="rfo-section">
        <h3 class="section-heading" style="color: #1E3C96;">
            7. CONTACT INFORMATION
        </h3>
        <table class="contact-table">
            <tr>
                <td class="contact-label">Network Operations</td>
                <td class="contact-value">
                    <span class="badge green">24/7</span>
                    support.mz@paratus.africa
                </td>
            </tr>

            <tr>
                <td class="contact-label">Support Hotline</td>
                <td class="contact-value">
                    📞 +258 85 687 7714
                </td>
            </tr>

            <tr>
                <td class="contact-label">Address</td>
                <td class="contact-value">
                    📍 Av Marginal N 9017, Bairro Triunfo, Maputo, Mozambique
                </td>
            </tr>

            <tr>
                <td class="contact-label">Website</td>
                <td class="contact-value">
                    🌐 paratus.africa/mozambique
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
