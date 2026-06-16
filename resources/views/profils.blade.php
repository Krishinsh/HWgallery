@extends('layouts.app')

@section('title', __('Mans profils'))

@section('content')
    <div class="hw-page-header">
        <div>
            <h1 class="hw-heading">{{ __('Mans profils') }}</h1>
            <p class="hw-sub">{{ __('Pārvaldi savus konta datus') }}</p>
        </div>
    </div>

    <div class="hw-grid--75">
        {{-- Konta dati --}}
        <div class="hw-card">
            <div class="hw-card__body hw-card__body--pad">
                <p class="hw-section-title">{{ __('Konta dati') }}</p>

                <div class="hw-stats">
                    <div>
                        <div class="hw-stat__label">{{ __('Loma') }}</div>
                        <div class="hw-stat__value">
                            {{ $lietotajs->isAdmin() ? __('Administrators') : __('Reģistrēts lietotājs') }}
                        </div>
                    </div>
                    <div>
                        <div class="hw-stat__label">{{ __('Mašīnas kolekcijā') }}</div>
                        <div class="hw-stat__value">{{ $lietotajs->cars_count }}</div>
                    </div>
                    <div>
                        <div class="hw-stat__label">{{ __('Reģistrējās') }}</div>
                        <div class="hw-stat__value">{{ $lietotajs->created_at->format('Y-m-d') }}</div>
                    </div>
                </div>

                <form action="{{ route('profils.update') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="hw-field">
                        <label for="nickname" class="hw-label">{{ __('Lietotājvārds') }}</label>
                        <input type="text" class="hw-input {{ $errors->has('nickname') ? 'hw-input--err' : '' }}"
                               id="nickname" name="nickname" value="{{ old('nickname', $lietotajs->nickname) }}" required>
                        @error('nickname')<div class="hw-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="hw-field">
                        <label for="email" class="hw-label">{{ __('E-pasts') }}</label>
                        <input type="email" class="hw-input {{ $errors->has('email') ? 'hw-input--err' : '' }}"
                               id="email" name="email" value="{{ old('email', $lietotajs->email) }}" required>
                        @error('email')<div class="hw-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="hw-field">
                        <label for="password" class="hw-label">{{ __('Jauna parole (neobligāti)') }}</label>
                        <input type="password" class="hw-input {{ $errors->has('password') ? 'hw-input--err' : '' }}"
                               id="password" name="password" placeholder="{{ __('Atstāj tukšu, lai nemainītu') }}">
                        @error('password')<div class="hw-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="hw-field">
                        <label for="password_confirmation" class="hw-label">{{ __('Jaunā parole atkārtoti') }}</label>
                        <input type="password" class="hw-input"
                               id="password_confirmation" name="password_confirmation">
                    </div>
                    <button type="submit" class="btn-hw">{{ __('Saglabāt izmaiņas') }}</button>
                </form>
            </div>
        </div>

        {{-- Konta dzēšana --}}
        <div class="hw-card hw-card--danger">
            <div class="hw-card__body hw-card__body--pad">
                <p class="hw-section-title">{{ __('Konta dzēšana') }}</p>
                <p class="hw-sub" style="margin-bottom:1.1rem;">
                    {{ __('Dzēšot kontu, neatgriezeniski tiek izdzēsta visa tava kolekcija un bildes. Šo darbību nevar atsaukt.') }}
                </p>
                <form action="{{ route('profils.dzest') }}" method="POST"
                      onsubmit="return confirm('{{ __('Tiešām dzēst savu kontu un visu kolekciju? Šo nevar atsaukt.') }}');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-hw">{{ __('Dzēst manu kontu') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
