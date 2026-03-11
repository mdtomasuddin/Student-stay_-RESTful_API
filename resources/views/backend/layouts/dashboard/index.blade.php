@extends('backend.app')
@section('title', 'Dashboard')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Header section -->
            <div class="row mb-4 pb-2">
                <div class="col-12">
                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-20 fw-bold mb-1">Student Stay Dashboard Overview</h4>
                            <p class="text-muted mb-0">Experience the next generation of student stay management insights.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vibrant Stats Cards -->
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100" style="background-color: #fff5f2;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <span class="avatar-title rounded-circle fs-3"
                                        style="background-color: #ff7043; color: #fff;">
                                        <i class="ri-home-line"></i>
                                    </span>
                                </div>
                                <p class="text-uppercase fw-bold text-muted mb-0 font-size-13">Total Properties</p>
                            </div>
                            <h3 class="fw-bold mb-1">{{ number_format($total_properties) }}</h3>
                            <p class="text-muted mb-0 mt-2 font-size-12">
                                <span class="{{ $prop_growth_pct >= 0 ? 'text-success' : 'text-danger' }} me-1">
                                    <i class="{{ $prop_growth_pct >= 0 ? 'ri-arrow-up-line' : 'ri-arrow-down-line' }}"></i>
                                    {{ $prop_growth_pct >= 0 ? '+' : '' }}{{ $prop_growth_pct }}%
                                </span> since last month
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100" style="background-color: #f0faf4;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <span class="avatar-title rounded-circle fs-3"
                                        style="background-color: #48bb78; color: #fff;">
                                        <i class="ri-user-star-line"></i>
                                    </span>
                                </div>
                                <p class="text-uppercase fw-bold text-muted mb-0 font-size-13">Total Agents</p>
                            </div>
                            <h3 class="fw-bold mb-1">{{ number_format($total_agents) }}</h3>
                            <p class="text-muted mb-0 mt-2 font-size-12">
                                <span class="{{ $agent_growth_pct_stat >= 0 ? 'text-success' : 'text-danger' }} me-1">
                                    <i
                                        class="{{ $agent_growth_pct_stat >= 0 ? 'ri-arrow-up-line' : 'ri-arrow-down-line' }}"></i>
                                    {{ $agent_growth_pct_stat >= 0 ? '+' : '' }}{{ $agent_growth_pct_stat }}%
                                </span> since last month
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100" style="background-color: #f2f9ff;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <span class="avatar-title rounded-circle fs-3"
                                        style="background-color: #4299e1; color: #fff;">
                                        <i class="ri-building-line"></i>
                                    </span>
                                </div>
                                <p class="text-uppercase fw-bold text-muted mb-0 font-size-13">Total Versity</p>
                            </div>
                            <h3 class="fw-bold mb-1">{{ number_format($total_universities) }}</h3>
                            <p class="text-muted mb-0 mt-2 font-size-12">
                                <span class="{{ $univ_growth_pct >= 0 ? 'text-success' : 'text-danger' }} me-1">
                                    <i class="{{ $univ_growth_pct >= 0 ? 'ri-arrow-up-line' : 'ri-arrow-down-line' }}"></i>
                                    {{ $univ_growth_pct >= 0 ? '+' : '' }}{{ $univ_growth_pct }}%
                                </span> since last month
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100" style="background-color: #fffdf2;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <span class="avatar-title rounded-circle fs-3"
                                        style="background-color: #ecc94b; color: #fff;">
                                        <i class="ri-article-line"></i>
                                    </span>
                                </div>
                                <p class="text-uppercase fw-bold text-muted mb-0 font-size-13">Total Blogs</p>
                            </div>
                            <h3 class="fw-bold mb-1">{{ number_format($total_blogs) }}</h3>
                            <p class="text-muted mb-0 mt-2 font-size-12">
                                <span class="{{ $blog_growth_pct >= 0 ? 'text-success' : 'text-danger' }} me-1">
                                    <i class="{{ $blog_growth_pct >= 0 ? 'ri-arrow-up-line' : 'ri-arrow-down-line' }}"></i>
                                    {{ $blog_growth_pct >= 0 ? '+' : '' }}{{ $blog_growth_pct }}%
                                </span> since last month
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="row">
                <!-- Line Chart: Property vs Agent Growth -->
                <div class="col-xl-7 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div
                            class="card-header bg-white border-0 pt-4 px-4 d-flex align-items-center justify-content-between">
                            <h4 class="card-title fw-bold mb-0">Property vs Agent Analytics</h4>
                        </div>
                        <div class="card-body p-4">
                            <div style="height: 320px;">
                                <canvas id="growthChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Donut Chart: Enquiries Overview -->
                <div class="col-xl-5 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 pt-4 px-4">
                            <h4 class="card-title fw-bold mb-0">Enquiries Distribution</h4>
                        </div>
                        <div class="card-body p-4 d-flex flex-column align-items-center justify-content-center">
                            <div style="height: 250px; width: 100%;">
                                <canvas id="enquiryCircleChart"></canvas>
                            </div>
                            <div class="row text-center mt-4 w-100">
                                <div class="col-6">
                                    <h5 class="fw-bold mb-0 text-primary">{{ $property_enquiries_count }}</h5>
                                    <p class="text-muted font-size-12 mb-0">Total Property Enquiries</p>
                                </div>
                                <div class="col-6">
                                    <h5 class="fw-bold mb-0 text-success">{{ $student_enquiries_count }}</h5>
                                    <p class="text-muted font-size-12 mb-0">Total Student Enquiries</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Properties Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div
                            class="card-header bg-white border-0 pt-4 px-4 d-flex align-items-center justify-content-between">
                            <h4 class="card-title fw-bold mb-0">Latest Available Properties</h4>
                            <a href="{{ route('manage-properties.index') }}"
                                class="btn btn-sm btn-light text-primary fw-bold">View All</a>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle table-nowrap mb-0">
                                    <thead class="bg-light bg-opacity-50">
                                        <tr class="text-muted fw-bold font-size-13">
                                            <th class="ps-4">Property Image</th>
                                            <th>Title & Category</th>
                                            <th>Location & City</th>
                                            <th>Price & Period</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recent_properties as $property)
                                            <tr>
                                                <td class="ps-4">
                                                    @php
                                                        $images = $property->images;
                                                        $first_image =
                                                            is_array($images) && count($images) > 0 ? $images[0] : null;
                                                    @endphp
                                                    @if ($first_image)
                                                        <img src="{{ $first_image }}" alt="Property"
                                                            class="rounded shadow-sm"
                                                            style="width: 80px; height: 50px; object-fit: cover;">
                                                    @else
                                                        <div class="rounded bg-light d-flex align-items-center justify-content-center border"
                                                            style="width: 80px; height: 50px;">
                                                            <i class="ri-image-line text-muted"></i>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6 class="mb-1 fw-bold">{{ Str::limit($property->title, 30) }}
                                                        </h6>
                                                        <span
                                                            class="badge bg-primary-subtle text-primary">{{ $property->category->name ?? 'General' }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mb-1">
                                                        <i class="ri-map-pin-2-line text-danger me-1"></i>
                                                        {{ Str::limit($property->location, 30) }}
                                                    </div>
                                                    <div class="small text-muted">
                                                        <i class="ri-community-line me-1"></i>
                                                        {{ $property->city->name ?? 'City ID: #' . $property->city_id }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="fw-bold text-dark">
                                                        £{{ number_format($property->price, 2) }}</div>
                                                    <small class="text-muted">per
                                                        {{ $property->duration_period ?? 'month' }}</small>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('manage-properties.edit', $property->id) }}"
                                                        class="btn btn-sm btn-primary-subtle fs-5 p-1"
                                                        title="View Property">
                                                        <i class="ri-eye-line"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-4 text-muted">No recent
                                                    properties found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Growth Chart (Property vs Agent)
            const growthCtx = document.getElementById('growthChart').getContext('2d');
            new Chart(growthCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($months) !!},
                    datasets: [{
                            label: 'Properties',
                            data: {!! json_encode($property_growth) !!},
                            borderColor: '#ff7043',
                            backgroundColor: 'transparent',
                            borderWidth: 3,
                            tension: 0.4,
                            pointRadius: 4
                        },
                        {
                            label: 'Agents',
                            data: {!! json_encode($agent_growth) !!},
                            borderColor: '#48bb78',
                            backgroundColor: 'transparent',
                            borderWidth: 3,
                            tension: 0.4,
                            pointRadius: 4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                usePointStyle: true
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                borderDash: [5, 5],
                                color: '#f0f0f0'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Enquiry Circle Chart
            const enquiryCtx = document.getElementById('enquiryCircleChart').getContext('2d');
            new Chart(enquiryCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Property Enquiries', 'Student Enquiries'],
                    datasets: [{
                        data: [{{ $property_enquiries_count }}, {{ $student_enquiries_count }}],
                        backgroundColor: ['#405189', '#0ab39c'],
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                boxWidth: 8,
                                font: {
                                    size: 11
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
