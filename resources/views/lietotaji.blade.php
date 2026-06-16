@extends('layouts.app')

@section('title', __('Lietotāji'))

@section('content')
    <div class="hw-page-header">
        <div>
            <h1 class="hw-heading">{{ __('Lietotāji') }}</h1>
            <p class="hw-sub">{{ __('Apskati citu kolekcionāru publiskās galerijas') }}</p>
        </div>
    </div>

    @if($lietotaji->isEmpty())
        <div class="hw-empty">{{ __('Vēl nav neviena reģistrēta lietotāja.') }}</div>
    @else
        @php $esmuAdmins = auth()->check() && auth()->user()->isAdmin(); @endphp
        <div class="hw-grid">
            @foreach($lietotaji as $lietotajs)
                <div class="hw-card">
                    <div class="hw-card__body">
                        <div class="hw-card__top">
                            <span class="hw-card__title">{{ $lietotajs->nickname }}</span>
                            @if($lietotajs->isAdmin())
                                <span class="hw-admin-badge">Admin</span>
                            @endif
                        </div>
                        <div class="hw-card__year">{{ $lietotajs->cars_count }} {{ __('mašīnas') }}</div>

                        <a href="{{ route('lietotajs.galerija', $lietotajs->id) }}"
                           class="btn-out btn-out--sm" style="margin-top:.6rem;">
                            {{ __('Apskatīt galeriju') }}
                        </a>

                        @if($esmuAdmins && $lietotajs->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.lietotajs.dzest', $lietotajs->id) }}"
                                  onsubmit="return confirm('{{ __('Administrators: dzēst lietotāju') }} \"{{ $lietotajs->nickname }}\" {{ __('un visu tā saturu?') }}');"
                                  style="margin-top:.5rem;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-hw btn-hw--sm btn-hw--full">{{ __('Dzēst lietotāju') }}</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
