=@extends('backend.app')

@section('title')
    {{ env('APP_NAME') }} || Edit Bills Included Topics
@endsection

@section('content')
    <div id="app-content">
        <div class="app-content-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-9 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col-12">
                                <div id="editId" class="mb-4">
                                    <h2 class="h3 mb-1">Edit Bills Included Topics</h2>
                                    <p>Update the Bills Included Topics details below and submit.</p>
                                </div>

                                <div class="card mb-10">
                                    <div class="tab-content p-4">
                                        <form action="{{ route('bill-includeds.update', $data->id) }}" method="POST"
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



                                            {{-- Buttons --}}
                                            <div class="d-flex flex-wrap gap-3 mt-4">
                                                <a href="{{ route('bill-includeds.index') }}"
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
                                <li><a href="#editId">Edit</a></li>
                            </ul>
                        </div>
                    </div>
                </div> <!-- row -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
