<canvas
    id="chart"
    style="display: block; width: 762px; height: 300px;"
    width="762"
    height="300"
></canvas>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
    <script>
        var config = {
            type: "doughnut",
            data: {
                datasets: [{
                    data: JSON.parse(`<?php echo isset($chart_data['caregiver_count_arr']) ? $chart_data['caregiver_count_arr'] : []; ?>`),
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.8)",
                        "rgba(54, 162, 235, 0.8)",
                        "rgba(255, 206, 86, 0.8)",
                        "rgba(75, 192, 192, 0.8)",
                    ],
                }],
                labels: JSON.parse(`<?php echo isset($chart_data['caregiver_position_arr']) ? $chart_data['caregiver_position_arr'] : []; ?>`),
            },
            options: {
                responsive: false,
                legend: {
                    position: "bottom",
                },
                animation: {
                    animateScale: false,
                    animateRotate: false,
                }
            }
        };

        window.onload = function () {
            var ctx = document.getElementById("chart").getContext("2d");
            window.chart = new Chart(ctx, config);
        };
    </script>
@endpush
