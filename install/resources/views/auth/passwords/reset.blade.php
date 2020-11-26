@extends('layouts.app')

@section('content')
<div class="container mt-6">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form
                        method="POST"
                        action="{{ route('password.request') }}"
                        aria-label="{{ __('Reset Password') }}">

                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control-lg form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="email"
                                    value="{{ $email ?? old('email') }}"
                                    required
                                    placeholder="{{ __('E-Mail Address') }}"
                                    autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control-lg form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password"
                                    placeholder="{{ __('Password') }}"
                                    required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <input
                                    id="password-confirm"
                                    type="password"
                                    class="form-control-lg form-control"
                                    name="password_confirmation"
                                    placeholder="{{ __('Confirm Password') }}" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
