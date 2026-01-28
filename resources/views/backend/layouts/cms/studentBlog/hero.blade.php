@extends('backend.app')

@section('title', 'Student Blog Hero Banner')

@section('content')
    <div class="main-content-container">
        {{-- Header Section --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h3 class="mb-0">Student Blog Hero Banner </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Student Blog Hero Banner</li>
                </ol>
            </nav>
        </div>

        <div class="page-content py-4">
            <div class="container-fluid">
                {{-- Main Form Card --}}
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Student Blog Hero Banner</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('student-blog-hero.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-lg-5 bg-light py-3 px-4 rounded">
                                    {{-- Current Image Display --}}
                                    <div class="mb-4 text-center">
                                        <label class="form-label d-block text-muted small text-uppercase fw-bold">Current
                                            Image</label>
                                        @if ($data->image)
                                            <img src="{{ asset($data->image) }}" class="img-thumbnail shadow-sm"
                                                style="max-height: 180px; width: 100%; object-fit: cover;">
                                        @else
                                            <div class="alert alert-secondary py-4">No image currently set.</div>
                                        @endif
                                    </div>

                                    <hr>

                                    {{-- New Preview --}}
                                    <div class="text-center mt-4">
                                        <label class="form-label d-block text-primary small text-uppercase fw-bold">Live New
                                            Preview</label>
                                        <div class="preview-container border rounded bg-white p-2 d-flex align-items-center justify-content-center"
                                            style="min-height: 200px;">
                                            <img id="imagePreview"
                                                src="{{ asset('backend/assets/images/placeholder-image.png') }}"
                                                class="img-fluid rounded" style="display: none; max-height: 190px;">
                                            <div id="previewText" class="text-muted">
                                                <i class="ri-image-add-line fs-1"></i>
                                                <p class="mb-0">Select an image to preview</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-7 border-end">
                                    {{-- image --}}
                                    <div class="mb-3">
                                        <label for="image" class="form-label fw-bold">Background Image:</label>

                                        <div class="border border-2 border-dashed rounded p-5 text-center  position-relative"
                                            style="cursor: pointer; transition: all 0.3s;"
                                            onclick="document.getElementById('image').click()"
                                            ondrop="event.preventDefault(); this.style.backgroundColor='#f8f9fa'; handleDrop(event);">
                                            <p class="mb-1 fw-semibold text-dark">Click</p>
                                            <input type="file" class="d-none @error('image') is-invalid @enderror"
                                                id="image" name="image" accept="image">
                                        </div>
                                        @error('image')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- Hero title  --}}
                                    <div class="mb-3">
                                        <label for="title" class="form-label fw-bold">Hero Title:</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            id="title" name="title" value="{{ old('title', $data->title) }}"
                                            placeholder="Enter hero title...">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- Hero sub title  --}}
                                    <div class="mb-3">
                                        <label for="sub_title" class="form-label fw-bold">Hero Sub Title:</label>
                                        <input type="text" class="form-control @error('sub_title') is-invalid @enderror"
                                            id="sub_title" name="sub_title" value="{{ old('sub_title', $data->sub_title) }}"
                                            placeholder="Enter hero sub title...">
                                        @error('sub_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- Hero description  --}}
                                    <div class="mb-3">
                                        <label for="description" class="form-label fw-bold">Hero Description:</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                            rows="4" placeholder="Enter hero description...">{{ old('description', $data->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 d-flex gap-2 justify-content-end">
                                        <a href="{{ route('student-blog-hero.index') }}"
                                            class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">
                                            <i class="ri-close-line"></i> Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                                            <i class="ri-check-line"></i> Create
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Live Image Preview Logic
        document.getElementById('image').onchange = function(evt) {
            const [file] = this.files;
            if (file) {
                const preview = document.getElementById('imagePreview');
                const placeholder = document.getElementById('previewText');

                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
                placeholder.style.display = 'none';
            }
        }
    </script>
@endpush
