@extends('layouts.app')

@section('title', $lietotajs->nickname . ' galerija')

@section('content')
    <div class="hw-page-header hw-page-header--center">
        <div>
            <h1 class="hw-heading">{{ $lietotajs->nickname }}</h1>
            <p class="hw-sub">{{ $masinas->count() }} {{ __('mašīnas publiskajā kolekcijā') }}</p>
        </div>
        <a href="{{ route('lietotaji') }}" class="btn-out btn-out--sm">{{ __('← Visi lietotāji') }}</a>
    </div>

    @if($masinas->isEmpty())
        <div class="hw-empty">{{ __('Šim lietotājam vēl nav pievienota neviena mašīna.') }}</div>
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
