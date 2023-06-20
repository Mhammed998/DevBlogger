@extends('layouts.site.app')
@section('frontend-title','Register')
@section('frontend-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

                    <form class="auth-form" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="col-form-label text-md-end">{{ __('Name') }}</label>

                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class=" col-form-label text-md-end">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class=" mb-0">
                            <div class="">
                                <button type="submit" class=" form-btn btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <a class="btn btn-link" href="{{ route('login') }}">
                                    Already have an account !
                                </a>
                            </div>
                        </div>
                    </form>
        </div>
    </div>
</div>
@endsection
