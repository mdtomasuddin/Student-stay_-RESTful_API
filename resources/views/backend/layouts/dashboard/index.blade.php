@extends('backend.app')
@section('title', 'Dashboard')

@section('content')
    <div class="page-content wrapper">
        <div class="container-fluid ">
            <div class="row mt-5 p-1">
                <div class="col-md-6 m-auto">
                    <h1 class="text-center bg-light">User Registrations <i class="bi bi-arrow-right-circle"></i> Monthly</h1>
                    <div style="position: relative; height: 400px;">
                        <canvas id="BarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Correctly parse data from Controller
            const labels = {!! json_encode($labels) !!};
            const userData = {!! json_encode($userData) !!};

            // Bar Chart (User Data)
            try {
                const Ctx = document.getElementById('BarChart').getContext('2d');
                new Chart(Ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'New Users',
                            data: userData,
                            backgroundColor: 'rgba(75, 192, 192, 0.8)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderRadius: 10,
                            borderWidth: 2,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            } catch (e) {
                console.error('Bar Chart Error:', e);
            }

        });
    </script>
@endpush
