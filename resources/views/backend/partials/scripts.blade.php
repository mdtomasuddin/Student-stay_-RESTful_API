{{-- axios --}}
<script src="{{ asset('backend/custom_downloaded_file/axios.min.js') }}"></script>

{{-- JQUERY JS --}}
<script src="{{ asset('backend/custom_downloaded_file/jquery.min.js') }}"></script>

{{-- JAVASCRIPT --}}
<script src="{{ asset('backend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/js/plugins.js') }}"></script>

<script src="{{ asset('backend/libs/list.js/list.min.js') }}"></script>

{{-- Swiper slider js --}}
<script src="{{ asset('backend/libs/swiper/swiper-bundle.min.js') }}"></script>

{{-- apexcharts --}}
<script src="{{ asset('backend/libs/apexcharts/apexcharts.min.js') }}"></script>

{{-- dashboard doctor init js --}}
<script src="{{ asset('backend/js/pages/dashboard-doctor.init.js') }}"></script>

{{-- password-create init --}}
{{-- <script src="{{ asset('backend/js/pages/passowrd-create.init.js') }}"></script> --}}

{{-- profile-setting init js --}}
<script src="{{ asset('backend/js/pages/profile-setting.init.js') }}"></script>

{{-- prismjs plugin --}}
<script src="{{ asset('backend/libs/prismjs/prism.js') }}"></script>

{{-- dropify js --}}
<script src="{{ asset('backend/js/dropify.min.js') }}"></script>

<script src="{{ asset('backend/libs/list.pagination.js/list.pagination.min.js') }}"></script>

{{-- listjs init --}}
{{-- <script src="{{ asset('backend/js/pages/listjs.init.js') }}"></script> --}}

{{-- Sweet Alerts js --}}
<script src="{{ asset('backend/libs/sweetalert2/sweetalert2.min.js') }}"></script>

{{-- DataTables JS --}}
<script src="{{ asset('backend/custom_downloaded_file/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/custom_downloaded_file/dataTables.bootstrap5.min.js') }}"></script>

{{-- Summernote Editor js --}}
<script src="{{ asset('backend/plugins/summernote-editor/summernote1.js') }}"></script>
<script src="{{ asset('backend/js/summernote.js') }}"></script>

{{-- Summernote start --}}
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            tabsize: 2,
            height: 220,
        });
    });
</script>
{{-- Summernote end --}}

{{-- ckeditor.js --}}
<script src="{{ asset('backend/custom_downloaded_file/ckeditor.js') }}"></script>

{{-- dropify start --}}
<script>
    $(document).ready(function() {
        $('.dropify').dropify();

        $('#logo').on('dropify.afterClear', function(event, element) {
            $('input[name="remove_logo"]').val('1');
        });

        $('#favicon').on('dropify.afterClear', function(event, element) {
            $('input[name="remove_favicon"]').val('1');
        });
    });
</script>
{{-- dropify end --}}

{{-- toaster js --}}
<script src="{{ asset('backend/js/toastr.min.js') }}"></script>

{{-- toastr start --}}
<script>
    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        toastr.options.positionClass = 'toast-top-right';

        @if (Session::has('t-success'))
            toastr.options = {
                'closeButton': true,
                'debug': false,
                'newestOnTop': true,
                'progressBar': true,
                'positionClass': 'toast-top-right',
                'preventDuplicates': false,
                'showDuration': '1000',
                'hideDuration': '1000',
                'timeOut': '5000',
                'extendedTimeOut': '1000',
                'showEasing': 'swing',
                'hideEasing': 'linear',
                'showMethod': 'fadeIn',
                'hideMethod': 'fadeOut',
            };
            toastr.success("{{ session('t-success') }}");
        @endif

        @if (Session::has('t-error'))
            toastr.options = {
                'closeButton': true,
                'debug': false,
                'newestOnTop': true,
                'progressBar': true,
                'positionClass': 'toast-top-right',
                'preventDuplicates': false,
                'showDuration': '1000',
                'hideDuration': '1000',
                'timeOut': '5000',
                'extendedTimeOut': '1000',
                'showEasing': 'swing',
                'hideEasing': 'linear',
                'showMethod': 'fadeIn',
                'hideMethod': 'fadeOut',
            };
            toastr.error("{{ session('t-error') }}");
        @endif

        @if (Session::has('t-info'))
            toastr.options = {
                'closeButton': true,
                'debug': false,
                'newestOnTop': true,
                'progressBar': true,
                'positionClass': 'toast-top-right',
                'preventDuplicates': false,
                'showDuration': '1000',
                'hideDuration': '1000',
                'timeOut': '5000',
                'extendedTimeOut': '1000',
                'showEasing': 'swing',
                'hideEasing': 'linear',
                'showMethod': 'fadeIn',
                'hideMethod': 'fadeOut',
            };
            toastr.info("{{ session('t-info') }}");
        @endif

        @if (Session::has('t-warning'))
            toastr.options = {
                'closeButton': true,
                'debug': false,
                'newestOnTop': true,
                'progressBar': true,
                'positionClass': 'toast-top-right',
                'preventDuplicates': false,
                'showDuration': '1000',
                'hideDuration': '1000',
                'timeOut': '5000',
                'extendedTimeOut': '1000',
                'showEasing': 'swing',
                'hideEasing': 'linear',
                'showMethod': 'fadeIn',
                'hideMethod': 'fadeOut',
            };
            toastr.warning("{{ session('t-warning') }}");
        @endif
    });
</script>
{{-- toastr end --}}

