@extends('backend.app')

@section('title')
    {{ env('APP_NAME') }} || Create Popular Student City
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
                                    <h2 class="h3 mb-1">Create Popular Student City</h2>
                                    <p>Create the details below and submit.</p>
                                </div>

                                <div class="card mb-10">
                                    <div class="tab-content p-4">
                                        <form action="{{ route('cities.store') }}" method="POST"
                                            enctype="multipart/form-data">


                                            @csrf

                                            {{-- Name --}}
                                            <div class="form-group mb-4">
                                                <label class="label text-secondary"> Name</label>
                                                <input type="text"
                                                    class="form-control text-dark ps-3 h-55 @error('name') is-invalid @enderror"
                                                    name="name" value="{{ old('name') }}" placeholder="Enter name here"
                                                    required>
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-4">
                                                <label class="label text-secondary">Image</label>
                                                <input type="file" name="image"
                                                    class="dropify form-control @error('image') is-invalid @enderror"
                                                    accept="image">
                                                @error('image')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-4">
                                                <label class="label text-secondary">Properties Available</label>
                                                <input type="number"
                                                    class="form-control text-dark ps-3 h-55 @error('properties_available') is-invalid @enderror"
                                                    name="properties_available" value="{{ old('properties_available') }}"
                                                    placeholder="Enter properties available here" required>
                                                @error('properties_available')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-4">
                                                <label class="label text-secondary">University Name</label>
                                                <input type="text"
                                                    class="form-control text-dark ps-3 h-55 @error('university_name') is-invalid @enderror"
                                                    name="university_name" value="{{ old('university_name') }}"
                                                    placeholder="Enter university name here" required>
                                                @error('university_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-4">
                                                <label class="label text-secondary">Location</label>
                                                <input type="text"
                                                    class="form-control text-dark ps-3 h-55 @error('location') is-invalid @enderror"
                                                    name="location" value="{{ old('location') }}"
                                                    placeholder="Enter location here" required>
                                                @error('location')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Buttons --}}
                                            <div class="d-flex flex-wrap gap-3 mt-4">
                                                <a href="{{ route('cities.index') }}"
                                                    class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</a>
                                                <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                                                    <i class="ri-check-line text-white fw-medium"></i> Create
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
                                <li><a href="#edit">Edit</a></li>
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
