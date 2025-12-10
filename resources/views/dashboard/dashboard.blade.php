@extends('layout.app')
@section('content')
    <div class="container">
        <h5>Dashboard</h5>
        <hr>
        <div class="row">
            <h5 class="mb-4">Task Progress Overview</h5>
            <!-- Summary Cards -->
            <div class="row mb-4">

                <div class="col-md-3">
                    <div class="card shadow-sm p-3 text-center bg-primary text-white">
                        <h6>Total Tasks</h6>
                        <h3>{{ $total }}</h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm p-3 text-center bg-success text-white">
                        <h6>Completed</h6>
                        <h3>{{ $completed }}</h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm p-3 text-center bg-warning text-dark">
                        <h6>Pending</h6>
                        <h3>{{ $pending }}</h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm p-3 text-center bg-danger text-white">
                        <h6>High Priority</h6>
                        <h3>{{ $priority_high }}</h3>
                    </div>
                </div>

            </div>

            <!-- Completed vs Pending Chart -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm p-3">
                    <h5 class="text-center">Task Status</h5>
                    <canvas id="statusChart" height="150"></canvas>
                </div>
            </div>

            <!-- Priority Distribution Chart -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm p-3">
                    <h5 class="text-center">Task Priority</h5>
                    <canvas id="priorityChart" height="150"></canvas>
                </div>
            </div>
        </div>
        <p></p>

    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Status Chart (Doughnut)
        new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'Pending'],
                datasets: [{
                    data: [{{ $completed }}, {{ $pending }}],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // Priority Chart (Bar)
    new Chart(document.getElementById('priorityChart'), {
        type: 'bar',
        data: {
            labels: ['Low', 'Medium', 'High'],
            datasets: [{
                label: 'Tasks',
                data: [
        {{ $priority_low }},
        {{ $priority_medium }},
        {{ $priority_high }}
        ],
        borderWidth: 1
    }]
},
options: {
    responsive: true,
    scales: {
        y: {
            beginAtZero: true,
            ticks: { precision: 0 }
        }
    }
}
});
    </script>
@endsection