{{-- App js --}}
<script src="{{ asset('backend/js/app.js') }}"></script>



{{-- image preview js --}}
<script>
    class ImageUploader {
        constructor(container) {
            this.container = container;
            this.uploadArea = container.querySelector('.upload-area');
            this.input = container.querySelector('input[type="file"]');
            this.preview = container.querySelector('.preview-img');
            this.placeholder = container.querySelector('.placeholder-content');
            this.removeBtn = container.querySelector('.remove-btn');
            this.fileInfo = container.querySelector('.file-info');

            const form = container.closest('form');
            this.form = form;
            this.errorMsg = form ? form.querySelector('.error-message, .text-danger, .invalid-feedback') : null;

            if (form) {
                this.removeInput = form.querySelector('input[name="remove_image"]');
                if (!this.removeInput) {
                    this.removeInput = document.createElement('input');
                    this.removeInput.type = 'hidden';
                    this.removeInput.name = 'remove_image';
                    this.removeInput.value = '0';
                    form.appendChild(this.removeInput);
                }
            } else {
                this.removeInput = null;
            }

            this.init();
        }

        init() {
            const inputName = this.container.dataset.inputName;
            if (inputName) this.input.name = inputName;

            this.setupInitialState();
            this.bindEvents();
        }

        setupInitialState() {
            const hasPreview = this.preview && this.preview.getAttribute('src');
            if (hasPreview && this.preview.src.trim() !== '') {
                if (this.preview) this.preview.style.display = 'block';
                if (this.placeholder) this.placeholder.style.display = 'none';
                if (this.removeBtn) this.removeBtn.style.display = 'flex';
                if (this.uploadArea) this.uploadArea.classList.add('has-image');
                if (this.removeInput) this.removeInput.value = '0';
                if (this.fileInfo && this.fileInfo.textContent.trim() === '') {
                    this.fileInfo.style.display = 'none';
                }
            } else {
                if (this.preview) this.preview.style.display = 'none';
                if (this.placeholder) this.placeholder.style.display = 'block';
                if (this.removeBtn) this.removeBtn.style.display = 'none';
                if (this.uploadArea) this.uploadArea.classList.remove('has-image');
                if (this.removeInput) this.removeInput.value = '0';
            }
        }

        bindEvents() {
            if (this.uploadArea) {
                this.uploadArea.addEventListener('click', () => this.input.click());
            }

            if (this.removeBtn) {
                this.removeBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    e.preventDefault();
                    this.reset(true);
                });
            }

            if (this.input) {
                this.input.addEventListener('change', () => {
                    if (this.input.files && this.input.files[0]) {
                        this.handleFile(this.input.files[0]);
                    }
                });
            }

            if (this.uploadArea) {
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    this.uploadArea.addEventListener(eventName, (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                    });
                });

                this.uploadArea.addEventListener('dragenter', () => {
                    this.uploadArea.classList.add('drag-over');
                });

                this.uploadArea.addEventListener('dragleave', (e) => {
                    if (e.target === this.uploadArea) {
                        this.uploadArea.classList.remove('drag-over');
                    }
                });

                this.uploadArea.addEventListener('drop', (e) => {
                    this.uploadArea.classList.remove('drag-over');
                    const files = e.dataTransfer && e.dataTransfer.files;
                    if (files && files.length > 0) {
                        const dt = new DataTransfer();
                        dt.items.add(files[0]);
                        this.input.files = dt.files;
                        this.handleFile(files[0]);
                    }
                });
            }
        }

        handleFile(file) {
            if (!file.type.startsWith('image/')) {
                this.showError('Please upload an image file');
                return;
            }

            if (file.size > 5 * 1024 * 1024) {
                this.showError('Image size must be less than 5MB');
                return;
            }

            this.hideError();
            this.showPreview(file);
            if (this.removeInput) this.removeInput.value = '0';
        }

        showPreview(file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                if (this.preview) {
                    this.preview.src = e.target.result;
                    this.preview.style.display = 'block';
                }
                if (this.placeholder) this.placeholder.style.display = 'none';
                if (this.removeBtn) this.removeBtn.style.display = 'flex';
                if (this.uploadArea) this.uploadArea.classList.add('has-image');

                if (this.fileInfo) {
                    const sizeInKB = (file.size / 1024).toFixed(1);
                    this.fileInfo.textContent = `${file.name} (${sizeInKB} KB)`;
                    this.fileInfo.style.display = 'block';
                }
            };
            reader.readAsDataURL(file);
        }

        reset(markRemoved = false) {
            if (this.input) this.input.value = '';
            if (this.preview) {
                this.preview.src = '';
                this.preview.style.display = 'none';
            }
            if (this.placeholder) this.placeholder.style.display = 'block';
            if (this.removeBtn) this.removeBtn.style.display = 'none';
            if (this.uploadArea) this.uploadArea.classList.remove('has-image');

            if (this.fileInfo) {
                this.fileInfo.style.display = 'none';
                this.fileInfo.textContent = '';
            }

            if (this.removeInput) this.removeInput.value = markRemoved ? '1' : '0';

            this.hideError();
        }

        showError(message) {
            if (this.errorMsg) {
                this.errorMsg.textContent = message;
                this.errorMsg.style.display = 'block';
            } else {
                alert(message);
            }
        }

        hideError() {
            if (this.errorMsg) {
                this.errorMsg.style.display = 'none';
                this.errorMsg.textContent = '';
            }
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.image-uploader').forEach(container => {
            new ImageUploader(container);
        });
    });
</script>

@stack('scripts')
