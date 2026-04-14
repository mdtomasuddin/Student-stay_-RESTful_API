@extends('backend.app')

@section('title', 'Module Management')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- Start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('module.index') }}">Table</a></li>
                                <li class="breadcrumb-item active">Module</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End page title --}}


            <div class="row">
                <div class="col-lg-11">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">All Modules</h5>
                            <a href="{{ route('module.create') }}" class="btn btn-primary btn-sm" id="addNewPage">Add Module
                                <i class="bi bi-arrow-right"></i></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable"
                                    class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Course</th>
                                            <th>Title</th>
                                            <th style="width: 8%">Status</th>
                                            <th style="width: 15%">Action</th>
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

    {{-- Modal for viewing Module details start --}}
    <div class="modal fade" id="viewModuleModal" tabindex="-1" aria-labelledby="ModuleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="ModuleModalLabel" class="modal-title">Module Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Dynamic data filled by JS --}}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal for viewing Module details end --}}
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            if (!$.fn.DataTable.isDataTable('#datatable')) {
                var table = $('#datatable').DataTable({
                    responsive: true,
                    order: [],
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"],
                    ],
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('module.index') }}",
                        type: "GET",
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            className: 'text-center'
                        },
                        {
                            data: 'course_title',
                            name: 'course.title',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'title',
                            name: 'title',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: false,
                            searchable: false,
                            className: 'text-center'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            className: 'text-center'
                        },
                    ],
                });
            }
        });

        async function showModuleDetails(id) {
            let modalBody = document.querySelector('#viewModuleModal .modal-body');
            modalBody.innerHTML =
                '<div class="text-center mb-3"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';

            let url = '{{ route('module.show', ['module' => ':id']) }}';
            url = url.replace(':id', id);

            try {
                let response = await axios.get(url);
                if (response.data && response.data.data) {
                    let data = response.data.data;
                    let modalBody = document.querySelector('#viewModuleModal .modal-body');
                    modalBody.innerHTML = `
                        <div class="mb-3">
                            <strong>Course:</strong> 
                            <p class="text-dark">${data.course ? data.course.title : 'N/A'}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Module Title:</strong> 
                            <p class="text-dark">${data.title}</p>
                        </div>
                        <div class="mb-0">
                            <strong>Description:</strong> 
                            <p class="text-dark">${data.description ?? 'N/A'}</p>
                        </div>`;
                }
            } catch (error) {
                console.error(error);
                toastr.error('Could not fetch Module details.');
            }
        }

        function showStatusChangeAlert(id) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to update the status?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    statusChange(id);
                }
            });
        }

        function statusChange(id) {
            let url = '{{ route('module.status', ['id' => ':id']) }}'.replace(':id', id);
            $.ajax({
                type: "GET",
                url: url,
                success: function(resp) {
                    $('#datatable').DataTable().ajax.reload();
                    if (resp.success === true) {
                        toastr.success(resp.message);
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function(error) {
                    toastr.error('An error occurred. Please try again.');
                }
            });
        }

        function showDeleteConfirm(id) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: 'If you delete this, it will be gone forever.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteItem(id);
                }
            });
        }

        function deleteItem(id) {
            let url = '{{ route('module.destroy', ['module' => ':id']) }}'.replace(':id', id);
            $.ajax({
                type: "DELETE",
                url: url,
                success: function(resp) {
                    $('#datatable').DataTable().ajax.reload();
                    if (resp['t-success']) {
                        toastr.success(resp.message);
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function(error) {
                    toastr.error('An error occurred. Please try again.');
                }
            });
        }
    </script>
@endpush
