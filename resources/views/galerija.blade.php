@extends('layouts.app')

@section('title', __('Galerija'))

@section('content')
    @php
        $meklets     = $meklets ?? '';
        $izveletaSer = $izveletaSer ?? '';
        $kartot      = $kartot ?? '';
    @endphp

    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="hw-heading">{{ $virsraksts ?? __('Galvenā galerija') }}</h1>
            <p class="hw-sub mb-0">{{ $masinas->count() }} {{ __('mašīnas datubāzē') }}</p>
        </div>
        @auth
            <a href="{{ route('masina.pievienot') }}" class="btn btn-hw">{{ __('+ Pievienot mašīnu') }}</a>
        @endauth
    </div>

    <form method="GET" action="{{ route('galerija.meklet') }}" class="hw-toolbar mb-4">
        <div class="row g-2 align-items-end">
            <div class="col-12 col-md-5">
                <label for="q" class="form-label small fw-semibold mb-1">{{ __('Meklēt pēc nosaukuma') }}</label>
                <input type="text" class="form-control" id="q" name="q" value="{{ $meklets }}" placeholder="{{ __('Piem. Twin Mill, Treasure Hunt...') }}">
            </div>
            <div class="col-6 col-md-3">
                <label for="serija" class="form-label small fw-semibold mb-1">{{ __('Sērija') }}</label>
                <select class="form-select" id="serija" name="serija">
                    <option value="">{{ __('Visas sērijas') }}</option>
                    @foreach($serijas as $s)
                        <option value="{{ $s }}" @selected($izveletaSer === $s)>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-2">
                <label for="kartot" class="form-label small fw-semibold mb-1">{{ __('Kārtot') }}</label>
                <select class="form-select" id="kartot" name="kartot">
                    <option value="" @selected($kartot === '')>{{ __('Jaunākie') }}</option>
                    <option value="vecakie" @selected($kartot === 'vecakie')>{{ __('Vecākie') }}</option>
                    <option value="nosaukums" @selected($kartot === 'nosaukums')>{{ __('Nosaukums') }}</option>
                    <option value="gads" @selected($kartot === 'gads')>{{ __('Gads') }}</option>
                    <option value="serija" @selected($kartot === 'serija')>{{ __('Sērija') }}</option>
                    <option value="krasa" @selected($kartot === 'krasa')>{{ __('Krāsa') }}</option>
                </select>
            </div>
            <div class="col-12 col-md-2 d-grid d-md-flex gap-2">
                <button type="submit" class="btn btn-hw flex-fill">{{ __('Meklēt') }}</button>
                <a href="{{ route('galerija') }}" class="btn btn-outline-hw">{{ __('Notīrīt') }}</a>
            </div>
        </div>
    </form>

    @if($masinas->isEmpty())
        <div class="hw-empty">{{ __('Nav atrasta neviena mašīna. Pamēģiniet citu meklēšanas vārdu vai notīriet filtrus.') }}</div>
    @else
        <div class="row g-4">
            @foreach($masinas as $masina)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    @include('partials.masina_kartite', [
                        'masina' => $masina,
                        'showAdminDelete' => auth()->check() && auth()->user()->isAdmin(),
                    ])
                </div>
            @endforeach
        </div>
    @endif
@endsection
