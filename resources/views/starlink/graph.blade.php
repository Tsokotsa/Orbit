<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <h2>Starlink Usage - {{ $device }}</h2>

    <canvas id="usageChart"></canvas>

    <script>
        fetch('/starlink/{{ $device }}/data')
            .then(response => response.json())
            .then(data => {

                const labels = data.map(r => r.recorded_at);
                const tx = data.map(r => r.tx_mbps);
                const rx = data.map(r => r.rx_mbps);

                new Chart(document.getElementById('usageChart'), {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                                label: 'Upload Mbps',
                                data: tx,
                                borderColor: 'red'
                            },
                            {
                                label: 'Download Mbps',
                                data: rx,
                                borderColor: 'blue'
                            }
                        ]
                    }
                });
            });
    </script>

</body>

</html>
