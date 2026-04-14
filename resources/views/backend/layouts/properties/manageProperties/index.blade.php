@extends('backend.app')

@section('title', 'Properties Management')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- Page Title --}}
            <div class="row">
                <div class="col-lg-11">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('manage-properties.index') }}">Table</a></li>
                                <li class="breadcrumb-item active">Properties</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card with table --}}
            <div class="row">
                <div class="col-lg-11">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">All Properties </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="property-table" class="table table-bordered  table-striped align-middle"
                                    style="width:100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Agent Name</th>
                                            <th>Description</th>
                                            <th>City</th>
                                            <th>Property Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            let table = $('#property-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('manage-properties.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'user',
                        name: 'user'
                    },
                    {
                        data: 'description',
                        name: 'description',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'city.name',
                        name: 'city.name',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'category.name',
                        name: 'category.name',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // AJAX Status Update
            $(document).on('change', '.change-status', function() {
                let id = $(this).data('id');
                let status = $(this).val();

                $.ajax({
                    url: "{{ route('manage-properties.update-status') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        status: status
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            table.ajax.reload(null,
                                false);
                        }
                    },
                    error: function() {
                        toastr.error("Something went wrong!");
                    }
                });
            });

            window.deleteRecord = function(event, id) {
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/manage-properties/${id}`,
                            type: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                toastr.success(response.message);
                                table.ajax.reload(null, false);
                            },
                            error: function() {
                                toastr.error('Delete failed. Please try again.');
                            }
                        });
                    }
                });
            }
        });
    </script>
@endpush
