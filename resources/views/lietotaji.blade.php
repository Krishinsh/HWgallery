@extends('layouts.app')

@section('title', __('Lietotāji'))

@section('content')
    <div class=”mb-3”>
        <h1 class=”hw-heading”>{{ __('Lietotāji') }}</h1>
        <p class=”hw-sub mb-0”>{{ __('Apskati citu kolekcionāru publiskās galerijas') }}</p>
    </div>

    @if($lietotaji->isEmpty())
        <div class=”hw-empty”>{{ __('Vēl nav neviena reģistrēta lietotāja.') }}</div>
    @else
        @php $esmuAdmins = auth()->check() && auth()->user()->isAdmin(); @endphp
        <div class=”row g-4”>
            @foreach($lietotaji as $lietotajs)
                <div class=”col-12 col-sm-6 col-md-4 col-lg-3”>
                    <div class=”hw-card h-100”>
                        <div class=”hw-card__body d-flex flex-column”>
                            <div class=”d-flex align-items-center justify-content-between”>
                                <span class=”hw-card__title”>{{ $lietotajs->nickname }}</span>
                                @if($lietotajs->isAdmin())
                                    <span class=”hw-admin-badge”>Admin</span>
                                @endif
                            </div>
                            <div class=”hw-card__year”>{{ $lietotajs->cars_count }} {{ __('mašīnas') }}</div>

                            <a href=”{{ route('lietotajs.galerija', $lietotajs->id) }}” class=”btn btn-outline-hw btn-sm mt-2”>
                                {{ __('Apskatīt galeriju') }}
                            </a>

                            @if($esmuAdmins && $lietotajs->id !== auth()->id())
                                <form method=”POST” action=”{{ route('admin.lietotajs.dzest', $lietotajs->id) }}”
                                      onsubmit=”return confirm('{{ __('Administrators: dzēst lietotāju') }} \”{{ $lietotajs->nickname }}\” {{ __('un visu tā saturu?') }}');”
                                      class=”mt-2”>
                                    @csrf @method('DELETE')
                                    <button type=”submit” class=”btn btn-hw btn-sm w-100”>{{ __('Dzēst lietotāju') }}</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
