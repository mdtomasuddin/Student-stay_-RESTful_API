@extends('backend.app')

@section('title', 'Hero Banner Card')

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
                <h4 class="mb-1 fw-bold">Hero Banner Cards</h4>
                <p class="text-muted mb-0">Manage and customize the key feature highlights for student property listings
                    displayed on the homepage.</p>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="{{ route('hero-banner-card.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3 mb-4">
                            @php
                                $cards = old('cards', $data->cards ?? []);
                            @endphp
                            @for ($i = 0; $i < 4; $i++)
                                @php
                                    $card = $cards[$i] ?? null;
                                @endphp
                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="feature-card h-100">
                                        <div class="image-preview-container" id="preview-container-{{ $i }}">
                                            @if (!empty($card['image']))
                                                <img src="{{ asset($card['image']) }}" alt="Preview"
                                                    id="preview-img-{{ $i }}">
                                            @else
                                                <span class="text-muted" id="preview-text-{{ $i }}">No
                                                    Image</span>
                                                <img src="" alt="Preview" id="preview-img-{{ $i }}"
                                                    style="display: none;">
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Image<label>
                                                    <input type="file"
                                                        class="form-control @error('cards.' . $i . '.image') is-invalid @enderror"
                                                        name="cards[{{ $i }}][image]"
                                                        onchange="previewImage(this, {{ $i }})">
                                                    @error('cards.' . $i . '.image')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text"
                                                class="form-control @error('cards.' . $i . '.title') is-invalid @enderror"
                                                name="cards[{{ $i }}][title]"
                                                value="{{ old('cards.' . $i . '.title', $card['title'] ?? '') }}"
                                                placeholder="Enter title" required>
                                            @error('cards.' . $i . '.title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control @error('cards.' . $i . '.description') is-invalid @enderror"
                                                name="cards[{{ $i }}][description]" rows="3" placeholder="Enter description">{{ old('cards.' . $i . '.description', $card['description'] ?? '') }}</textarea>
                                            @error('cards.' . $i . '.description')
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
            const container = document.getElementById('preview-container-' + index);
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
