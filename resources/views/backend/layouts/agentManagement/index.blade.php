@extends('backend.app')

@section('title', 'Agents Management')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Agent Management</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="agent-table" class="table table-bordered dt-responsive table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Full Name</th>
                                        <th>Letting Agent</th>
                                        <th>Email</th>
                                        <th>Total Properties</th>
                                        <th>Date</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
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
<script>
    $(document).ready(function() {
        $('#agent-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            scrollX: true,
            autoWidth: false,
            ajax: "{{ route('manage-agents.index') }}",
            columnDefs: [
                { responsivePriority: 1, targets: [1, 7] },
                { responsivePriority: 2, targets: [3, 6] },
                { responsivePriority: 100, targets: '_all' }
            ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, class: 'text-center' },
                { data: 'full_name', name: 'full_name' },
                { data: 'letting_agent_name', name: 'letting_agent_name' },
                { data: 'email', name: 'email' },
                { data: 'properties_managed_count', name: 'properties_managed_count' },
                { data: 'date', name: 'date' },
                { data: 'status', name: 'status', class: 'text-center' },
                { data: 'action', name: 'action', orderable: false, searchable: false, class: 'text-center' }
            ]
        });
    });
</script>
@endpush