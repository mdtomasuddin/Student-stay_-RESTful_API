@extends('backend.app')

@section('title', 'Users')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-11">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Users</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="user-table" class="table table-bordered dt-responsive table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Role</th>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            scrollX: true,
            autoWidth: false,
            ajax: "{{ route('users.index') }}",
            columnDefs: [
                { responsivePriority: 1, targets: [1, 6] },
                { responsivePriority: 2, targets: [3, 4] },
                { responsivePriority: 100, targets: '_all' }
            ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, class: 'text-center' },
                { data: 'first_name', name: 'first_name' },
                { data: 'last_name', name: 'last_name' },
                { data: 'phone', name: 'phone' },
                { data: 'email', name: 'email' },
                { data: 'role', name: 'role' },
                { data: 'action', name: 'action', orderable: false, searchable: false, class: 'text-center' }
            ]
        });
    });

    // Delete record function
    function deleteRecord(event, id) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'This user will be permanently deleted!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/users/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: res => {
                        toastr.success(res.message);
                        $('#user-table').DataTable().ajax.reload(null, false);
                    },
                    error: (xhr) => {
                        const msg = xhr.responseJSON?.message || 'Delete failed. Please try again.';
                        toastr.error(msg);
                    }
                });
            }
        });
    }
</script>
@endpush
