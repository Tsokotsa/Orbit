<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-size: 9px;
            font-family: Arial, sans-serif;
        }

        .footer {
            width: 100%;
            border-top: 1px solid #d9d9d9;
            padding-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            vertical-align: middle;
        }

        .left {
            text-align: left;
        }

        .right {
            text-align: right;
            white-space: nowrap;
        }

        .footer-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            vertical-align: middle;
        }

        .footer-badge-blue {
            background: #E8F0FF;
            color: #1E3C96;
            border: 1px solid #C7D7FF;
        }

        .footer-badge-red {
            background: #FDECEC;
            color: #D9214E;
            border: 1px solid #F5C2C7;
        }

        .footer-badge-green {
            background: #E8FFF3;
            color: #50CD89;
            border: 1px solid #B8F5D1;
        }
    </style>
</head>

<body>

    <div class="footer">
        <table>
            <tr>
                <td class="left">
                    Powered By &copy; Orbit
                    |
                    Paratus Telecom Mozambique
                    |

                    @if ($rfo->classification === 'public')
                        <span class="footer-badge footer-badge-green">PUBLIC</span>
                    @elseif($rfo->classification === 'clients')
                        <span class="footer-badge footer-badge-blue">CLIENT CONFIDENTIAL</span>
                    @else
                        <span class="footer-badge footer-badge-red">INTERNAL USE ONLY</span>
                    @endif
                </td>

                <td class="right">
                    Page <span class="pageNumber"></span>
                    of
                    <span class="totalPages"></span>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
