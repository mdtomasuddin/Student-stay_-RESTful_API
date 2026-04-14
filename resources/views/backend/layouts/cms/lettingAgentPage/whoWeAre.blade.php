@extends('backend.app')

@section('title', 'Who We Are - Letting Agent')

@section('content')
    <div class="page-content mb-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">

                    <div class="mb-4">
                        <h4 class="mb-1">Who We Are</h4>
                        <p class="text-muted mb-0">Manage the section title, description, and cards for this section.</p>
                    </div>

                    <form method="POST" action="{{ route('letting-agent-who-we-are.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0">Who We Are</h5>
                            </div>
                            <div class="card-body p-3 p-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Title</label>
                                    <input type="text" class="form-control" name="title"
                                        value="{{ old('title', $data->title ?? '') }}">
                                </div>

                                <div class="mb-0">
                                    <label class="form-label fw-semibold">Description</label>
                                    <textarea class="form-control" name="description" rows="3">{{ old('description', $data->description ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body p-3 p-md-4">
                                <h5 class="mb-3">Topics :</h5>
                                <div id="cards-container">
                                    @php $cards = $data->cards ?? []; @endphp

                                    @foreach ($cards as $key => $card)
                                        <div class="who-card card border bg-light-subtle mb-3 position-relative">
                                            <div class="card-body p-3 p-md-4">
                                                <div class="row g-3 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label fw-semibold">Title</label>
                                                        <input type="text" class="form-control"
                                                            name="extra[{{ $key }}][title]"
                                                            value="{{ $card['title'] ?? '' }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label fw-semibold">Description</label>
                                                    <textarea class="form-control" name="extra[{{ $key }}][description]" rows="5">{{ $card['description'] ?? '' }}</textarea>
                                                </div>

                                                <div class="row g-3 align-items-stretch">
                                                    <div class="col-md-12">
                                                        <label class="form-label fw-semibold">Image</label>
                                                        <input type="file" class="form-control dropify"
                                                            name="extra[{{ $key }}][image]"
                                                            data-default-file="{{ $card['image'] ?? '' }}">
                                                        <input type="hidden" name="extra[{{ $key }}][image_path]"
                                                            value="{{ $card['image'] ?? '' }}">
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('letting-agent-who-we-are.index') }}"
                                class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">
                                <i class="ri-close-line"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16"> <i
                                    class="ri-check-line"></i>
                                Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function initDropify() {
            $('.dropify').dropify();
        }

        initDropify();
    </script>
@endpush
