@extends('backend.app')

@section('title', 'SEO Meta Settings')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">SEO Meta Settings</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">SEO Meta Settings</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end page title --}}

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Manage SEO Meta Tags for All Pages</h5>
                        </div>
                        <div class="card-body">
                            {{-- Tabs Navigation --}}
                            <ul class="nav nav-tabs" id="seoMetaTabs" role="tablist">
                                @foreach($pages as $index => $page)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                            id="{{ $page }}-tab" data-bs-toggle="tab"
                                            data-bs-target="#{{ $page }}-content" type="button" role="tab"
                                            aria-controls="{{ $page }}-content"
                                            aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                            {{ ucfirst(str_replace('_', ' ', $page)) }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>

                            {{-- Tabs Content --}}
                            <div class="tab-content" id="seoMetaTabsContent">
                                @foreach($pages as $index => $page)
                                    @php
                                        $seoMeta = $seoMetas->get($page);
                                    @endphp
                                    <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                                        id="{{ $page }}-content" role="tabpanel" aria-labelledby="{{ $page }}-tab">

                                        <form method="POST" action="{{ route('seo.meta.update') }}"
                                            class="mt-4">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="page" value="{{ $page }}">

                                            <div class="row gy-4">
                                                {{-- Page Title --}}
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="title_{{ $page }}"
                                                            class="form-label">Meta Title</label>
                                                        <input type="text"
                                                            class="form-control @error('title') is-invalid @enderror"
                                                            name="title" id="title_{{ $page }}"
                                                            placeholder="Enter meta title "
                                                            value="{{ $seoMeta?->title ?? old('title') }}"
                                                            maxlength="255">
                                                        <small class="text-muted">Recommended: 50-60 characters</small>
                                                        @error('title')
                                                            <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                {{-- Meta Description --}}
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="description_{{ $page }}"
                                                            class="form-label">Meta Description</label>
                                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                                            name="description" id="description_{{ $page }}"
                                                            placeholder="Enter meta description"
                                                            rows="3" maxlength="500">{{ $seoMeta?->description ?? old('description') }}</textarea>
                                                        <small class="text-muted">Recommended: 150-160 characters</small>
                                                        @error('description')
                                                            <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                {{-- Keywords --}}
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="keywords_{{ $page }}"
                                                            class="form-label">Keywords</label>
                                                        <textarea class="form-control @error('keywords') is-invalid @enderror"
                                                            name="keywords" id="keywords_{{ $page }}"
                                                            placeholder="Enter keywords separated by comma (e.g. student accommodation, affordable housing, rental rooms)"
                                                            rows="3">{{ $seoMeta?->keywords ? implode(',', $seoMeta->keywords) : old('keywords') }}</textarea>
                                                        <small class="text-muted">Separate multiple keywords with commas</small>
                                                        @error('keywords')
                                                            <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                {{-- Submit Button --}}
                                                <div class="col-12 mt-3">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="ri-save-line"></i> Save Changes
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endforeach
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
        // Optional: Add character counter for meta title and description
        document.querySelectorAll('textarea[name="description"], input[name="title"]').forEach(field => {
            field.addEventListener('input', function() {
                let maxLength = this.getAttribute('maxlength');
                let currentLength = this.value.length;
                console.log(`${currentLength}/${maxLength}`);
            });
        });
    </script>
@endpush
