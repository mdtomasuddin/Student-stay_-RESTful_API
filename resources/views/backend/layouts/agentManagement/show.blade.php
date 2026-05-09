@extends('backend.app')

@section('title', 'Letting Agent')

@section('content')
    <div id="app-content">
        <div class="app-content-area">
            <div class="container-fluid mb-3">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12 mx-auto px-4 px-lg-5">
                        <div class="mb-3 d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div>
                                <h2 class="h3 mb-1">Letting Agent Details</h2>
                                <p class="text-muted mb-0">Detailed overview of agent profile and account status</p>
                            </div>
                            <a href="{{ route('manage-agents.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-arrow-left me-1"></i> Back to Agents
                            </a>
                        </div>

                        <div class="card mb-3 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold shadow"
                                        style="width: 72px; height: 72px; font-size: 1.6rem;">
                                        {{ strtoupper(substr($agent->full_name, 0, 1)) }}
                                    </div>
                                    <div class="ms-3 ms-md-4">
                                        <h4 class="mb-1 fw-bold">{{ $agent->full_name }}</h4>
                                        <p class="text-muted mb-1">
                                            <i class="bi bi-building me-1"></i>
                                            {{ $agent->letting_agent_name ?? 'Individual Agent' }}
                                        </p>
                                        <p class="text-muted mb-0">
                                            <i class="bi bi-geo-alt me-1"></i>
                                            {{ $agent->city->name ?? 'City N/A' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3 shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Agent Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3 p-3 bg-light rounded">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <small class="text-muted d-block mb-1">Email Address</small>
                                        <strong>{{ $agent->email ?? 'N/A' }}</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted d-block mb-1">Phone Number</small>
                                        <strong>{{ $agent->phone ?? 'N/A' }}</strong>
                                    </div>
                                </div>

                                <hr>

                                <div class="row mb-3">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <small class="text-muted d-block mb-1">Source</small>
                                        <strong>{{ $agent->source ?? 'N/A' }}</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted d-block mb-1">Properties Managed</small>
                                        <span class="badge bg-primary px-3 py-2">
                                            {{ $agent->properties_managed_count ?? 0 }} Units
                                        </span>
                                    </div>
                                </div>

                                <hr>

                                <div>
                                    <small class="text-muted d-block mb-2">Internal Notes</small>
                                    <div class="p-3 bg-light rounded border">
                                        <p class="mb-0 text-dark" style="white-space: pre-line; line-height: 1.7;">
                                            {{ $agent->notes ?? 'No additional notes provided for this agent.' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3 shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Current Managed Properties</h5>
                            </div>
                            <div class="card-body">
                                @if ($agentProperties->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped align-middle mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>User ID</th>
                                                    <th>Title</th>
                                                    <th>Location</th>
                                                    <th>Full Address</th>
                                                    <th>Amenities</th>
                                                    <th>Bill Included</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($agentProperties as $property)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $property->user_id ?? 'N/A' }}</td>
                                                        <td>{{ $property->title ?? 'N/A' }}</td>
                                                        <td>{{ $property->location ?? 'N/A' }}</td>
                                                        <td>{{ $property->full_address ?? 'N/A' }}</td>
                                                        <td style="max-width: 220px; white-space: normal;">
                                                            @php
                                                                $amenities = collect($property->amenities ?? [])
                                                                    ->map(function ($item) {
                                                                        if (is_array($item)) {
                                                                            return $item['name'] ?? null;
                                                                        }
                                                                        return $item;
                                                                    })
                                                                    ->filter()
                                                                    ->values();
                                                            @endphp
                                                            {{ $amenities->isNotEmpty() ? $amenities->implode(', ') : 'N/A' }}
                                                        </td>
                                                        <td style="max-width: 220px; white-space: normal;">
                                                            @php
                                                                $billIncluded = collect($property->bill_included ?? [])
                                                                    ->map(function ($item) {
                                                                        if (is_array($item)) {
                                                                            return $item['name'] ?? null;
                                                                        }
                                                                        return $item;
                                                                    })
                                                                    ->filter()
                                                                    ->values();
                                                            @endphp
                                                            {{ $billIncluded->isNotEmpty() ? $billIncluded->implode(', ') : 'N/A' }}
                                                        </td>
                                                        <td>{{ ucfirst($property->status ?? 'N/A') }}</td>
                                                        <td class="text-center">
                                                            <a href="{{ route('manage-properties.edit', $property->id) }}"
                                                                class="btn btn-sm btn-outline-info"
                                                                title="Go to property details">
                                                                <i class="bi bi-box-arrow-up-right"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="alert alert-light border mb-0" role="alert">
                                        No available properties.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 mx-auto px-4 px-lg-5">
                        <div class="card mt-lg-5 shadow-sm mb-3">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Status Overview</h5>
                            </div>
                            <div class="card-body">
                                @php
                                    $statusBadgeClass = match ($agent->status) {
                                        'approved' => 'bg-success',
                                        'pending' => 'bg-warning text-dark',
                                        'rejected' => 'bg-danger',
                                        default => 'bg-light text-dark border',
                                    };
                                @endphp

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted">Current Status</span>
                                    <span class="badge {{ $statusBadgeClass }}">{{ ucfirst($agent->status) }}</span>
                                </div>

                                <div class="border-top pt-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted small">Applied On</span>
                                        <span
                                            class="small fw-bold">{{ $agent->created_at?->format('d M, Y') ?? 'N/A' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted small">Time</span>
                                        <span
                                            class="small fw-bold">{{ $agent->created_at?->format('h:i A') ?? 'N/A' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted small">IP Address</span>
                                        <span class="small fw-bold text-secondary">{{ $agent->ip_address ?? 'N/A' }}</span>
                                    </div>
                                </div>

                                <div class="mt-3 d-grid">
                                    <button type="button" id="openStatusModal" class="btn btn-primary btn-sm">
                                        <i class="bi bi-check2-square me-1"></i> Update Status
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Quick Actions</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('manage-agents.index') }}" class="btn btn-outline-secondary btn-sm">
                                        <i class="bi bi-arrow-left me-1"></i> Back to Agent List
                                    </a>
                                    <button id="deleteAgentBtn" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash me-1"></i> Delete Agent
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="agentStatusModal" tabindex="-1" aria-labelledby="agentStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agentStatusModalLabel">Update Agent Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="agentStatusForm">
                    <div class="modal-body">
                        <p class="text-muted small mb-3">Select a status from the dropdown and confirm update.</p>
                        <div class="mb-3">
                            <label for="agentStatus" class="form-label fw-semibold">Agent Status</label>
                            <select class="form-select" id="agentStatus" name="status" required>
                                <option value="approved">Approved</option>
                                <option value="pending">Pending</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>

                        <small class="text-muted">Note: Status Approved the status will affect the agent's visibility and
                            permissions Agent Deshboard and manage properties,Rooms.</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="submitAgentStatusBtn" class="btn btn-primary">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const agentStatusModal = new bootstrap.Modal(document.getElementById('agentStatusModal'));
            const currentStatus = @json($agent->status);

            $('#openStatusModal').on('click', function() {
                $('#agentStatus').val(currentStatus);
                agentStatusModal.show();
            });

            // Delete agent from show page
            $('#deleteAgentBtn').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This agent will be permanently deleted!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('manage-agents.destroy', $agent->id) }}",
                            type: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(res) {
                                toastr.success(res.message);
                                setTimeout(function() {
                                    window.location.href =
                                        "{{ route('manage-agents.index') }}";
                                }, 800);
                            },
                            error: function(xhr) {
                                const msg = xhr.responseJSON?.message ||
                                    'Delete failed. Please try again.';
                                toastr.error(msg);
                            }
                        });
                    }
                });
            });

            $('#agentStatusForm').on('submit', function(e) {
                e.preventDefault();
                const status = $('#agentStatus').val();
                const url = "{{ route('manage-agents.update-status', $agent->id) }}";
                const submitBtn = $('#submitAgentStatusBtn');

                submitBtn.prop('disabled', true).text('Updating...');

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        status: status
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            agentStatusModal.hide();
                            toastr.success(response.message);
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error(response.message || 'Failed to update status');
                        }
                    },
                    error: function(xhr) {
                        const errorMsg = xhr.responseJSON ? xhr.responseJSON.message :
                            'Something went wrong';
                        toastr.error(errorMsg);
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).text('Update Status');
                    }
                });
            });
        </script>
    @endpush
@endsection
