@extends('backend.app')

@section('title')
    {{ env('APP_NAME') }} || Show Property Details
@endsection

@section('content')
    <div id="app-content">
        <div class="app-content-area">
            <div class="container-fluid mb-3">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12 mx-auto px-5">
                        <!-- Page Header -->
                        <div class="mb-3">
                            <h2 class="h3 mb-1">Property Details</h2>
                            <p class="text-muted">Detailed overview of <strong>{{ $property->title }}</strong></p>
                        </div>

                        <!-- Image Gallery -->
                        <div class="card mb-3 shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Property Images Showcase</h5>
                            </div>
                            <div class="card-body">
                                @if ($property->images && count($property->images) > 0)
                                    <div class="row g-3">
                                        @foreach ($property->images as $image)
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <img src="{{ $image }}" class="img-fluid rounded border w-100"
                                                    alt="Property Image"
                                                    style="height: 200px; object-fit: cover; cursor: pointer;">
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <p class="text-muted mb-0">No images available.</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Basic Information -->
                        <div class="card mb-3 shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Basic Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3 p-3 bg-light rounded">
                                    <div class="col-md-4 mb-3 mb-md-0">
                                        <small class="text-muted d-block mb-1">Title</small>
                                        <strong>{{ $property->title }}</strong>
                                    </div>
                                    <div class="col-md-4 mb-3 mb-md-0">
                                        <small class="text-muted d-block mb-1">Property Type</small>
                                        <strong>{{ $property->category->name ?? 'N/A' }}</strong>
                                    </div>
                                    <div class="col-md-4">
                                        <small class="text-muted d-block mb-1">Status</small>
                                        <span
                                            class="badge {{ $property->status == 'approved' ? 'bg-success' : ($property->status == 'pending' ? 'bg-warning text-dark' : 'bg-danger') }}">
                                            {{ ucfirst($property->status) }}
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                                        <small class="text-muted d-block mb-1">Price</small>
                                        <strong class="text-primary">£{{ number_format($property->price, 2) }}</strong>
                                        <small class="d-block text-muted">per {{ $property->duration_period }}</small>
                                    </div>
                                    <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                                        <small class="text-muted d-block mb-1">Bedrooms</small>
                                        <strong>{{ $property->bedrooms }}</strong>
                                    </div>
                                    <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                                        <small class="text-muted d-block mb-1">Bathrooms</small>
                                        <strong>{{ $property->bathrooms }}</strong>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <small class="text-muted d-block mb-1">Available From</small>
                                        <strong>{{ $property->available_from ? $property->available_from->format('d M, Y') : 'N/A' }}</strong>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <small class="text-muted d-block mb-1">City</small>
                                        <strong>{{ $property->city->name ?? 'N/A' }}</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted d-block mb-1">Location</small>
                                        <strong>{{ $property->location }}</strong>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <small class="text-muted d-block mb-1">Full Address</small>
                                        <strong>{{ $property->full_address }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Amenities & Bills -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card shadow-sm h-auto">
                                    <div class="card-header bg-white border-bottom">
                                        <h5 class="mb-0">Amenities</h5>
                                    </div>
                                    <div class="card-body">
                                        @if (count($property->amenities) > 0)
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach ($property->amenities as $amenity)
                                                    <span
                                                        class="badge bg-info bg-opacity-10 text-info border border-info px-3 py-2">
                                                        <i class="bi bi-check-circle me-1"></i> {{ $amenity['name'] }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-muted mb-0">No amenities listed.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card shadow-sm h-auto">
                                    <div class="card-header bg-white border-bottom">
                                        <h5 class="mb-0">Bills Included</h5>
                                    </div>
                                    <div class="card-body">
                                        @if (count($property->bill_included) > 0)
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach ($property->bill_included as $bill)
                                                    <span
                                                        class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2">
                                                        <i class="bi bi-lightning me-1"></i> {{ $bill['name'] }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-muted mb-0">No bills included.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="card mb-3 shadow-sm h-auto">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Description</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-dark mb-0" style="line-height: 1.8; white-space: pre-line;">
                                    {{ $property->description }}</p>
                            </div>
                        </div>

                        <!-- Nearby Universities Section -->
                        <div class="card mb-5 shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">
                                    <i class="bi bi-book me-2 text-primary"></i>Nearby Universities
                                </h5>
                            </div>
                            <div class="card-body mb-5">
                                <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                                    <table class="table table-hover table-striped mb-0">
                                        <thead class="table-light sticky-top">
                                            <tr>
                                                <th class="ps-3" style="min-width: 200px;">University Name</th>
                                                <th style="min-width: 100px;">Distance</th>
                                                <th style="min-width: 110px;">Walk Time</th>
                                                <th style="min-width: 110px;">Cycle Time</th>
                                                <th style="min-width: 110px;">Drive Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($property->universities as $university)
                                                <tr>
                                                    <td class="ps-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-2 flex-shrink-0"
                                                                style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="bi bi-mortarboard"></i>
                                                            </div>
                                                            <span class="fw-semibold">{{ $university->name }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="text-dark">{{ $university->distance ?? 'N/A' }}
                                                            miles</span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-info bg-opacity-10 text-info">
                                                            <i
                                                                class="bi bi-person-walking me-1"></i>{{ $university->walk_time ?? '0' }}
                                                            mins
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-success bg-opacity-10 text-success">
                                                            <i
                                                                class="bi bi-bicycle me-1"></i>{{ $university->cycle_time ?? '0' }}
                                                            mins
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-warning bg-opacity-10 text-warning">
                                                            <i
                                                                class="bi bi-car-front me-1"></i>{{ $university->drive_time ?? '0' }}
                                                            mins
                                                        </span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center py-5">
                                                        <div class="text-muted">
                                                            <i class="bi bi-inbox display-4 d-block mb-3"></i>
                                                            <p class="mb-0">No nearby university information found for
                                                                this property.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Right Sidebar --}}
                    <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 mx-auto px-5">
                        <!-- Agent Info Card -->
                        <div class="card mt-5 shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Agent Info</h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <img src="{{ $property->user->avatar ?? 'https://via.placeholder.com/100' }}"
                                        class="rounded-circle border border-3 border-light shadow-sm" width="100"
                                        height="100" style="object-fit: cover;"
                                        alt="{{ $property->user->first_name }}">
                                </div>
                                <h5 class="mb-1">{{ $property->user->first_name }} {{ $property->user->last_name }}
                                </h5>
                                <p class="text-muted mb-3 small">Property Agent</p>
                                <hr>
                                <div class="text-start">
                                    <p class="mb-2">
                                        <small class="text-muted d-block">Email</small>
                                        <strong class="small">{{ $property->user->email }}</strong>
                                    </p>
                                    <p class="mb-3">
                                        <small class="text-muted d-block">Joined</small>
                                        <strong class="small">{{ $property->user->created_at->format('M Y') }}</strong>
                                    </p>
                                </div>
                                <div class="d-grid">
                                    <a href="mailto:{{ $property->user->email }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-envelope me-1"></i> Contact Agent
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Settings Card -->
                        <div class="card shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Quick Settings</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center px-0 border-0">
                                        <span class="text-muted">Featured Property</span>
                                        <span class="badge {{ $property->is_feature ? 'bg-primary' : 'bg-secondary' }}">
                                            {{ $property->is_feature ? 'Yes' : 'No' }}
                                        </span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center px-0 border-0">
                                        <span class="text-muted">Availability</span>
                                        <span class="badge {{ $property->is_available ? 'bg-success' : 'bg-danger' }}">
                                            {{ $property->is_available ? 'Yes' : 'No' }}
                                        </span>
                                    </li>
                                </ul>
                                <div class="mt-3 d-grid">
                                    <a href="{{ route('manage-properties.index') }}"
                                        class="btn btn-outline-secondary btn-sm">
                                        <i class="bi bi-arrow-left me-1"></i> Back to Properties List
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
