<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #chart-container {
            position: relative;
            margin: auto;
            height: 80vh; /* Adjust height as needed */
            width: 80vw;  /* Adjust width as needed */
        }
    </style>
</head>
<body>

        <canvas id="myChart"></canvas>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach ($tanggal_pengembalian as $item)
                            '{{$item}}',
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Selesai Dipinjam',
                        data: [
                            @foreach ($count as $item)
                                {{$item}},
                            @endforeach
                        ],
                        backgroundColor: '#f012be',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Diagram Selesai Pinjam',
                            font: {
                                size: 18
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                callback: function(value) {
                                    return Number.isInteger(value) ? value : null;
                                }
                            }
                        }
                    }
                }
            });

            window.addEventListener('updateChart', event => {
                console.log('Received data:', event.detail);
                myChart.data.labels = event.detail.tanggal_pengembalian;
                myChart.data.datasets[0].data = event.detail.count;
                myChart.update();

                // Update the chart info
                document.getElementById('chart-info').innerHTML = 'Diagram untuk bulan: ' + new Date(event.detail.bulan_tahun + '-01').toLocaleString('default', { month: 'long', year: 'numeric' });
            });
        });
    </script>
</body>
</html>
