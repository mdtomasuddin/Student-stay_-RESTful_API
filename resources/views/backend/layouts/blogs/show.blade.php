@extends('backend.app')

@section('title', 'View Blog')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- Page Title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Blog Content Card --}}
            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-3">
                        {{-- Thumbnail --}}
                        <div class="card-body">
                            @if ($data->thumbnail)
                                <img src="{{ $data->thumbnail }}" alt="{{ $data->title }}" class="img-fluid rounded mb-3"
                                    style="max-height: 400px; width: 100%; object-fit: cover;">
                            @else
                                <div class="bg-light rounded p-5 text-center mb-3">
                                    <p class="text-muted">No thumbnail available</p>
                                </div>
                            @endif

                            {{-- Blog Title --}}
                            <h2 class="card-title mb-2">{{ $data->title }}</h2>

                            {{-- Meta Information --}}
                            <div class="d-flex flex-wrap gap-3 mb-4">
                                <div>
                                    <small class="text-muted d-block">Author</small>
                                    <span class="badge bg-info">{{ $data->user?->name ?? 'N/A' }}</span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Category</small>
                                    <span class="badge bg-success">{{ $data->category?->name ?? 'N/A' }}</span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Created</small>
                                    <span class="badge bg-secondary">{{ $data->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>

                            {{-- Blog Content --}}
                            <div class="blog-content">
                                {!! $data->content !!}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4">
                    {{-- Status Card --}}
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Status</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Current Status</span>
                                <span
                                    class="badge {{ $data->status === 'active' ? 'bg-success' : ($data->status === 'draft' ? 'bg-warning' : 'bg-danger') }}">
                                    {{ ucfirst($data->status) }}
                                </span>
                            </div>
                            <button class="btn btn-sm btn-outline-primary w-100"
                                onclick="changeStatus(event, {{ $data->id }})">
                                <i class="ri-refresh-line"></i> Change Status
                            </button>
                        </div>
                    </div>

                    {{-- Featured Card --}}
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Featured</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Featured Status</span>
                                <span class="badge {{ $data->is_featured ? 'bg-warning' : 'bg-secondary' }}">
                                    {{ $data->is_featured ? 'Yes' : 'No' }}
                                </span>
                            </div>
                            <button class="btn btn-sm btn-outline-warning w-100"
                                onclick="toggleFeatured(event, {{ $data->id }})">
                                <i class="ri-star-line"></i> {{ $data->is_featured ? 'Remove Featured' : 'Mark Featured' }}
                            </button>
                        </div>
                    </div>

                    {{-- Delete Card --}}
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Danger Zone</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small mb-3">Once deleted, this action cannot be undone.</p>
                            <button class="btn btn-sm btn-outline-danger w-100"
                                onclick="deleteRecord(event, {{ $data->id }})">
                                <i class="ri-delete-bin-line"></i> Delete Blog
                            </button>
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
        // Change Status
        function changeStatus(e, id) {
            e.preventDefault();
            Swal.fire({
                title: 'Change status?',
                text: "Are you sure you want to toggle the status?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(`/blogs/${id}/status`, {
                            _token: '{{ csrf_token() }}'
                        })
                        .done(res => {
                            toastr.success(res.message);
                            setTimeout(() => location.reload(), 1000);
                        })
                        .fail(() => toastr.error('Status update failed.'));
                }
            });
        }

        // Toggle Featured
        function toggleFeatured(e, id) {
            e.preventDefault();
            Swal.fire({
                title: 'Change featured status?',
                text: "Only one blog can be featured. Previous featured blog will be unfeatured!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(`/blogs/${id}/toggle-featured`, {
                            _token: '{{ csrf_token() }}'
                        })
                        .done(res => {
                            toastr.success(res.message);
                            setTimeout(() => location.reload(), 1000);
                        })
                        .fail(() => toastr.error('Featured status update failed.'));
                }
            });
        }

        // Delete Record
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
                        url: `/blogs/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: res => {
                            toastr.success(res.message);
                            setTimeout(() => {
                                window.location.href = "{{ route('blogs.index') }}";
                            }, 1000);
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
