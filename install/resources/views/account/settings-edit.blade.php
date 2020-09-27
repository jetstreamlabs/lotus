@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">{{ __('Edit Settings') }}</div>

                <div class="card-body">
                    <form method="POST"
                        action="{{ route('settings.update') }}"
                        aria-label="{{ __('Edit Settings') }}"
                        novalidate>

                        @csrf

                        <div class="form-group row">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <input id="name"
                                    type="text"
                                    class="form-control-lg form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    name="name"
                                    value="{{ $user->name ?? old('name') }}"
                                    required
                                    placeholder="{{ __('Name') }}"
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
                                    value="{{ $user->email ?? old('email') }}"
                                    placeholder="{{ __('E-Mail Address') }}"
                                    required>

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
                                    href="{{ route('dashboard') }}"
                                    class="btn btn-lg btn-secondary">
                                        {{ __('Cancel') }}
                                </a>
                                <button type="submit" class="btn btn-lg btn-primary">
                                    {{ __('Submit') }}
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
