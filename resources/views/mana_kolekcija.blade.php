@extends('layouts.app')

@section('title', __('Mana kolekcija'))

@section('content')
    @php $meklets = $meklets ?? ''; @endphp

    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="hw-heading">{{ __('Mana kolekcija') }}</h1>
            <p class="hw-sub mb-0">{{ $masinas->count() }} {{ __('mašīnas kolekcijā') }}</p>
        </div>
        <a href="{{ route('masina.pievienot') }}" class="btn btn-hw">{{ __('+ Pievienot mašīnu') }}</a>
    </div>

    <form method="GET" action="{{ route('mana.kolekcija.meklet') }}" class="hw-toolbar mb-4">
        <div class="row g-2 align-items-end">
            <div class="col-12 col-md-9">
                <label for="q" class="form-label small fw-semibold mb-1">{{ __('Meklēt savā kolekcijā') }}</label>
                <input type="text" class="form-control" id="q" name="q" value="{{ $meklets }}" placeholder="{{ __('Nosaukums, sērija vai krāsa...') }}">
            </div>
            <div class="col-12 col-md-3 d-grid d-md-flex gap-2">
                <button type="submit" class="btn btn-hw flex-fill">{{ __('Meklēt') }}</button>
                <a href="{{ route('mana.kolekcija') }}" class="btn btn-outline-hw">{{ __('Notīrīt') }}</a>
            </div>
        </div>
    </form>

    <div class="row g-4">
        @foreach($masinas as $masina)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                @include('partials.masina_kartite', [
                    'masina' => $masina,
                    'showOwnerActions' => true,
                ])
            </div>
        @endforeach

        @if($meklets === '')
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="{{ route('masina.pievienot') }}" class="hw-add">
                    <span class="plus">+</span>
                    <span class="fw-semibold mt-1">{{ __('Pievienot') }}</span>
                </a>
            </div>
        @endif
    </div>

    @if($masinas->isEmpty() && $meklets !== '')
        <div class=”hw-empty mt-4”>{{ __('Tavā kolekcijā nav atrasta neviena mašīna pēc') }} “{{ $meklets }}”.</div>
    @endif
@endsection
