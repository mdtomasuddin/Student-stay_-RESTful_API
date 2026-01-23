@extends('backend.app')

@section('title')
    {{ env('APP_NAME') }} || Edit Digital Resource
@endsection

@section('content')
    <div id="app-content">
        <div class="app-content-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-9 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col-12">
                                <div id="edit" class="mb-4">
                                    <h2 class="h3 mb-1">Edit Digital Resource</h2>
                                    <p>Update the Digital Resource details below and submit.</p>
                                </div>

                                <div class="card mb-10">
                                    <div class="tab-content p-4">
                                        <form action="{{ route('digital-resources.update', $data->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            {{-- Title --}}
                                            <div class="form-group mb-4">
                                                <label class="label text-secondary">Title</label>
                                                <input type="text"
                                                    class="form-control text-dark ps-3 h-55 @error('title') is-invalid @enderror"
                                                    name="title" value="{{ old('title', $data->title) }}"
                                                    placeholder="Enter title here" required>
                                                @error('title')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Type --}}
                                            <div class="form-group mb-4">
                                                <label class="label text-secondary">Type</label>
                                                <select name="type"
                                                    class="form-control text-dark ps-3 h-55 @error('type') is-invalid @enderror"
                                                    required>
                                                    <option value="">Select Type</option>
                                                    <option value="video_url"
                                                        {{ old('type', $data->type) === 'video_url' ? 'selected' : '' }}>
                                                        Video URL</option>
                                                    <option value="pdf"
                                                        {{ old('type', $data->type) === 'pdf' ? 'selected' : '' }}>PDF
                                                    </option>
                                                </select>
                                                @error('type')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Access --}}
                                            {{-- <div class="form-group mb-4">
                                                <label class="label text-secondary">Access</label>
                                                <select name="access"
                                                    class="form-control text-dark ps-3 h-55 @error('access') is-invalid @enderror"
                                                    required>
                                                    <option value="">Select Access Type</option>
                                                    <option value="free"
                                                        {{ old('access', $data->access) === 'free' ? 'selected' : '' }}>
                                                        Free</option>
                                                    <option value="paid"
                                                        {{ old('access', $data->access) === 'paid' ? 'selected' : '' }}>
                                                        Paid</option>
                                                </select>
                                                @error('access')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div> --}}

                                            {{-- Description --}}
                                            <div class="form-group mb-4">
                                                <label class="label text-secondary">Description</label>
                                                <textarea class="form-control text-dark ps-3 @error('description') is-invalid @enderror" name="description"
                                                    placeholder="Enter description here" rows="4">{{ old('description', $data->description) }}</textarea>
                                                @error('description')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- File Path --}}
                                            <div class="form-group mb-4" id="filePathGroup" style="display: none;">
                                                <label class="label text-secondary">PDF File</label>
                                                <input type="file" name="file_path"
                                                    class="form-control @error('file_path') is-invalid @enderror"
                                                    accept=".pdf">
                                                @if ($data->file_path)
                                                    <small class="text-muted">Current file: <a
                                                            href="{{ asset($data->file_path) }}"
                                                            target="_blank">Download</a></small>
                                                @endif
                                                @error('file_path')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- External URL --}}
                                            <div class="form-group mb-4" id="externalUrlGroup" style="display: none;">
                                                <label class="label text-secondary">Video URL</label>
                                                <input type="url"
                                                    class="form-control text-dark ps-3 h-55 @error('external_url') is-invalid @enderror"
                                                    name="external_url"
                                                    value="{{ old('external_url', $data->external_url) }}"
                                                    placeholder="Enter video URL here">
                                                @error('external_url')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Buttons --}}
                                            <div class="d-flex flex-wrap gap-3 mt-4">
                                                <a href="{{ route('digital-resources.index') }}"
                                                    class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</a>
                                                <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                                                    <i class="ri-check-line text-white fw-medium"></i> Update
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div> <!-- card -->
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar Nav --}}
                    <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-12 d-none d-xl-block position-fixed end-0">
                        <div class="sidebar-nav-fixed">
                            <span class="px-4 mb-2 d-block text-uppercase ls-md h3 fs-6">Contents</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.querySelector('select[name="type"]');
            const filePathGroup = document.getElementById('filePathGroup');
            const externalUrlGroup = document.getElementById('externalUrlGroup');

            function updateVisibility() {
                const selectedType = typeSelect.value;
                if (selectedType === 'pdf') {
                    filePathGroup.style.display = 'block';
                    externalUrlGroup.style.display = 'none';
                } else if (selectedType === 'video_url') {
                    filePathGroup.style.display = 'none';
                    externalUrlGroup.style.display = 'block';
                } else {
                    filePathGroup.style.display = 'none';
                    externalUrlGroup.style.display = 'none';
                }
            }

            typeSelect.addEventListener('change', updateVisibility);
            updateVisibility(); // Initial call
        });
    </script>
@endsection
