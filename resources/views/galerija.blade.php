@extends('layouts.app')

@section('title', __('Galerija'))

@section('content')
    @php
        $meklets     = $meklets ?? '';
        $izveletaSer = $izveletaSer ?? '';
        $kartot      = $kartot ?? '';
    @endphp

    <div class="hw-page-header">
        <div>
            <h1 class="hw-heading">{{ $virsraksts ?? __('Galvenā galerija') }}</h1>
            <p class="hw-sub">{{ $masinas->count() }} {{ __('mašīnas datubāzē') }}</p>
        </div>
        @auth
            <a href="{{ route('masina.pievienot') }}" class="btn-hw">{{ __('+ Pievienot mašīnu') }}</a>
        @endauth
    </div>

    <form method="GET" action="{{ route('galerija.meklet') }}" class="hw-toolbar">
        <div class="hw-toolbar__row hw-toolbar__row--gal">
            <div>
                <label for="q" class="hw-label hw-label--sm">{{ __('Meklēt pēc nosaukuma') }}</label>
                <input type="text" class="hw-input" id="q" name="q"
                       value="{{ $meklets }}" placeholder="{{ __('Piem. Twin Mill, Treasure Hunt...') }}">
            </div>
            <div>
                <label for="serija" class="hw-label hw-label--sm">{{ __('Sērija') }}</label>
                <select class="hw-select" id="serija" name="serija">
                    <option value="">{{ __('Visas sērijas') }}</option>
                    @foreach($serijas as $s)
                        <option value="{{ $s }}" @selected($izveletaSer === $s)>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="kartot" class="hw-label hw-label--sm">{{ __('Kārtot') }}</label>
                <select class="hw-select" id="kartot" name="kartot">
                    <option value=""       @selected($kartot === '')>{{ __('Jaunākie') }}</option>
                    <option value="vecakie"   @selected($kartot === 'vecakie')>{{ __('Vecākie') }}</option>
                    <option value="nosaukums" @selected($kartot === 'nosaukums')>{{ __('Nosaukums') }}</option>
                    <option value="gads"      @selected($kartot === 'gads')>{{ __('Gads') }}</option>
                    <option value="serija"    @selected($kartot === 'serija')>{{ __('Sērija') }}</option>
                    <option value="krasa"     @selected($kartot === 'krasa')>{{ __('Krāsa') }}</option>
                </select>
            </div>
            <div class="hw-toolbar__btns">
                <button type="submit" class="btn-hw">{{ __('Meklēt') }}</button>
                <a href="{{ route('galerija') }}" class="btn-out">{{ __('Notīrīt') }}</a>
            </div>
        </div>
    </form>

    @if($masinas->isEmpty())
        <div class="hw-empty">{{ __('Nav atrasta neviena mašīna. Pamēģiniet citu meklēšanas vārdu vai notīriet filtrus.') }}</div>
    @else
        <div class="hw-grid">
            @foreach($masinas as $masina)
                @include('partials.masina_kartite', [
                    'masina' => $masina,
                    'showAdminDelete' => auth()->check() && auth()->user()->isAdmin(),
                ])
            @endforeach
        </div>
    @endif
@endsection
