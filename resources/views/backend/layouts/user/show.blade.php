@extends('backend.app')

@section('title', 'User Details')

@section('content')
    <div id="app-content">
        <div class="app-content-area">
            <div class="container-fluid mb-3">
                @php
                    $fullName = trim(($data->first_name ?? '') . ' ' . ($data->last_name ?? ''));
                    $displayName = $fullName !== '' ? $fullName : 'N/A';
                    $displayRole = !empty($data->role) ? ucfirst($data->role) : 'N/A';
                    $displayStatus = !empty($data->status) ? ucfirst($data->status) : 'N/A';
                    $statusBadgeClass = match ($data->status ?? null) {
                        'active' => 'bg-success',
                        'inactive' => 'bg-light text-dark border',
                        default => 'bg-light text-dark border',
                    };
                @endphp
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12 mx-auto px-4 px-lg-5">
                        <div class="mb-3 d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div>
                                <h2 class="h3 mb-1">User Details</h2>
                                <p class="text-muted mb-0">Detailed overview of user profile and account status</p>
                            </div>
                            <a href="{{ route('users.index') }}?userType=all" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-arrow-left me-1"></i> Back to Users
                            </a>
                        </div>

                        <div class="card mb-3 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold shadow"
                                        style="width: 72px; height: 72px; font-size: 1.6rem;">
                                        {{ strtoupper(substr($data->first_name ?? ($data->email ?? 'N/A'), 0, 1)) }}
                                    </div>
                                    <div class="ms-3 ms-md-4">
                                        <h4 class="mb-1 fw-bold">{{ $displayName }}</h4>
                                        <p class="text-muted mb-1">
                                            <i class="bi bi-envelope me-1"></i>
                                            {{ $data->email ?? 'N/A' }}
                                        </p>
                                        <p class="text-muted mb-0">
                                            <i class="bi bi-telephone me-1"></i>
                                            {{ $data->phone ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3 shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Account Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3 p-3 bg-light rounded">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <small class="text-muted d-block mb-1">Email Address</small>
                                        <strong>{{ $data->email ?? 'N/A' }}</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted d-block mb-1">Phone Number</small>
                                        <strong>{{ $data->phone ?? 'N/A' }}</strong>
                                    </div>
                                </div>

                                <hr>

                                <div class="row mb-3">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <small class="text-muted d-block mb-1">Role</small>
                                        <strong>{{ $displayRole }}</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted d-block mb-1">Joined</small>
                                        <span class="badge bg-primary px-3 py-2">
                                            {{ $data->created_at?->format('d M, Y') ?? 'N/A' }}
                                        </span>
                                    </div>
                                </div>

                                <hr>

                                <div>
                                    <small class="text-muted d-block mb-2">Notes</small>
                                    <div class="p-3 bg-light rounded border">
                                        <p class="mb-0 text-dark" style="white-space: pre-line; line-height: 1.7;">
                                            {{ $data->notes ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 mx-auto px-4 px-lg-5">
                        <div class="card mt-lg-5 shadow-sm mb-3">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Status Overview</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted">Current Status</span>
                                    <span class="badge {{ $statusBadgeClass }}">{{ $displayStatus }}</span>
                                </div>

                                <div class="border-top pt-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted small">Joined On</span>
                                        <span class="small fw-bold">{{ $data->created_at?->format('d M, Y') ?? 'N/A' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted small">Last Updated</span>
                                        <span class="small fw-bold text-secondary">{{ $data->updated_at?->format('d M, Y') ?? 'N/A' }}</span>
                                    </div>
                                </div>

                                <div class="mt-3 d-grid">
                                    <a href="{{ route('users.index') }}?userType=all" class="btn btn-outline-secondary btn-sm">
                                        <i class="bi bi-arrow-left me-1"></i> Back to Users
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
