=@extends('backend.app')

@section('title')
    {{ env('APP_NAME') }} || Edit Testimonial
@endsection

@section('content')
    <div id="app-content">
        <div class="app-content-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-9 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col-12">
                                <div id="edit-category" class="mb-4">
                                    <h2 class="h3 mb-1">Edit Testimonial</h2>
                                    <p>Update the category details below and submit.</p>
                                </div>

                                <div class="card mb-10">
                                    <div class="tab-content p-4">
                                        <form action="{{ route('testimonials.update', $data->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            {{--  Name --}}
                                            <div class="form-group mb-4">
                                                <label class="label text-secondary"> Name</label>
                                                <input type="text"
                                                    class="form-control text-dark ps-3 h-55 @error('name') is-invalid @enderror"
                                                    name="name" value="{{ old('name', $data->name) }}"
                                                    placeholder="Enter  name here" required>
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{--  Image --}}
                                            <div class="form-group mb-4">
                                                <label class="label text-secondary"> Image</label>
                                                <input class="dropify form-control @error('image') is-invalid @enderror"
                                                    type="file" name="image" accept="image/*"
                                                    data-default-file="{{ isset($data) && $data->image ? asset($data->image) : '' }}">
                                                @error('image')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            {{-- Position --}}
                                            <div class="form-group mb-4">
                                                <label class="label text-secondary">Position</label>
                                                <input type="text"
                                                    class="form-control text-dark ps-3 h-55 @error('position') is-invalid @enderror"
                                                    name="position" value="{{ old('position', $data->position) }}"
                                                    placeholder="Enter position here">
                                                @error('position')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            {{-- Message --}}
                                            <div class="form-group mb-4">
                                                <label class="label text-secondary">Message</label>
                                                <textarea name="message" class="form-control editor-description text-dark ps-3 @error('message') is-invalid @enderror"
                                                    placeholder="Enter message here">{{ old('message', $data->message) }}</textarea>
                                                @error('message')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Buttons --}}
                                            <div class="d-flex flex-wrap gap-3 mt-4">
                                                <a href="{{ route('testimonials.index') }}"
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
                            <ul class="list-unstyled">
                                <li><a href="#edit-Testimonial">Edit Testimonial</a></li>
                            </ul>
                        </div>
                    </div>
                </div> <!-- row -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Dropify Script --}}
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>
@endpush
