<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            margin: 0;
            padding: 0 20px;
            font-size: 10px;
            font-family: Arial, sans-serif;
        }

        .header {
            width: 100%;
            border-bottom: 1px solid #d9d9d9;
            /* padding-bottom: 8px; */
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .logo {
            width: 120px;
            padding: 0px;
            margin: 0px;
        }

        .title {
            text-align: center;
            font-size: 16px;
            font-weight: 700;
            color: #181c32;
        }
    </style>
</head>

<body>

    <div class="header">
        <table class="table">
            <tr>
                <td width="25%">
                    <img src="data:image/png;base64,{{ $logo }}" style="height:96px;">
                </td>

                <td width="50%" class="title">
                    Network Operations Center
                </td>

                <td width="25%"></td>
            </tr>
        </table>
    </div>

</body>

</html>
