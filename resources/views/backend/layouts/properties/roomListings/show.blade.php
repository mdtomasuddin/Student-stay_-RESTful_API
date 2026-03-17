@extends('backend.app')

@section('title')
    {{ env('APP_NAME') }} || Show Room Listing Details
@endsection

@section('content')
    <div id="app-content">
        <div class="app-content-area">
            <div class="container-fluid mb-3">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12 mx-auto px-5">
                        <!-- Page Header -->
                        <div class="mb-3">
                            <h2 class="h3 mb-1">Room Listing Details</h2>
                            <p class="text-muted">Detailed overview of room in <strong>{{ $roomListing->property->name ?? 'N/A' }}</strong></p>
                        </div>

                        <!-- Image Gallery -->
                        <div class="card mb-3 shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Room Images</h5>
                            </div>
                            <div class="card-body">
                                @if ($roomListing->images && count($roomListing->images) > 0)
                                    <div id="roomImageCarousel" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-indicators">
                                            @foreach ($roomListing->images as $index => $image)
                                                <button type="button" data-bs-target="#roomImageCarousel" data-bs-slide-to="{{ $index }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                                            @endforeach
                                        </div>
                                        <div class="carousel-inner rounded border">
                                            @foreach ($roomListing->images as $index => $image)
                                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                    <img src="{{ $image }}" class="d-block w-100" alt="Room Image {{ $index + 1 }}" style="height: 400px; object-fit: cover;">
                                                </div>
                                            @endforeach
                                        </div>
                                        @if(count($roomListing->images) > 1)
                                            <button class="carousel-control-prev" type="button" data-bs-target="#roomImageCarousel" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#roomImageCarousel" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        @endif
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <p class="text-muted mb-0">No images available for this room.</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Room Basic Information -->
                        <div class="card mb-3 shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Room Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3 p-3 bg-light rounded">
                                    <div class="col-md-4 mb-3 mb-md-0">
                                        <small class="text-muted d-block mb-1">Property</small>
                                        <strong>{{ $roomListing->property->title ?? 'N/A' }}</strong>
                                    </div>
                                    <div class="col-md-4 mb-3 mb-md-0">
                                        <small class="text-muted d-block mb-1">Room Type</small>
                                        @php
                                            $roomTypes = $roomListing->room_type;
                                            $typeNames = is_array($roomTypes) ? collect($roomTypes)->pluck('name')->implode(', ') : 'N/A';
                                        @endphp
                                        <strong>{{ $typeNames }}</strong>
                                    </div>
                                    <div class="col-md-4">
                                        <small class="text-muted d-block mb-1">Status</small>
                                        <span class="badge {{ $roomListing->status == 'available' ? 'bg-success' : 'bg-info' }}">
                                            {{ ucfirst($roomListing->status) }}
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                                        <small class="text-muted d-block mb-1">Price Per Week</small>
                                        <strong class="text-primary">£{{ number_format($roomListing->price_per_week, 2) }}</strong>
                                    </div>
                                    <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                                        <small class="text-muted d-block mb-1">Min Price</small>
                                        <strong>£{{ number_format($roomListing->min_price, 2) }}</strong>
                                    </div>
                                    <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                                        <small class="text-muted d-block mb-1">Max Price</small>
                                        <strong>£{{ number_format($roomListing->max_price, 2) }}</strong>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <small class="text-muted d-block mb-1">Contract Type</small>
                                        <strong>{{ $roomListing->contract_type ?? 'N/A' }}</strong>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-md-3 mb-3 mb-md-0">
                                        <small class="text-muted d-block mb-1">Move In Date</small>
                                        <strong>{{ $roomListing->move_in_date ? $roomListing->move_in_date->format('d M, Y') : 'N/A' }}</strong>
                                    </div>
                                    <div class="col-md-3 mb-3 mb-md-0">
                                        <small class="text-muted d-block mb-1">Move Out Date</small>
                                        <strong>{{ $roomListing->move_out_date ? $roomListing->move_out_date->format('d M, Y') : 'N/A' }}</strong>
                                    </div>
                                    <div class="col-md-3 mb-3 mb-md-0">
                                        <small class="text-muted d-block mb-1">Min Tenancy</small>
                                        <strong>{{ $roomListing->tenancy_weeks_min ?? 'N/A' }} weeks</strong>
                                    </div>
                                    <div class="col-md-3">
                                        <small class="text-muted d-block mb-1">Max Tenancy</small>
                                        <strong>{{ $roomListing->tenancy_weeks_max ?? 'N/A' }} weeks</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Amenities -->
                        <div class="card mb-3 shadow-sm h-auto">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Room Amenities</h5>
                            </div>
                            <div class="card-body">
                                @php
                                    $amenities = $roomListing->amenities;
                                @endphp
                                @if (is_array($amenities) && count($amenities) > 0)
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach ($amenities as $amenity)
                                            <span class="badge bg-info bg-opacity-10 text-info border border-info px-3 py-2">
                                                <i class="bi bi-check-circle me-1"></i> {{ $amenity['name'] }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted mb-0">No specific amenities listed for this room.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="card mb-3 shadow-sm h-auto">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Description</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-dark mb-0" style="line-height: 1.8; white-space: pre-line;">
                                    {{ $roomListing->description ?? 'No description available.' }}</p>
                            </div>
                        </div>

                        <!-- Property Basic Info section -->
                        <div class="card mb-5 shadow-sm">
                            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Property Basic Information</h5>
                                <a href="{{ route('manage-properties.edit', $roomListing->property_id) }}" class="btn btn-sm btn-outline-primary">View Full Property</a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <small class="text-muted d-block mb-1">City</small>
                                        <strong>{{ $roomListing->property->city->name ?? 'N/A' }}</strong>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <small class="text-muted d-block mb-1">Location</small>
                                        <strong>{{ $roomListing->property->location ?? 'N/A' }}</strong>
                                    </div>
                                    <div class="col-md-12">
                                        <small class="text-muted d-block mb-1">Address</small>
                                        <strong>{{ $roomListing->property->full_address ?? 'N/A' }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Right Sidebar --}}
                    <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 mx-auto px-5">
                        <!-- Agent Info Card -->
                        @if($roomListing->property && $roomListing->property->user)
                        <div class="card mt-5 shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Agent Info</h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <img src="{{ $roomListing->property->user->avatar ?? 'https://via.placeholder.com/100' }}"
                                        class="rounded-circle border border-3 border-light shadow-sm" width="100"
                                        height="100" style="object-fit: cover;"
                                        alt="{{ $roomListing->property->user->first_name }}">
                                </div>
                                <h5 class="mb-1">{{ $roomListing->property->user->first_name }} {{ $roomListing->property->user->last_name }}</h5>
                                <p class="text-muted mb-3 small">Property Agent</p>
                                <hr>
                                <div class="text-start">
                                    <p class="mb-2">
                                        <small class="text-muted d-block">Email</small>
                                        <strong class="small">{{ $roomListing->property->user->email }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Quick Settings Card -->
                        <div class="card shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Quick Settings</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 border-0">
                                        <span class="text-muted">Featured Room</span>
                                        <span class="badge {{ $roomListing->is_feature ? 'bg-primary' : 'bg-secondary' }}">
                                            {{ $roomListing->is_feature ? 'Yes' : 'No' }}
                                        </span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 border-0">
                                        <span class="text-muted">Availability</span>
                                        <span class="badge {{ $roomListing->is_available ? 'bg-success' : 'bg-danger' }}">
                                            {{ $roomListing->is_available ? 'Yes' : 'No' }}
                                        </span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 border-0">
                                        <span class="text-muted">Single Occupancy</span>
                                        <span class="badge bg-secondary">
                                            {{ $roomListing->is_single_occupancy ? 'Yes' : 'No' }}
                                        </span>
                                    </li>
                                </ul>
                                <div class="mt-3 d-grid">
                                    <a href="{{ route('room-listings.index') }}"
                                        class="btn btn-outline-secondary btn-sm">
                                        <i class="bi bi-arrow-left me-1"></i> Back to Room List
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
