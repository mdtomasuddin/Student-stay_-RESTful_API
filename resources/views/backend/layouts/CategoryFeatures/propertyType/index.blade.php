@extends('backend.app')

@section('title', 'Property Type*')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- Page Title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('property-types.index') }}">Table</a></li>
                                <li class="breadcrumb-item active">Property Type</li>
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
                            <h5 class="card-title mb-0">All Property Type</h5>
                            <a href="{{ route('property-types.create') }}" class="btn btn-primary btn-sm">Add Property
                                Type</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered table-striped align-middle"
                                    style="width:100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Dynamic Data --}}
                                    </tbody>
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
            var dTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('property-types.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
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
                    },
                ],
                order: [],
            });
        });

        // Change status function
        function changeStatus(event, id) {
            event.preventDefault();
            Swal.fire({
                title: 'Change status?',
                text: 'Are you sure you want to toggle the status?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, change it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(`/property-types/status/${id}`, {
                            _token: '{{ csrf_token() }}'
                        })
                        .done(res => {
                            toastr.success(res.message);
                            $('#datatable').DataTable().ajax.reload(null, false);
                        })
                        .fail(() => toastr.error('Status update failed.'));
                }
            });
        }

        // Delete record function
        function deleteRecord(event, id) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/property-types/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: res => {
                            toastr.success(res.message);
                            $('#datatable').DataTable().ajax.reload(null, false);
                        },
                        error: () => {
                            toastr.error('Delete failed. Please try again.');
                        }
                    });
                }
            });
        }
    </script>
@endpush
