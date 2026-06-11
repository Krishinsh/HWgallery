@extends('layouts.app')

@section('title', __('Mans profils'))

@section('content')
    <div class="mb-3">
        <h1 class="hw-heading">{{ __('Mans profils') }}</h1>
        <p class="hw-sub mb-0">{{ __('Pārvaldi savus konta datus') }}</p>
    </div>

    <div class="row g-4">
        {{-- Konta informācija un rediģēšana --}}
        <div class="col-12 col-lg-7">
            <div class="hw-card">
                <div class="hw-card__body p-4">
                    <h2 class="h5 fw-bold mb-3">{{ __('Konta dati') }}</h2>

                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <div>
                            <div class="hw-sub small">{{ __('Loma') }}</div>
                            <div class="fw-semibold">
                                {{ $lietotajs->isAdmin() ? __('Administrators') : __('Reģistrēts lietotājs') }}
                            </div>
                        </div>
                        <div>
                            <div class="hw-sub small">{{ __('Mašīnas kolekcijā') }}</div>
                            <div class="fw-semibold">{{ $lietotajs->cars_count }}</div>
                        </div>
                        <div>
                            <div class="hw-sub small">{{ __('Reģistrējās') }}</div>
                            <div class="fw-semibold">{{ $lietotajs->created_at->format('Y-m-d') }}</div>
                        </div>
                    </div>

                    <form action="{{ route('profils.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nickname" class="form-label fw-semibold">{{ __('Lietotājvārds') }}</label>
                            <input type="text" class="form-control @error('nickname') is-invalid @enderror"
                                   id="nickname" name="nickname" value="{{ old('nickname', $lietotajs->nickname) }}" required>
                            @error('nickname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">{{ __('E-pasts') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email', $lietotajs->email) }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">{{ __('Jauna parole (neobligāti)') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" placeholder="{{ __('Atstāj tukšu, lai nemainītu') }}">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">{{ __('Jaunā parole atkārtoti') }}</label>
                            <input type="password" class="form-control"
                                   id="password_confirmation" name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-hw">{{ __('Saglabāt izmaiņas') }}</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Bīstamā zona: konta dzēšana --}}
        <div class="col-12 col-lg-5">
            <div class="hw-card" style="border-color: rgba(225,27,34,.4);">
                <div class="hw-card__body p-4">
                    <h2 class="h5 fw-bold mb-2">{{ __('Konta dzēšana') }}</h2>
                    <p class="hw-sub">
                        {{ __('Dzēšot kontu, neatgriezeniski tiek izdzēsta visa tava kolekcija un bildes. Šo darbību nevar atsaukt.') }}
                    </p>
                    <form action="{{ route('profils.dzest') }}" method="POST"
                          onsubmit="return confirm('{{ __('Tiešām dzēst savu kontu un visu kolekciju? Šo nevar atsaukt.') }}');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-hw">{{ __('Dzēst manu kontu') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
