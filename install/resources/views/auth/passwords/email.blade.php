@extends('layouts.app')

@section('content')
<div class="container mt-6">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form
                        method="POST"
                        action="{{ route('password.email') }}"
                        aria-label="{{ __('Reset Password') }}">

                        @csrf

                        <div class="form-group row">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control-lg form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    placeholder="{{ __('E-Mail Address') }}"
                                    autocomplete="existing-email"
                                    autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <a
                                    href="{{ route('login.show') }}"
                                    class="btn btn-lg btn-secondary">
                                        {{ __('Cancel') }}
                                </a>
                                <button type="submit" class="btn btn-lg btn-primary">
                                    {{ __('Send Reset Link') }}
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
