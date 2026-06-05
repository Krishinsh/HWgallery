@extends('layouts.app')

@section('title', $lietotajs->nickname . ' galerija')

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
        <div>
            <h1 class="hw-heading">{{ $lietotajs->nickname }}</h1>
            <p class="hw-sub mb-0">{{ $masinas->count() }} {{ __('mašīnas publiskajā kolekcijā') }}</p>
        </div>
        <a href="{{ route('lietotaji') }}" class="btn btn-outline-hw btn-sm">{{ __('← Visi lietotāji') }}</a>
    </div>

    @if($masinas->isEmpty())
        <div class="hw-empty">{{ __('Šim lietotājam vēl nav pievienota neviena mašīna.') }}</div>
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
