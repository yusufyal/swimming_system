@extends('layout.master2')

@section('title', 'Register')

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
                            <a href="#" class="noble-ui-logo d-block mb-2 d-flex justify-content-center text-dark">Qadsia Swimming Academy</a>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label"><strong>Name</strong></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" autocomplete="name" placeholder="Name" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label"><strong>Email</strong></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label"><strong>Password</strong></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" autocomplete="new-password" placeholder="Password">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label"><strong>Confirm Password</strong></label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" autocomplete="new-password" placeholder="Confirm Password">
                                </div>

                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="authCheck">
                                    <label class="form-check-label" for="authCheck">
                                        <strong> Remember me</strong>
                                    </label>
                                </div>

                                <div>
                                    <button type="submit" class="btn me-2 mb-2 text-white mb-md-0 bg-dark">Sign up</button>
                                </div>

                                <a href="{{ url('/login') }}" class="d-block mt-3 text-dark"><strong>Already a user? Sign in</strong></a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection