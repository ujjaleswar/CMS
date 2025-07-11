@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4 fw-bold text-center">College Management System Dashboard</h1>

        {{-- Dashboard Summary Cards --}}
        <div class="row mb-4">
            <div class="col-md-2 col-sm-6 mb-3">
                <div class="card text-dark bg-light h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total Students</h5>
                        <p class="fs-4">{{ $totalStudents }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 mb-3">
                <div class="card text-dark bg-light h-100">
                    <div class="card-body">
                        <h5 class="card-title">Approved</h5>
                        <p class="fs-4">{{ $approvedStudents }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 mb-3">
                <div class="card text-dark bg-light h-100">
                    <div class="card-body">
                        <h5 class="card-title">Rejected</h5>
                        <p class="fs-4">{{ $rejectedStudents }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 mb-3">
                <div class="card text-dark bg-light h-100">
                    <div class="card-body">
                        <h5 class="card-title">Teachers</h5>
                        <p class="fs-4">{{ $totalTeachers }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 mb-3">
                <div class="card text-dark bg-light h-100">
                    <div class="card-body">
                        <h5 class="card-title">Subjects</h5>
                        <p class="fs-4">{{ $totalSubjects }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 mb-3">
                <div class="card text-dark bg-light h-100">
                    <div class="card-body">
                        <h5 class="card-title">Schedules</h5>
                        <p class="fs-4">{{ $totalSchedules }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Chart Section --}}
        <div class="row mt-4">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-primary text-white">Last 6 Monthly Applications</div>
                    <div class="card-body" style="height: 350px;">
                        <canvas id="applicationsChart" style="width: 100%; height: 100%;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-primary text-white">Student Status Overview</div>
                    <div class="card-body" style="height: 350px;">
                        <canvas id="statusPieChart" style="width: 100%; height: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const appCtx = document.getElementById('applicationsChart').getContext('2d');
        const applicationsChart = new Chart(appCtx, {
            type: 'line',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'Applications',
                    data: @json($monthlyApplications),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true,
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

        const pieCtx = document.getElementById('statusPieChart').getContext('2d');
        const statusPieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Approved', 'Rejected', 'Pending'],
                datasets: [{
                    label: 'Status Distribution',
                    data: [{{ $approvedStudents }}, {{ $rejectedStudents }}, {{ $pendingStudents }}],
                    backgroundColor: ['#28a745', '#dc3545', '#ffc107'],
                    borderColor: '#ffffff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
@endpush
