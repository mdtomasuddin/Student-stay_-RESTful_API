@extends('backend.app')

@section('title', 'Chat History')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- Page Title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('reset') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Chat History</li>
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
                            <h5 class="card-title mb-0">AI Chatbot History</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered text-center table-striped align-middle"
                                    style="width:100%">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th>#</th>
                                            <th class="text-nowrap">Full Name</th>
                                            <th class="text-nowrap">Email</th>
                                            <th class="text-nowrap">Phone</th>
                                            <th class="text-nowrap">IP Address</th>
                                            <th class="text-nowrap">Created At</th>
                                            <th class="text-nowrap">Actions</th>
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
    <script>
        $(document).ready(function() {
            var dTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('chat-history.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'full_name',
                        name: 'full_name'
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
                        data: 'ip_address',
                        name: 'ip_address'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [5, 'desc']
                ],
            });
        });

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
                        url: `/chat-history/${id}`,
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
