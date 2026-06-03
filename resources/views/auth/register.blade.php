@extends('layouts.app')

@section('title', __('Reģistrēties'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">
            <div class="hw-card">
                <div class="hw-card__body p-4">
                    <h1 class="hw-heading mb-3">{{ __('Reģistrēties') }}</h1>

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nickname" class="form-label fw-semibold">{{ __('Lietotājvārds') }}</label>
                            <input type="text" class="form-control @error('nickname') is-invalid @enderror"
                                   id="nickname" name="nickname" value="{{ old('nickname') }}" required autofocus>
                            @error('nickname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">{{ __('E-pasts') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">{{ __('Parole') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" required>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">{{ __('Parole atkārtoti') }}</label>
                            <input type="password" class="form-control"
                                   id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-hw w-100">{{ __('Izveidot kontu') }}</button>
                    </form>

                    <p class="hw-sub small text-center mt-3 mb-0">
                        {{ __('Jau ir konts?') }} <a href="{{ route('login') }}">{{ __('Pieslēdzies šeit') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
