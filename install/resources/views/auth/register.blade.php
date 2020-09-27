@extends('layouts.app')

@section('content')
<div class="container mt-6">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST"
                        action="{{ route('register.store') }}"
                        aria-label="{{ __('Register') }}"
                        novalidate>

                        @csrf

                        <div class="form-group row">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <input id="username"
                                    type="text"
                                    class="form-control-lg form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                    name="username"
                                    value="{{ old('username') }}"
                                    required
                                    placeholder="{{ __('Username') }}"
                                    autocomplete="new-username"
                                    autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <input id="name"
                                    type="text"
                                    class="form-control-lg form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                    placeholder="{{ __('Name') }}"
                                    autocomplete="new-name"
                                    autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control-lg form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="{{ __('E-Mail Address') }}"
                                    autocomplete="new-email"
                                    required>

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
                                    autocomplete="new-password"
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
                                    placeholder="{{ __('Confirm Password') }}"
                                    autocomplete="confirm-password"
                                    required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <a
                                    href="{{ route('page.show') }}"
                                    class="btn btn-lg btn-secondary">
                                        {{ __('Cancel') }}
                                </a>
                                <button type="submit" class="btn btn-lg btn-primary">
                                    {{ __('Register') }}
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
