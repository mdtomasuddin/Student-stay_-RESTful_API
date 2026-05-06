@extends('backend.app')

@section('title', 'Letting Agents - SEO Meta Settings')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Letting Agents SEO Meta Settings</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">SEO Meta</a></li>
                                <li class="breadcrumb-item active">Letting Agents</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end page title --}}

            <div class="row">
                <div class="col-lg-11">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('seo.meta.update') }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="page" value="letting_agents">

                                <div class="row gy-4">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Meta Title:</label>
                                            <input type="text"
                                                class="form-control @error('title') is-invalid @enderror"
                                                name="title" id="title" placeholder="Enter meta title"
                                                value="{{ $seoMeta?->title ?? old('title') }}" maxlength="255">
                                            <small class="text-muted d-block mt-1">Recommended: 50-60 characters</small>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Meta Description:</label>
                                            <textarea
                                                class="form-control @error('description') is-invalid @enderror"
                                                name="description" id="description" placeholder="Enter meta description"
                                                rows="4" maxlength="500">{{ $seoMeta?->description ?? old('description') }}</textarea>
                                            <small class="text-muted d-block mt-1">Recommended: 150-160 characters</small>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="keywords" class="form-label">Keywords:</label>
                                            <textarea class="form-control @error('keywords') is-invalid @enderror"
                                                name="keywords" id="keywords"
                                                placeholder="Enter keywords separated by comma (e.g. letting agents, property management, real estate)"
                                                rows="4">{{ $seoMeta?->keywords ? implode(',', $seoMeta->keywords) : old('keywords') }}</textarea>
                                            <small class="text-muted d-block mt-1">Separate multiple keywords with commas</small>
                                            @error('keywords')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ri-save-line"></i> Save Changes
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
