<x-app-layout>
    @section('title', 'Statistik Belajar')
    @section('page_title', 'Statistik & Analisa Tugas')

    <div class="row g-4 mb-4">
        <!-- Task Completion status (Doughnut Chart) -->
        <div class="col-12 col-lg-4">
            <div class="card border-0 rounded-4 shadow-sm p-4 h-100">
                <h5 class="fw-bold text-dark mb-4"><i class="bi bi-pie-chart-fill text-indigo me-2"></i>Status Penyelesaian</h5>
                <div style="position: relative; height:250px; width:100%">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Tasks by Subject (Bar Chart) -->
        <div class="col-12 col-lg-8">
            <div class="card border-0 rounded-4 shadow-sm p-4 h-100">
                <h5 class="fw-bold text-dark mb-4"><i class="bi bi-bar-chart-steps text-indigo me-2"></i>Jumlah Tugas Per Mata Kuliah</h5>
                <div style="position: relative; height:250px; width:100%">
                    <canvas id="subjectChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Tasks by Month (Line Chart) -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 rounded-4 shadow-sm p-4">
                <h5 class="fw-bold text-dark mb-4"><i class="bi bi-graph-up text-indigo me-2"></i>Frekuensi Tugas Bulanan (Tahun Ini)</h5>
                <div style="position: relative; height:300px; width:100%">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                fetch("{{ route('student.statistics.data') }}")
                    .then(response => response.json())
                    .then(data => {
                        // 1. Status Chart (Doughnut)
                        new window.Chart(document.getElementById('statusChart'), {
                            type: 'doughnut',
                            data: {
                                labels: data.status.labels,
                                datasets: [{
                                    data: data.status.data,
                                    backgroundColor: ['#10b981', '#f59e0b'], // Green, Yellow
                                    borderWidth: 2,
                                    borderColor: '#ffffff'
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            boxWidth: 12,
                                            font: { family: 'Outfit' }
                                        }
                                    }
                                }
                            }
                        });

                        // 2. Subject Chart (Bar)
                        new window.Chart(document.getElementById('subjectChart'), {
                            type: 'bar',
                            data: {
                                labels: data.subject.labels,
                                datasets: [{
                                    label: 'Jumlah Tugas',
                                    data: data.subject.data,
                                    backgroundColor: '#6366f1', // Indigo
                                    borderRadius: 8,
                                    borderWidth: 0
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: { display: false }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            stepSize: 1,
                                            font: { family: 'Outfit' }
                                        },
                                        grid: { color: '#f1f5f9' }
                                    },
                                    x: {
                                        ticks: { font: { family: 'Outfit' } },
                                        grid: { display: false }
                                    }
                                }
                            }
                        });

                        // 3. Monthly Chart (Line)
                        new window.Chart(document.getElementById('monthlyChart'), {
                            type: 'line',
                            data: {
                                labels: data.monthly.labels,
                                datasets: [{
                                    label: 'Tugas Masuk',
                                    data: data.monthly.data,
                                    borderColor: '#a855f7', // Purple
                                    backgroundColor: 'rgba(168, 85, 247, 0.1)',
                                    fill: true,
                                    tension: 0.4,
                                    borderWidth: 3,
                                    pointBackgroundColor: '#a855f7'
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: { display: false },
                                    tooltip: { font: { family: 'Outfit' } }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            stepSize: 1,
                                            font: { family: 'Outfit' }
                                        },
                                        grid: { color: '#f1f5f9' }
                                    },
                                    x: {
                                        ticks: { font: { family: 'Outfit' } },
                                        grid: { color: '#f1f5f9' }
                                    }
                                }
                            }
                        });
                    });
            });
        </script>
    @endpush
</x-app-layout>
