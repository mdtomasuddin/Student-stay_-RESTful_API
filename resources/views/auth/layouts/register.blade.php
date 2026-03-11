@extends('auth.app')

@section('title', 'Register')

@section('content')
    <div class="col-lg-8 col-xxl-4 mx-auto order-first order-xl-last">
        <div class="card shadow-lg border-none m-lg-5">
            <div class="card-body">
                <div class="text-center mt-4">
                    <div class="mb-4 pb-2">
                        <a href="{{ route('index') }}" class="auth-logo d-inline-block">
                            <div class="mx-auto rounded-circle shadow-lg border border-2 border-white overflow-hidden d-flex align-items-center justify-content-center bg-white" 
                                 style="width: 150px; height: 150px; box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;">
                                <img src="{{ $systemSetting->logo ? asset($systemSetting->logo) : asset('backend/images/studentStay.png') }}"
                                    alt="logo" class="auth-logo-dark" style="max-width: 85%; max-height: 85%; object-fit: contain;">
                                <img src="{{ $systemSetting->logo ? asset($systemSetting->logo) : asset('backend/images/studentStay.png') }}"
                                    alt="logo" class="auth-logo-light" style="max-width: 85%; max-height: 85%; object-fit: contain;">
                            </div>
                        </a>
                    </div>
                    <h5 class="fs-3xl">Create New Account</h5>
                </div>

                <div class="p-2 mt-4">
                    <form class="needs-validation" novalidate method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            {{--  Name --}}
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter your  name" value="{{ old('name') }}" required>
                                <div class="invalid-feedback">
                                    Please enter your name
                                </div>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>

                        {{-- Email Address --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter email address" value="{{ old('email') }}" required>
                            <div class="invalid-feedback">
                                Please enter your email
                            </div>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label class="form-label" for="password-input">Password <span
                                    class="text-danger">*</span></label>
                            <div class="position-relative auth-pass-inputgroup">
                                <input type="password" class="form-control password-input pe-5" id="password-input"
                                    name="password" placeholder="Enter password" required>
                                <div class="invalid-feedback">
                                    Please enter a valid password
                                </div>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <label class="form-label" for="password_confirmation">Confirm Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Confirm your password" required>
                            <div class="invalid-feedback">
                                Please confirm your password
                            </div>
                            @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Terms and Conditions --}}
                        <div class="mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                                <label class="form-check-label fs-xs text-muted fst-italic" for="terms">
                                    I agree to the
                                    <a href="#"
                                        class="text-primary text-decoration-underline fst-normal fw-medium">Terms of Use</a>
                                </label>
                            </div>
                        </div>

                        {{-- Sign Up Button --}}
                        <div class="mt-4">
                            <button class="btn btn-primary w-100" type="submit">Sign Up</button>
                        </div>

                        {{-- Social Login --}}
                        <div class="mt-4 text-center">
                            <div class="signin-other-title position-relative">
                                <h5 class="fs-sm mb-4 title text-muted">Create account with</h5>
                            </div>
                            <div>
                                <button type="button" class="btn btn-subtle-primary btn-icon"><i
                                        class="ri-facebook-fill fs-lg"></i></button>
                                <button type="button" class="btn btn-subtle-danger btn-icon"><i
                                        class="ri-google-fill fs-lg"></i></button>
                                <button type="button" class="btn btn-subtle-dark btn-icon"><i
                                        class="ri-github-fill fs-lg"></i></button>
                                <button type="button" class="btn btn-subtle-info btn-icon"><i
                                        class="ri-twitter-fill fs-lg"></i></button>
                            </div>
                        </div>
                    </form>

                    <div class="mt-5 text-center">
                        <p class="mb-0">Already have an account ? <a href="{{ route('login') }}"
                                class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
