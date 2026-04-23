@extends('backend.app')

@section('title', 'How It Works')

@push('styles')
    <style>
        .feature-card {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .image-preview-container {
            width: 100%;
            height: 150px;
            background: #f8f9fa;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px dashed #dee2e6;
            margin-bottom: 15px;
        }

        .image-preview-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
    </style>
@endpush

@section('content')
    <div class="page-content mb-4">
        <div class="container-fluid">
            <div class="mb-4">
                <h4 class="mb-1 fw-bold">How It Works Section</h4>
                <p class="text-muted mb-0">Manage section title, description, and the 3 process steps shown on the home page.</p>
            </div>

            @php
                $defaultCards = [
                    [
                        'title' => 'Search & Select',
                        'description' => 'Browse our premium home and find the perfect room for your needs.',
                        'image' => null,
                    ],
                    [
                        'title' => 'Book & Pay',
                        'description' => 'Complete your booking with our secure payment system.',
                        'image' => null,
                    ],
                    [
                        'title' => 'Your booking is done',
                        'description' => 'Now you can relax, pack your bags, and begin your new journey.',
                        'image' => null,
                    ],
                ];

                $cards = old('extra', $data->cards ?? $defaultCards);
            @endphp

            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="{{ route('how-it-works.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0 fw-bold">Main Section Content</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Section Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                            value="{{ old('title', $data->title ?? '') }}" placeholder="How It Works">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-0">
                                        <label class="form-label">Section Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="1">{{ old('description', $data->description ?? '') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4 mb-4">
                            @for ($i = 0; $i < 3; $i++)
                                @php
                                    $card = $cards[$i] ?? $defaultCards[$i];
                                @endphp
                                <div class="col-12 col-lg-4">
                                    <div class="feature-card h-100">
                                        <div class="image-preview-container" id="preview-container-{{ $i }}">
                                            @if (!empty($card['image']))
                                                <img src="{{ asset($card['image']) }}" alt="Preview" id="preview-img-{{ $i }}">
                                            @else
                                                <span class="text-muted" id="preview-text-{{ $i }}">No Image</span>
                                                <img src="" alt="Preview" id="preview-img-{{ $i }}" style="display: none;">
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Image</label>
                                            <input type="file"
                                                class="form-control @error('extra.' . $i . '.image') is-invalid @enderror"
                                                name="extra[{{ $i }}][image]"
                                                onchange="previewImage(this, {{ $i }})">
                                            @error('extra.' . $i . '.image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text"
                                                class="form-control @error('extra.' . $i . '.title') is-invalid @enderror"
                                                name="extra[{{ $i }}][title]"
                                                value="{{ old('extra.' . $i . '.title', $card['title'] ?? '') }}"
                                                placeholder="Enter title" required>
                                            @error('extra.' . $i . '.title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control @error('extra.' . $i . '.description') is-invalid @enderror"
                                                name="extra[{{ $i }}][description]" rows="3" placeholder="Enter description">{{ old('extra.' . $i . '.description', $card['description'] ?? '') }}</textarea>
                                            @error('extra.' . $i . '.description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>

                        <div>
                            <a href="{{ route('dashboard') }}" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">
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

@push('scripts')
    <script>
        function previewImage(input, index) {
            const img = document.getElementById('preview-img-' + index);
            const text = document.getElementById('preview-text-' + index);

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    img.style.display = 'block';
                    if (text) text.style.display = 'none';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
