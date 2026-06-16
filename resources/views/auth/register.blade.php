@extends('layouts.app')

@section('title', __('Reģistrēties'))

@section('content')
    <div class="hw-auth">
        <div class="hw-auth__box">
            <div class="hw-card">
                <div class="hw-card__body hw-card__body--pad">
                    <h1 class="hw-heading" style="margin-bottom:1.1rem;">{{ __('Reģistrēties') }}</h1>

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="hw-field">
                            <label for="nickname" class="hw-label">{{ __('Lietotājvārds') }}</label>
                            <input type="text" class="hw-input {{ $errors->has('nickname') ? 'hw-input--err' : '' }}"
                                   id="nickname" name="nickname" value="{{ old('nickname') }}" required autofocus>
                            @error('nickname')<div class="hw-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="hw-field">
                            <label for="email" class="hw-label">{{ __('E-pasts') }}</label>
                            <input type="email" class="hw-input {{ $errors->has('email') ? 'hw-input--err' : '' }}"
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')<div class="hw-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="hw-field">
                            <label for="password" class="hw-label">{{ __('Parole') }}</label>
                            <input type="password" class="hw-input {{ $errors->has('password') ? 'hw-input--err' : '' }}"
                                   id="password" name="password" required>
                            @error('password')<div class="hw-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="hw-field">
                            <label for="password_confirmation" class="hw-label">{{ __('Parole atkārtoti') }}</label>
                            <input type="password" class="hw-input"
                                   id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn-hw btn-hw--full">{{ __('Izveidot kontu') }}</button>
                    </form>

                    <p class="hw-sub hw-sub--sm hw-sub--center" style="margin-top:1rem;">
                        {{ __('Jau ir konts?') }} <a href="{{ route('login') }}">{{ __('Pieslēdzies šeit') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
