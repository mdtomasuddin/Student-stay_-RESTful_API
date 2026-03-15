@extends('backend.app')

@section('title', 'Video Management')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- Start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('video.index') }}">Table</a></li>
                                <li class="breadcrumb-item active">Video</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End page title --}}


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">All Videos</h5>
                            <a href="{{ route('video.create') }}" class="btn btn-primary btn-sm" id="addNewPage">Add Video
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
                                            <th>Module</th>
                                            <th>Title</th>
                                            <th>Link</th>
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

    {{-- Modal for viewing Video details start --}}
    <div class="modal fade" id="viewVideoModal" tabindex="-1" aria-labelledby="VideoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="VideoModalLabel" class="modal-title">Video Details</h5>
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
    {{-- Modal for viewing Video details end --}}
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
                        url: "{{ route('video.index') }}",
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
                            name: 'module.course.title',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'module_title',
                            name: 'module.title',
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
                            data: 'link',
                            name: 'link',
                            orderable: false,
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

        function getYoutubeId(url) {
            var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
            var match = url.match(regExp);
            if (match && match[2].length == 11) {
                return match[2];
            } else {
                return null;
            }
        }

        async function showVideoDetails(id) {
            let modalBody = document.querySelector('#viewVideoModal .modal-body');
            modalBody.innerHTML =
                '<div class="text-center mb-3"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';

            let url = '{{ route('video.show', ['video' => ':id']) }}';
            url = url.replace(':id', id);

            try {
                let response = await axios.get(url);
                if (response.data && response.data.data) {
                    let data = response.data.data;
                    let embedHtml = '';

                    if (data.link.trim().startsWith('<iframe')) {
                        embedHtml = `<div class="mb-3 text-center">${data.link}</div>`;
                    } else {
                        let videoId = getYoutubeId(data.link);
                        if (videoId) {
                            embedHtml = `
                                <div class="ratio ratio-16x9 mb-3">
                                    <iframe src="https://www.youtube.com/embed/${videoId}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                </div>`;
                        } else {
                            embedHtml = `<div class="alert alert-warning">Invalid YouTube link for preview.</div>`;
                        }
                    }

                    let linkDisplay = '';
                    if (data.link.trim().startsWith('<iframe')) {
                        linkDisplay = 'Embed Code';
                    } else {
                        linkDisplay = `<a href="${data.link}" target="_blank">${data.link}</a>`;
                    }

                    let modalBody = document.querySelector('#viewVideoModal .modal-body');
                    modalBody.innerHTML = `
                        ${embedHtml}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Course:</strong> 
                                <p class="text-dark">${data.module && data.module.course ? data.module.course.title : 'N/A'}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Module:</strong> 
                                <p class="text-dark">${data.module ? data.module.title : 'N/A'}</p>
                            </div>
                            <div class="col-md-12 mb-3">
                                <strong>Video Title:</strong> 
                                <p class="text-dark">${data.title}</p>
                            </div>
                            <div class="col-md-12 mb-0">
                                <strong>Link:</strong> 
                                <p class="text-dark">${linkDisplay}</p>
                            </div>
                        </div>`;
                }
            } catch (error) {
                console.error(error);
                toastr.error('Could not fetch Video details.');
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
            let url = '{{ route('video.status', ['id' => ':id']) }}'.replace(':id', id);
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
            let url = '{{ route('video.destroy', ['video' => ':id']) }}'.replace(':id', id);
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
