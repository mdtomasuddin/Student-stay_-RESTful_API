@extends('backend.app')

@section('title', 'How It Works')

@push('styles')
    <style>
        .how-it-works-card {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            background: #f8f9fa;
        }

        .how-it-works-card .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 46px;
            height: 32px;
            border-radius: 999px;
            background: #0d6efd;
            color: #fff;
            font-weight: 600;
            font-size: 14px;
        }
    </style>
@endpush

@section('content')
    <div class="page-content mb-4">
        <div class="container-fluid">
            <div class="mb-4">
                <h4 class="mb-1">How It Works Section</h4>
                <p class="text-muted mb-0">Manage section title, description, and the 3 process steps shown on the home page.
                </p>
            </div>

            @php
                $defaultCards = [
                    [
                        'title' => 'Search & Select',
                        'description' => 'Browse our premium home and find the perfect room for your needs.',
                    ],
                    [
                        'title' => 'Book & Pay',
                        'description' => 'Complete your booking with our secure payment system.',
                    ],
                    [
                        'title' => 'Your booking is done',
                        'description' => 'Now you can relax, pack your bags, and begin your new journey.',
                    ],
                ];

                $cards = old('extra', $data->cards ?? $defaultCards);
            @endphp

            <div class="row">
                <div class="col-lg-11">
                    <form method="POST" action="{{ route('how-it-works.store') }}">
                        @csrf

                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">How It Works</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                        value="{{ old('title', $data->title ?? '') }}" placeholder="How It Works">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-0">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3">{{ old('description', $data->description ?? '') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            @for ($i = 0; $i < 3; $i++)
                                @php
                                    $card = $cards[$i] ?? $defaultCards[$i];
                                    $step = str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT);
                                @endphp
                                <div class="col-12 col-lg-4">
                                    <div class="how-it-works-card h-100">
                                        <div class="mb-3">
                                            <span class="step-badge">{{ $step }}</span>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text"
                                                class="form-control @error('extra.' . $i . '.title') is-invalid @enderror"
                                                name="extra[{{ $i }}][title]"
                                                value="{{ old('extra.' . $i . '.title', $card['title'] ?? '') }}"
                                                placeholder="Enter step title" required>
                                            @error('extra.' . $i . '.title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control @error('extra.' . $i . '.description') is-invalid @enderror"
                                                name="extra[{{ $i }}][description]" rows="4" placeholder="Enter step description">{{ old('extra.' . $i . '.description', $card['description'] ?? '') }}</textarea>
                                            @error('extra.' . $i . '.description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>

                        @error('extra')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div>
                            <a href="{{ route('how-it-works.index') }}"
                                class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">
                                <i class="ri-close-line"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                                <i class="ri-check-line"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
