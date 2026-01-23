@extends('backend.app')

@section('title')
    {{ env('APP_NAME') }} || Create Blog
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
                                    <h2 class="h3 mb-1">Create Blog</h2>
                                    <p>Create the blog details below and submit.</p>
                                </div>

                                <div class="card mb-10">
                                    <div class="tab-content p-4">
                                        <form action="{{ route('blogs.store') }}" method="POST"
                                            enctype="multipart/form-data">

                                            @csrf

                                            {{-- Title --}}
                                            <div class="form-group mb-4">
                                                <label class="label text-secondary">Title</label>
                                                <input type="text"
                                                    class="form-control text-dark ps-3 h-55 @error('title') is-invalid @enderror"
                                                    name="title" value="{{ old('title') }}"
                                                    placeholder="Enter blog title here" required>
                                                @error('title')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Category --}}
                                            <div class="form-group mb-4">
                                                <label class="label text-secondary">Category</label>
                                                <select name="category_id"
                                                    class="form-control text-dark ps-3 h-55 @error('category_id') is-invalid @enderror">
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Thumbnail --}}
                                            <div class="form-group mb-4">
                                                <label class="label text-secondary">Thumbnail</label>
                                                <input type="file" name="thumbnail"
                                                    class="dropify form-control @error('thumbnail') is-invalid @enderror"
                                                    accept="image/*">
                                                @error('thumbnail')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Content --}}
                                            <div class="form-group mb-4">
                                                <label class="label text-secondary">Content</label>
                                                <textarea class="form-control text-dark ps-3 @error('content') is-invalid @enderror" name="content" id="editor"
                                                    placeholder="Enter blog content here" rows="8" required>{{ old('content') }}</textarea>
                                                @error('content')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Featured --}}
                                            <div class="form-group mb-4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="is_featured"
                                                        id="isFeatured" value="1"
                                                        {{ old('is_featured') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="isFeatured">
                                                        Mark as Featured
                                                    </label>
                                                </div>
                                            </div>

                                            {{-- Buttons --}}
                                            <div class="d-flex flex-wrap gap-3 mt-4">
                                                <a href="{{ route('blogs.index') }}"
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

                            <nav class="nav flex-column p-3 bg-light">
                                <a class="nav-link" href="#edit">Create Blog</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'blockQuote',
                        'insertTable',
                        '|',
                        'undo',
                        'redo'
                    ]
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
