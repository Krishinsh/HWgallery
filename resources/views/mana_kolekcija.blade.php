@extends('layouts.app')

@section('title', __('Mana kolekcija'))

@section('content')
    @php $meklets = $meklets ?? ''; @endphp

    <div class="hw-page-header">
        <div>
            <h1 class="hw-heading">{{ __('Mana kolekcija') }}</h1>
            <p class="hw-sub">{{ $masinas->count() }} {{ __('mašīnas kolekcijā') }}</p>
        </div>
        <a href="{{ route('masina.pievienot') }}" class="btn-hw">{{ __('+ Pievienot mašīnu') }}</a>
    </div>

    <form method="GET" action="{{ route('mana.kolekcija.meklet') }}" class="hw-toolbar">
        <div class="hw-toolbar__row hw-toolbar__row--kol">
            <div>
                <label for="q" class="hw-label hw-label--sm">{{ __('Meklēt savā kolekcijā') }}</label>
                <input type="text" class="hw-input" id="q" name="q"
                       value="{{ $meklets }}" placeholder="{{ __('Nosaukums, sērija vai krāsa...') }}">
            </div>
            <div class="hw-toolbar__btns">
                <button type="submit" class="btn-hw">{{ __('Meklēt') }}</button>
                <a href="{{ route('mana.kolekcija') }}" class="btn-out">{{ __('Notīrīt') }}</a>
            </div>
        </div>
    </form>

    <div class="hw-grid">
        @foreach($masinas as $masina)
            @include('partials.masina_kartite', [
                'masina' => $masina,
                'showOwnerActions' => true,
            ])
        @endforeach

        @if($meklets === '')
            <a href="{{ route('masina.pievienot') }}" class="hw-add">
                <span class="hw-add__plus">+</span>
                <span class="hw-add__label">{{ __('Pievienot') }}</span>
            </a>
        @endif
    </div>

    @if($masinas->isEmpty() && $meklets !== '')
        <div class="hw-empty" style="margin-top:1rem;">
            {{ __('Tavā kolekcijā nav atrasta neviena mašīna pēc') }} "{{ $meklets }}".
        </div>
    @endif
@endsection
