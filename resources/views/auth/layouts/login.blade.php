@extends('auth.app')

@section('title', 'Login')

@section('content')
    <div class="col-lg-8 col-xxl-4 mx-auto order-first order-xl-last">
        <div class="card shadow-lg border-none m-lg-5">
            <div class="card-body">
                <div class="text-center mt-4">
                    <div class="mb-3 pb-2">
                        <a class="auth-logo d-inline-block">
                            <div class="mx-auto rounded-circle shadow-lg border border-2 border-white overflow-hidden d-flex align-items-center justify-content-center bg-white"
                                style="width: 150px; height: 150px; box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;">
                                <img src="{{ $systemSetting->logo ? asset($systemSetting->logo) : asset('backend/images/studentStay.png') }}"
                                    alt="logo" class="auth-logo-dark"
                                    style="max-width: 85%; max-height: 85%; object-fit: contain;">
                                <img src="{{ $systemSetting->logo ? asset($systemSetting->logo) : asset('backend/images/studentStay.png') }}"
                                    alt="logo" class="auth-logo-light"
                                    style="max-width: 85%; max-height: 85%; object-fit: contain;">
                            </div>
                        </a>
                    </div>
                    <h5 class="fs-3xl">Welcome Back</h5>
                    <p class="text-muted">Sign in to continue .</p>
                </div>

                <div class="p-2 mt-4">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <div class="position-relative ">
                                <input type="text" class="form-control  password-input" id="email" name="email"
                                    placeholder="Enter email" value="{{ old('email') }}" required>
                            </div>

                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            {{-- <div class="float-end">
                                <a href="{{ route('password.request') }}" class="text-muted">Forgot password?</a>
                            </div> --}}

                            <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                            <div class="position-relative auth-pass-inputgroup mb-3">
                                <input type="password" class="form-control pe-5 password-input "
                                    placeholder="Enter password" id="password" name="password" required>
                                {{-- show password button  --}}
                                <button type="button" id="togglePassword" class="btn btn-sm btn-link position-absolute"
                                    style="right:10px; top:50%; transform:translateY(-50%);" aria-label="Show password"
                                    aria-pressed="false">
                                    <svg id="eye" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                    <svg id="eyeSlash" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        style="display:none;">
                                        <path
                                            d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-7 0-11-7-11-7 1.7-3.1 4.2-5.4 7.1-6.6" />
                                        <path d="M1 1l22 22" />
                                    </svg>
                                </button>

                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary w-100" type="submit">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End --}}
    <script>
        // Password visibility toggle
        document.addEventListener('DOMContentLoaded', function() {
            var pwd = document.getElementById('password');
            var btn = document.getElementById('togglePassword');
            if (!pwd || !btn) return;
            var eye = document.getElementById('eye');
            var eyeSlash = document.getElementById('eyeSlash');
            //add event listener to toggle password visibility
            btn.addEventListener('click', function() {
                var isPassword = pwd.getAttribute('type') === 'password';
                pwd.setAttribute('type', isPassword ? 'text' : 'password');
                btn.setAttribute('aria-pressed', String(isPassword));
                btn.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
                if (eye && eyeSlash) {
                    eye.style.display = isPassword ? 'none' : 'inline';
                    eyeSlash.style.display = isPassword ? 'inline' : 'none';
                }
            });
        });
    </script>

@endsection
