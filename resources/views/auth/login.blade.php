@extends('layout.master2')

@section('title', 'Login')

@push('plugin-styles')
<!-- Add any additional styles specific to login page -->
<link href="{{ asset('assets/css/auth.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">
    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card">
                <div class="row">
                    <div class="col-md-4 pe-md-0 d-none d-md-block">
                        <div class="auth-side-wrapper d-flex align-items-center justify-content-center">
                            <img src="{{ asset('assets/images/others/qadsia.png') }}" style="height:120px;width:100px;" alt="">
                        </div>
                    </div>

                    <div class="col-md-8 ps-md-0" style="background-color:#FFC107">
                        <div class="auth-form-wrapper px-4 py-5">
                            <a href="{{ route('login') }}" class="noble-ui-logo d-block mb-2 text-dark">Qadsia Swimming Academy</a>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label"><strong>Email</strong></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ old('email') }}"
                                        required autocomplete="email" autofocus placeholder="Email">

                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label"><strong>Password</strong></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" id="password" required
                                        autocomplete="current-password" placeholder="Password">

                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" name="remember"
                                        id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        <strong>Remember me</strong>
                                    </label>
                                </div>

                                <div>
                                    <button type="submit" class="btn me-2 mb-2 mb-md-0 bg-dark text-white">
                                        Login
                                    </button>

                                    @if (Route::has('password.request'))
                                    <a class="btn" href="{{ route('password.request') }}">
                                        <strong>{{ __('Forgot Your Password?') }}</strong>
                                    </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-scripts')
<!-- Add any additional scripts specific to login page -->
<script src="{{ asset('assets/js/auth.js') }}"></script>
@endpush