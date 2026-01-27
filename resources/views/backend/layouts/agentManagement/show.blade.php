@extends('backend.app')

@section('title', 'Letting Agent')

@section('content')
    <div class="container-fluid px-4 py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0">Letting Agent Management Details & Status Management</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('manage-agents.index') }}"
                                class="text-decoration-none">Agents</a></li>
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('manage-agents.index') }}" class="btn btn-outline-secondary shadow-sm">
                <i class="bi bi-arrow-left"></i> Back to Agents
            </a>
        </div>

        <div class="row g-4">
            <div class="col-xl-8 col-lg-7">

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold shadow"
                                style="width: 70px; height: 70px; font-size: 1.5rem;">
                                {{ strtoupper(substr($agent->full_name, 0, 1)) }}
                            </div>
                            <div class="ms-4">
                                <h4 class="mb-1 fw-bold">{{ $agent->full_name }}</h4>
                                <p class="text-muted mb-0">
                                    <span class="me-3"><i class="bi bi-geo-alt"></i>
                                        {{ $agent->city->name ?? 'City N/A' }}</span>
                                    <span><i class="bi bi-building"></i>
                                        {{ $agent->letting_agent_name ?? 'Individual Agent' }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-transparent border-bottom py-3">
                        <h5 class="card-title mb-0 fw-bold">Letting Agent Information*</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-sm-6">
                                <label class="small text-uppercase text-muted fw-semibold">Email Address</label>
                                <p class="fw-bold text-dark">{{ $agent->email }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="small text-uppercase text-muted fw-semibold">Phone Number</label>
                                <p class="fw-bold text-dark">{{ $agent->phone }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="small text-uppercase text-muted fw-semibold">Source</label>
                                <p class="mb-0 fw-bold">{{ $agent->source }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="small text-uppercase text-muted fw-semibold">Properties Managed</label>
                                <p class="mb-0"><span
                                        class="badge rounded-pill bg-primary px-3">{{ $agent->properties_managed_count }}
                                        Units</span></p>
                            </div>
                        </div>

                        <hr class="my-4 opacity-10">

                        <div class="col-12">
                            <label class="small text-uppercase text-muted fw-semibold">Internal Notes</label>
                            <div class="p-3 bg-light rounded mt-2 border">
                                <p class="text-dark mb-0 italic">
                                    {{ $agent->notes ?? 'No additional notes provided for this agent.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-5 my-3 p-2">
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="card-title mb-0 fw-bold">Agent Status Change</h5>
                        <small>Change the status of this agent Approval Create a new agent</small>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <span
                                class="badge rounded-pill fw-bold fs-6 
                            {{ $agent->status == 'approved' ? 'bg-success-subtle text-success' : ($agent->status == 'rejected' ? 'bg-danger-subtle text-danger' : 'bg-warning-subtle text-warning') }}">
                                <i class="bi bi-circle-fill small"></i> Currently: {{ ucfirst($agent->status) }}
                            </span>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold">Change Status of Agent <small>(approved, pending,
                                    rejected)</small></label>
                            <div class="dropdown">
                                <button
                                    class="btn btn-white border w-100 d-flex justify-content-between align-items-center dropdown-toggle"
                                    type="button" data-bs-toggle="dropdown">
                                    Agent Status
                                </button>
                                <ul class="dropdown-menu shadow w-100">
                                    <li><a class="dropdown-item status-btn py-2" href="#" data-status="approved"><span
                                                class="text-success">●</span> Approved</a></li>
                                    <li><a class="dropdown-item status-btn py-2" href="#" data-status="pending"><span
                                                class="text-warning">●</span> Pending</a></li>
                                    <li><a class="dropdown-item status-btn py-2" href="#" data-status="rejected"><span
                                                class="text-danger">●</span> Rejected</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="border-top pt-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Applied On:</span>
                                <span class="small fw-bold">{{ $agent->created_at->format('d M, Y') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Time:</span>
                                <span class="small fw-bold">{{ $agent->created_at->format('h:i A') }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted small">IP Address:</span>
                                <span class="small fw-bold text-secondary">{{ $agent->ip_address }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0 p-3">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $('.status-btn').on('click', function(e) {
                e.preventDefault();
                let status = $(this).data('status');
                let url = "{{ route('manage-agents.update-status', $agent->id) }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        status: status
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        let errorMsg = xhr.responseJSON ? xhr.responseJSON.message :
                            'Something went wrong';
                        toastr.error(errorMsg);
                    }
                });
            });
        </script>
    @endpush
@endsection
