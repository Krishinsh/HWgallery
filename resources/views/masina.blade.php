@extends('layouts.app')

@section('title', $masina->model)

@section('content')
    @php
        $krasaMap = [
            'sarkana'=>'#E5484D','zila'=>'#3E63DD','zaļa'=>'#46A758','zala'=>'#46A758',
            'dzeltena'=>'#E8C400','oranža'=>'#FF8B3D','oranza'=>'#FF8B3D','melna'=>'#3A3A3A',
            'balta'=>'#CBD0D6','sudraba'=>'#C4C8CC','pelēka'=>'#9BA1A6','peleka'=>'#9BA1A6',
            'violeta'=>'#8E4EC6','rozā'=>'#E36BA6','roza'=>'#E36BA6',
        ];
        $autoKrasa = $krasaMap[mb_strtolower(trim($masina->color ?? ''))] ?? '#E5484D';
        $irIpasnieks = auth()->check() && auth()->id() === $masina->user_id;
        $irAdmins    = auth()->check() && auth()->user()->isAdmin();
        $bildes      = $masina->images;
        $galvena     = $masina->primaryImage();
    @endphp

    <a href="{{ url()->previous() }}" class="btn btn-outline-hw btn-sm mb-3">{{ __('← Atpakaļ') }}</a>

    <div class="row g-4">
        <div class="col-12 col-lg-6">
            <div class="hw-card">
                <div class="hw-card__panel" style="background:{{ $autoKrasa }}1A; aspect-ratio:1/1;">
                    @if($galvena)
                        <img id="hw-main-image" src="{{ $galvena->url }}" alt="{{ $masina->model }}">
                    @else
                        <svg viewBox="0 0 120 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M10 42 q5 -17 23 -19 l18 -2 q11 -9 25 -7 q15 2 21 15 l12 2 q9 2 7 13 l-1 4 H13 q-6 0 -3 -9 Z" fill="{{ $autoKrasa }}"/>
                            <rect x="42" y="24" width="26" height="10" rx="3" fill="rgba(255,255,255,.55)"/>
                            <circle cx="36" cy="48" r="9" fill="#16181D"/><circle cx="36" cy="48" r="4" fill="#D7DBDF"/>
                            <circle cx="92" cy="48" r="9" fill="#16181D"/><circle cx="92" cy="48" r="4" fill="#D7DBDF"/>
                        </svg>
                    @endif
                </div>
            </div>

            @if($bildes->count() > 0)
                <div class="d-flex flex-wrap gap-2 mt-3">
                    @foreach($bildes as $bilde)
                        <div class="position-relative">
                            <img src="{{ $bilde->url }}" alt="bilde"
                                 onclick="document.getElementById('hw-main-image').src = this.src;"
                                 style="width:74px;height:74px;object-fit:cover;border-radius:10px;cursor:pointer;
                                        border:2px solid {{ $bilde->is_primary ? 'var(--hw-red)' : 'var(--line)' }};">
                            @if($irIpasnieks)
                                <form method="POST" action="{{ route('masina.bilde.dzest', [$masina->id, $bilde->id]) }}"
                                      onsubmit="return confirm('{{ __('Dzēst šo bildi?') }}');"
                                      style="position:absolute;top:-8px;right:-8px;">
                                    @csrf @method('DELETE')
                                    <button type="submit" title="Dzēst bildi"
                                            style="border:none;border-radius:50%;width:22px;height:22px;line-height:1;
                                                   background:var(--hw-red);color:#fff;font-weight:700;cursor:pointer;">×</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="col-12 col-lg-6">
            <div class="hw-card h-100">
                <div class="hw-card__body">
                    <h1 class="hw-heading mb-2">{{ $masina->model }}</h1>
                    <span class="hw-pill mb-3">{{ $masina->series }}</span>

                    <table class="table table-sm mt-3">
                        <tbody>
                            <tr><th class="text-muted" style="width:40%">{{ __('Gads') }}</th><td>{{ $masina->year }}</td></tr>
                            <tr><th class="text-muted">{{ __('Sērija') }}</th><td>{{ $masina->series }}</td></tr>
                            <tr><th class="text-muted">{{ __('Krāsa') }}</th><td>{{ $masina->color ?? __('Nav norādīta') }}</td></tr>
                            <tr>
                                <th class="text-muted">{{ __('Pievienoja') }}</th>
                                <td>
                                    @if($masina->user)
                                        <a href="{{ route('lietotajs.galerija', $masina->user->id) }}">{{ $masina->user->nickname }}</a>
                                    @else
                                        {{ __('nezināms') }}
                                    @endif
                                </td>
                            </tr>
                            <tr><th class="text-muted">{{ __('Pievienots') }}</th><td>{{ $masina->created_at->format('Y-m-d H:i') }}</td></tr>
                        </tbody>
                    </table>

                    @if($masina->description)
                        <p class="mt-2">{{ $masina->description }}</p>
                    @endif

                    @if($irIpasnieks || $irAdmins)
                        <div class="hw-card__actions mt-3">
                            @if($irIpasnieks)
                                <a href=”{{ route('masina.rediget', $masina->id) }}” class=”btn btn-outline-hw”>{{ __('Rediģēt') }}</a>
                                <form method=”POST” action=”{{ route('masina.dzest', $masina->id) }}”
                                      onsubmit=”return confirm('{{ __('Dzēst mašīnu') }} \”{{ $masina->model }}\”?');”>
                                    @csrf @method('DELETE')
                                    <button type=”submit” class=”btn btn-hw”>{{ __('Dzēst') }}</button>
                                </form>
                            @elseif($irAdmins)
                                <form method=”POST” action=”{{ route('admin.dzest', $masina->id) }}”
                                      onsubmit=”return confirm('{{ __('Administrators: dzēst šo saturu?') }}');”>
                                    @csrf @method('DELETE')
                                    <button type=”submit” class=”btn btn-hw”>{{ __('Dzēst (admin)') }}</button>
                                </form>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
