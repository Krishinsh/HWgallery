@extends('layouts.app')

@section('title', __('Pieslēgties'))

@section('content')
    <div class="hw-auth">
        <div class="hw-auth__box">
            <div class="hw-card">
                <div class="hw-card__body hw-card__body--pad">
                    <h1 class="hw-heading" style="margin-bottom:1.1rem;">{{ __('Pieslēgties') }}</h1>

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="hw-field">
                            <label for="login" class="hw-label">{{ __('Lietotājvārds vai e-pasts') }}</label>
                            <input type="text" class="hw-input" id="login" name="login"
                                   value="{{ old('login') }}" required autofocus>
                        </div>
                        <div class="hw-field">
                            <label for="password" class="hw-label">{{ __('Parole') }}</label>
                            <input type="password" class="hw-input" id="password" name="password" required>
                        </div>
                        <div class="hw-check">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">{{ __('Atcerēties mani') }}</label>
                        </div>
                        <button type="submit" class="btn-hw btn-hw--full">{{ __('Pieslēgties') }}</button>
                    </form>

                    <p class="hw-sub hw-sub--sm hw-sub--center" style="margin-top:1rem;">
                        {{ __('Nav konta?') }} <a href="{{ route('register') }}">{{ __('Reģistrējies šeit') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
