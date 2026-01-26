@extends('backend.app')

@section('title', 'Properties Management')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">All Properties Management</h5>
                        </div>
                        <div class="card-body">
                            <table id="property-table" class="table table-bordered table-striped align-middle"
                                style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Agent Name</th>
                                        <th class="text-center">Bathrooms</th>
                                        <th class="text-center">Bedrooms</th>
                                        <th class="text-center">duration_period</th>
                                        <th class="text-center">City</th>
                                        <th class="text-center">Property Type</th>
                                        <th class="text-center">Price</th>
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
@endsection

@push('scripts')
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
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'user',
                        name: 'user'
                    },
                    {
                        data: 'bathrooms',
                        name: 'bathrooms',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'bedrooms',
                        name: 'bedrooms',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'duration_period',
                        name: 'duration_period',
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
                        data: 'price',
                        name: 'price'
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
        });
    </script>
@endpush
