@extends('backend.app')

@section('title', 'Add Video')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('video.index') }}">Table</a></li>
                            <li class="breadcrumb-item active">Add Video</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Add Video</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('video.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="course_id" class="form-label">Course <span class="text-danger">*</span></label>
                                    <select class="form-select @error('course_id') is-invalid @enderror" id="course_id" name="course_id" required>
                                        <option value="">Select Course</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                                {{ $course->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="module_id" class="form-label">Module <span class="text-danger">*</span></label>
                                    <select class="form-select @error('module_id') is-invalid @enderror" id="module_id" name="module_id" required>
                                        <option value="">Select Module</option>
                                    </select>
                                    @error('module_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="title" class="form-label">Video Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required placeholder="Enter Video Title">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="link" class="form-label">YouTube Link or Iframe Embed Code <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('link') is-invalid @enderror" id="link" name="link" rows="4" required placeholder="Paste YouTube link or <iframe... embed code here"></textarea>
                                    @error('link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="video-preview" class="mt-3"></div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save Video</button>
                                    <a href="{{ route('video.index') }}" class="btn btn-secondary">Cancel</a>
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

@push('scripts')
<script>
    $(document).ready(function() {
        // Course to Module dependent dropdown
        $('#course_id').on('change', function() {
            var courseId = $(this).val();
            var moduleSelect = $('#module_id');
            moduleSelect.html('<option value="">Select Module</option>');
            
            if (courseId) {
                var url = "{{ route('video.getModules', ':id') }}".replace(':id', courseId);
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(resp) {
                        if (resp.status && resp.data) {
                            resp.data.forEach(function(module) {
                                moduleSelect.append('<option value="' + module.id + '">' + module.title + '</option>');
                            });
                        }
                    }
                });
            }
        });

        function getYoutubeId(url) {
            var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
            var match = url.match(regExp);
            if (match && match[2].length == 11) {
                return match[2];
            } else {
                return null;
            }
        }

        // Handle link/iframe input for preview
        $('#link').on('input', function() {
            const preview = $('#video-preview');
            const val = $(this).val().trim();
            
            if (val.startsWith('<iframe')) {
                // It's an iframe code
                preview.html(val);
                // Ensure the iframe fits or is responsive if needed, but here we just show what they pasted
                preview.find('iframe').css({'max-width': '100%'});
            } else {
                const videoId = getYoutubeId(val);
                if (videoId) {
                    preview.html(`
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/${videoId}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>`);
                } else {
                    preview.html('');
                }
            }
        });
    });
</script>
@endpush
