@extends('backend.app')

@section('title', 'Who We Are - Letting Agent')

@push('styles')
    <style>
        .who-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background: #f9f9f9;
            position: relative;
        }

        .who-card .remove-card {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 10;
        }

        .dropify-wrapper {
            height: 120px !important;
        }

        .dropify-wrapper .dropify-message p {
            font-size: 12px;
        }

        .who-card textarea {
            height: 120px;
            resize: none;
        }
    </style>
@endpush

@section('content')
    <div class="page-content mb-4">
        <div class="container-fluid">

            <div class="d-flex justify-content-between mb-5">
                <h4 class="mb-0">Who We Are</h4>
            </div>

            <form method="POST" action="{{ route('letting-agent-who-we-are.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- MAIN TITLE --}}
                <div class="mb-3">
                    <label class="form-label">Who We Are Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title', $data->title ?? '') }}">
                </div>

                {{-- MAIN DESCRIPTION --}}
                <div class="mb-4">
                    <label class="form-label">Who We Are Description</label>
                    <textarea class="form-control" name="description" rows="3">{{ old('description', $data->description ?? '') }}</textarea>
                </div>

                {{-- CARDS --}}
                <div id="cards-container">
                    @php $cards = $data->cards ?? []; @endphp

                    @foreach ($cards as $key => $card)
                        <div class="who-card">

                            <button type="button" class="btn btn-danger btn-sm remove-card">
                                Remove
                            </button>

                            <div class="row g-3 mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="extra[{{ $key }}][title]"
                                        value="{{ $card['title'] ?? '' }}" required>
                                </div>
                            </div>

                            <div class="row g-3 align-items-stretch">
                                <div class="col-md-4">
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control dropify"
                                        name="extra[{{ $key }}][image]"
                                        data-default-file="{{ $card['image'] ?? '' }}">
                                    <input type="hidden" name="extra[{{ $key }}][image_path]"
                                        value="{{ $card['image'] ?? '' }}">
                                </div>

                                <div class="col-md-8">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="extra[{{ $key }}][description]">{{ $card['description'] ?? '' }}</textarea>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

                {{-- ADD CARD --}}
                <div class="text-end mb-4">
                    <button type="button" class="btn btn-primary" id="add-card">
                        <i class="ri-add-line"></i>
                        Add new
                    </button>
                </div>

                {{-- ACTIONS --}}
                <div>

                    <a href="{{ route('letting-agent-who-we-are.index') }}"
                        class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">
                        <i class="ri-close-line"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16"> <i class="ri-check-line"></i>
                        Update</button>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let index = {{ count($cards) }};

        function initDropify() {
            $('.dropify').dropify();
        }

        initDropify();

        document.getElementById('add-card').addEventListener('click', function() {
            const container = document.getElementById('cards-container');
            const key = index++;

            const div = document.createElement('div');
            div.className = 'who-card';

            div.innerHTML = `
            <button type="button" class="btn btn-danger btn-sm remove-card">
                Remove
            </button>

            <div class="row g-3 mb-3">
                <div class="col-md-12">
                    <label class="form-label">itle</label>
                    <input type="text"
                           class="form-control"
                           name="extra[${key}][title]"
                           required>
                </div>
            </div>

            <div class="row g-3 align-items-stretch">
                <div class="col-md-4">
                    <label class="form-label">Image</label>
                    <input type="file"
                           class="form-control dropify"
                           name="extra[${key}][image]">
                    <input type="hidden"
                           name="extra[${key}][image_path]"
                           value="">
                </div>

                <div class="col-md-8">
                    <label class="form-label">Description</label>
                    <textarea class="form-control"
                              name="extra[${key}][description]"></textarea>
                </div>
            </div>
        `;

            container.appendChild(div);
            initDropify();
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-card')) {
                e.target.closest('.who-card').remove();
            }
        });
    </script>
@endpush
