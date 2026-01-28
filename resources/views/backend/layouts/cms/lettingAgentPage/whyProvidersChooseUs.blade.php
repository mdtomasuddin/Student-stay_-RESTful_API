@extends('backend.app')

@section('title', 'Why Providers Choose Us - Letting Agent Page')

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
                <h4 class="mb-0">Why Providers Choose Us</h4>
            </div>

            <form method="POST" action="{{ route('letting-agent-why-choose-us.store') }}">
                @csrf

                {{-- SECTION TITLE --}}
                <div class="mb-4">
                    <label class="form-label">Why Providers Choose Us Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title', $data->title ?? '') }}" placeholder="Enter Title">
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
                                    <label class="form-label">Card Title</label>
                                    <input type="text" class="form-control" name="extra[{{ $key }}][title]"
                                        value="{{ $card['title'] ?? '' }}" required>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label">Card Description</label>
                                    <textarea class="form-control" name="extra[{{ $key }}][description]">{{ $card['description'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- ADD CARD --}}
                <div class="text-end mb-4">
                    <button type="button" class="btn btn-primary" id="add-card">
                        <i class="ri-add-line"></i> Add new Card
                    </button>
                </div>

                {{-- ACTIONS --}}
                <div>
                    <a href="#" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">
                        <i class="ri-close-line"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16"> 
                        <i class="ri-check-line"></i> Update
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let index = {{ count($cards) }};

        document.getElementById('add-card').addEventListener('click', function() {
            const container = document.getElementById('cards-container');
            const key = index++;

            const div = document.createElement('div');
            div.className = 'who-card';
            div.innerHTML = `
                <button type="button" class="btn btn-danger btn-sm remove-card">Remove</button>
                <div class="row g-3 mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Card Title</label>
                        <input type="text" class="form-control" name="extra[${key}][title]" required>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Card Description</label>
                        <textarea class="form-control" name="extra[${key}][description]"></textarea>
                    </div>
                </div>
            `;
            container.appendChild(div);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-card')) {
                e.target.closest('.who-card').remove();
            }
        });
    </script>
@endpush
