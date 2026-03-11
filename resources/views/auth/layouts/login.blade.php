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
                    <p class="text-muted">Sign in to continue to StudentStay.</p>
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
@endsection
