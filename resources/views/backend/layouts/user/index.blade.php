@extends('backend.app')

@section('title', 'Users')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- Card with table --}}
            <div class="row">
                <div class="col-lg-11">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-transparent border-bottom d-flex justify-content-between align-items-center py-3">
                            <h5 class="card-title mb-0 fw-semibold">Users List</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="user-table" class="table table-hover table-bordered align-middle"
                                    style="width:100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" style="width: 50px;">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Joined Date</th>
                                            <th class="text-center" style="width: 120px;">Action</th>
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
                ajax: "{{ route('users.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        class: 'text-center'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        class: 'fw-medium'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        class: 'text-center'
                    }
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search users...",
                    lengthMenu: "_MENU_ entries",
                    paginate: {
                        previous: '<i class="bi bi-chevron-left"></i>',
                        next: '<i class="bi bi-chevron-right"></i>'
                    }
                },
                drawCallback: function() {
                    $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                }
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
