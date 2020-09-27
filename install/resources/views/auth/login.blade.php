@extends('layouts.app')

@section('content')
<div class="container mt-6">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST"
                        action="{{ route('login.store') }}"
                        aria-label="{{ __('Login') }}"
                        novalidate>

                        @csrf

                        <div class="form-group row">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <input
                                    id="login"
                                    type="text"
                                    class="form-control-lg form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="login"
                                    value="{{ old('login') }}"
                                    required
                                    placeholder="{{ __('Username or E-Mail') }}"
                                    autocomplete="existing-email"
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
                                    autocomplete="existing-password"
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
                                <div class="custom-control custom-checkbox">
                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        id="remember"
                                        name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label
                                        class="custom-control-label"
                                        for="remember">{{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12 col-lg-8 offset-lg-3">
                                <a
                                    href="{{ route('page.show') }}"
                                    class="btn btn-lg btn-secondary">
                                        {{ __('Cancel') }}
                                </a>
                                <button type="submit" class="btn btn-lg btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
