@extends('layouts.app')

@section('title', __('Pieslēgties'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">
            <div class="hw-card">
                <div class="hw-card__body p-4">
                    <h1 class="hw-heading mb-3">{{ __('Pieslēgties') }}</h1>

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="login" class="form-label fw-semibold">{{ __('Lietotājvārds vai e-pasts') }}</label>
                            <input type="text" class="form-control" id="login" name="login"
                                   value="{{ old('login') }}" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">{{ __('Parole') }}</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label" for="remember">{{ __('Atcerēties mani') }}</label>
                        </div>
                        <button type="submit" class="btn btn-hw w-100">{{ __('Pieslēgties') }}</button>
                    </form>

                    <p class="hw-sub small text-center mt-3 mb-0">
                        {{ __('Nav konta?') }} <a href="{{ route('register') }}">{{ __('Reģistrējies šeit') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
