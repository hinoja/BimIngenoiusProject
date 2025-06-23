@extends('layouts.back')

@section('subtitle', __('Dashboard'))

@section('content')
    <x-admin.section-header :title="__('Dashboard')" :previousTitle="__('Home')" :previousRouteName="route('admin.dashboard')" />

    <div class="section-body">
        <div class="container-fluid">

            <!-- Filters -->
            <div class="row mb-4 align-items-center">
                <div class="col-lg-8">
                    <h1 class="h3 mb-0 text-dark font-weight-bold">@lang('Dashboard')</h1>
                </div>
                <div class="col-lg-4 d-flex justify-content-end">
                    <form action="{{ route('admin.dashboard') }}" method="GET" class="form-inline">
                        <label for="year" class="mr-2 text-dark font-weight-bold">@lang('Year')</label>
                        <select name="year" id="year" class="form-control mr-2" onchange="this.form.submit()">
                            @foreach ($years as $y)
                                <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            <!-- KPIs -->
            <div class="row mb-4">
                <x-admin.stat-card color="primary" icon="tasks" :value="$stats['totalProjects'] ?? 0" label="{{ __('Projects') }}" />
                <x-admin.stat-card color="success" icon="users" :value="$stats['totalUsers'] ?? 0" label="{{ __('Users') }}" />
                <x-admin.stat-card color="info" icon="tags" :value="$stats['totalCategories'] ?? 0" label="{{ __('Categories') }}" />
                <x-admin.stat-card color="warning" icon="file-invoice-dollar" :value="$stats['totalQuotes'] ?? 0" label="{{ __('Quotes') }}" />
                <x-admin.stat-card color="danger" icon="envelope" :value="$stats['totalMessages'] ?? 0" label="{{ __('Messages') }}" />
                <x-admin.stat-card color="secondary" icon="newspaper" :value="$stats['totalNews'] ?? 0" label="{{ __('News') }}" />
                <x-admin.stat-card color="dark" icon="clipboard-list" :value="$stats['totalPlans'] ?? 0" label="{{ __('Plans') }}" />
            </div>

            <!-- Main Charts -->
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="card shadow-sm card-chart">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-chart-line mr-2 text-primary"></i>@lang('Projects Evolution') ({{ $year }})</h5>
                        </div>
                        <div class="card-body" style="height: 350px;">
                            <canvas id="projectsPerMonthChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm card-chart">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-chart-bar mr-2 text-warning"></i>@lang('Incoming Requests')</h5>
                        </div>
                        <div class="card-body" style="height: 350px;">
                            <canvas id="requestsPerMonthChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secondary Charts -->
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm card-chart">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-layer-group mr-2 text-info"></i>@lang('By Category')</h5>
                        </div>
                        <div class="card-body" style="height: 250px;">
                            <canvas id="projectsByCategoryChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm card-chart">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-flag mr-2 text-success"></i>@lang('Top 10 Countries')</h5>
                        </div>
                        <div class="card-body" style="height: 250px;">
                            <canvas id="projectsByCountryChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm card-chart">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-tasks mr-2 text-secondary"></i>@lang('By Status')</h5>
                        </div>
                        <div class="card-body" style="height: 250px;">
                            <canvas id="projectsByStatusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .card-chart {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 4px 24px rgba(44, 62, 80, 0.07);
        }

        .card-chart .card-header {
            background: linear-gradient(90deg, #2A2E45 60%, #FF6B35 100%);
            color: #fff;
            border-bottom: 2px solid #FF6B35;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .card-chart .card-body {
            position: relative;
            background: #f8f9fb;
        }

        .stat-card {
            border-radius: 1rem;
            box-shadow: 0 4px 16px rgba(44, 62, 80, 0.09);
            background: linear-gradient(120deg, #fff 60%, #f5f7fa 100%);
            transition: transform 0.2s, box-shadow 0.2s;
            margin-bottom: 1.5rem;
        }

        .stat-card:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 8px 32px rgba(44, 62, 80, 0.13);
        }

        .stat-card .icon {
            font-size: 2.5em;
            opacity: 0.85;
            margin-right: 0.7em;
        }

        .stat-card .h5 {
            font-weight: bold;
            color: #2A2E45;
        }

        @media (max-width: 991px) {
            .card-chart .card-body {
                min-height: 180px;
            }

            .stat-card {
                margin-bottom: 1rem;
            }
        }
    </style>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const chartData = @json($chartData);

            const chartColors = {
                primary: 'rgba(78, 115, 223, 1)',
                primary_bg: 'rgba(78, 115, 223, 0.2)',
                success: 'rgba(28, 200, 138, 1)',
                success_bg: 'rgba(28, 200, 138, 0.2)',
                info: 'rgba(54, 185, 204, 1)',
                info_bg: 'rgba(54, 185, 204, 0.2)',
                warning: 'rgba(246, 194, 62, 1)',
                warning_bg: 'rgba(246, 194, 62, 0.2)',
                danger: 'rgba(231, 74, 59, 1)',
                danger_bg: 'rgba(231, 74, 59, 0.2)',
                dark: 'rgba(58, 69, 88, 1)',
                dark_bg: 'rgba(58, 69, 88, 0.2)',
                secondary: 'rgba(108, 117, 125, 1)',
                secondary_bg: 'rgba(108, 117, 125, 0.2)',
            };

            const defaultChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: '#2A2E45',
                            font: {
                                family: 'Nunito, Segoe UI, Arial'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#2A2E45',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#FF6B35',
                        borderWidth: 1,
                        padding: 10,
                        cornerRadius: 8,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += context.parsed.y;
                                }
                                // Pour les graphiques doughnut/pie, afficher le pourcentage
                                if (context.chart.config.type === 'doughnut' || context.chart.config.type === 'pie') {
                                    const total = context.chart.getDatasetMeta(0).total;
                                    const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) + '%' : '0%';
                                    label = `${context.label}: ${context.parsed} (${percentage})`;
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#2A2E45'
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        ticks: {
                            color: '#2A2E45'
                        },
                        grid: {
                            color: '#eaecf4'
                        }
                    }
                }
            };

            // Projets par mois
            if (document.getElementById('projectsPerMonthChart')) {
                new Chart(document.getElementById('projectsPerMonthChart'), {
                    type: 'line',
                    data: {
                        labels: chartData.projectsPerMonth.labels,
                        datasets: [{
                            label: 'Projets',
                            data: Object.values(chartData.projectsPerMonth.data),
                            backgroundColor: chartColors.primary_bg,
                            borderColor: chartColors.primary,
                            borderWidth: 2,
                            pointBackgroundColor: chartColors.primary,
                            tension: 0.4
                        }]
                    },
                    options: defaultChartOptions
                });
            }

            // Demandes entrantes
            if (document.getElementById('requestsPerMonthChart')) {
                new Chart(document.getElementById('requestsPerMonthChart'), {
                    type: 'line',
                    data: {
                        labels: chartData.requestsPerMonth.labels,
                        datasets: [{
                            label: 'Messages',
                            data: Object.values(chartData.requestsPerMonth.contacts),
                            borderColor: chartColors.warning,
                            backgroundColor: chartColors.warning_bg,
                            tension: 0.3
                        }, {
                            label: 'Devis',
                            data: Object.values(chartData.requestsPerMonth.quotes),
                            borderColor: chartColors.dark,
                            backgroundColor: chartColors.dark_bg,
                            tension: 0.3
                        }]
                    },
                    options: defaultChartOptions
                });
            }

            // Répartition par catégorie
            if (document.getElementById('projectsByCategoryChart')) {
                new Chart(document.getElementById('projectsByCategoryChart'), {
                    type: 'bar',
                    data: {
                        labels: chartData.projectsByCategory.labels,
                        datasets: [{
                            label: 'Projets',
                            data: chartData.projectsByCategory.data,
                            backgroundColor: [
                                chartColors.primary_bg, chartColors.success_bg, chartColors
                                .info_bg,
                                chartColors.warning_bg, chartColors.danger_bg, chartColors
                                .secondary_bg
                            ],
                            borderColor: [
                                chartColors.primary, chartColors.success, chartColors.info,
                                chartColors.warning, chartColors.danger, chartColors.secondary
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        ...defaultChartOptions,
                        indexAxis: 'y',
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }

            // Top 10 des pays
            if (document.getElementById('projectsByCountryChart')) {
                new Chart(document.getElementById('projectsByCountryChart'), {
                    type: 'bar',
                    data: {
                        labels: chartData.projectsByCountry.labels,
                        datasets: [{
                            label: 'Projets',
                            data: chartData.projectsByCountry.data,
                            backgroundColor: chartColors.success_bg,
                            borderColor: chartColors.success,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        ...defaultChartOptions,
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }

            // Répartition par statut
            if (document.getElementById('projectsByStatusChart')) {
                new Chart(document.getElementById('projectsByStatusChart'), {
                    type: 'doughnut',
                    data: {
                        labels: chartData.projectsByStatus.labels,
                        datasets: [{
                            data: chartData.projectsByStatus.data,
                            backgroundColor: [
                                chartColors.success, chartColors.warning, chartColors.danger,
                                chartColors.info
                            ],
                            borderColor: '#fff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        ...defaultChartOptions,
                        scales: {},
                        plugins: {
                            legend: {
                                position: 'right'
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush
