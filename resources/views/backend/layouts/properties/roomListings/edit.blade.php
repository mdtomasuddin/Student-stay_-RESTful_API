@extends('backend.app')

@section('title', 'Room Listing Update')

@push('styles')
    <style>
        .faq-field {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }

        .form-control {
            border-radius: 8px;
        }
    </style>
@endpush

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- page title --}}
            <div class="row">
                <div class="col-lg-10">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('room-listings.index') }}">Room Listings</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('room-listings.update', $roomListing->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="row gy-4">
                                    <div class="col-lg-12 faq-field">

                                        <div class="form-group mb-3">
                                            <label for="property_title" class="form-label">Property Title:</label>
                                            <input type="text" id="property_title" class="form-control" 
                                                value="{{ $roomListing->property->title ?? 'N/A' }}" disabled />
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="redirect_url" class="form-label">Redirect URL:</label>
                                            <input type="url" placeholder="https://example.com" id="redirect_url"
                                                class="form-control @error('redirect_url') is-invalid @enderror" name="redirect_url"
                                                value="{{ old('redirect_url', $roomListing->redirect_url) }}" />
                                            @error('redirect_url')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('room-listings.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
