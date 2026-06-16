@php
    $krasaMap = [
        'sarkana'  => '#E5484D', 'zila'     => '#3E63DD',
        'zaļa'     => '#46A758', 'zala'     => '#46A758',
        'dzeltena' => '#E8C400', 'oranža'   => '#FF8B3D',
        'oranza'   => '#FF8B3D', 'melna'    => '#3A3A3A',
        'balta'    => '#CBD0D6', 'sudraba'  => '#C4C8CC',
        'pelēka'   => '#9BA1A6', 'peleka'   => '#9BA1A6',
        'violeta'  => '#8E4EC6', 'rozā'     => '#E36BA6',
        'roza'     => '#E36BA6',
    ];
    $atslega   = mb_strtolower(trim($masina->color ?? ''));
    $autoKrasa = $krasaMap[$atslega] ?? '#E5484D';

    $showOwnerActions = $showOwnerActions ?? false;
    $showAdminDelete  = $showAdminDelete  ?? false;
@endphp

<div class="hw-card">
    <a href="{{ route('masina.detail', $masina->id) }}" class="hw-card__panel" style="background:{{ $autoKrasa }}1A;">
        @if($masina->image_url)
            <img src="{{ $masina->image_url }}" alt="{{ $masina->model }}">
        @else
            <svg viewBox="0 0 120 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M10 42 q5 -17 23 -19 l18 -2 q11 -9 25 -7 q15 2 21 15 l12 2 q9 2 7 13 l-1 4 H13 q-6 0 -3 -9 Z"
                      fill="{{ $autoKrasa }}"/>
                <rect x="42" y="24" width="26" height="10" rx="3" fill="rgba(255,255,255,.55)"/>
                <circle cx="36" cy="48" r="9" fill="#16181D"/>
                <circle cx="36" cy="48" r="4" fill="#D7DBDF"/>
                <circle cx="92" cy="48" r="9" fill="#16181D"/>
                <circle cx="92" cy="48" r="4" fill="#D7DBDF"/>
            </svg>
        @endif
    </a>

    <div class="hw-card__body">
        <a href="{{ route('masina.detail', $masina->id) }}" class="hw-card__title">{{ $masina->model }}</a>
        <div class="hw-card__year">{{ $masina->year }}</div>
        <span class="hw-pill">{{ $masina->series }}</span>

        @if($showOwnerActions || $showAdminDelete)
            <div class="hw-card__actions">
                @if($showOwnerActions)
                    <a href="{{ route('masina.rediget', $masina->id) }}" class="btn-out btn-out--sm">{{ __('Rediģēt') }}</a>
                    <form method="POST" action="{{ route('masina.dzest', $masina->id) }}"
                          onsubmit="return confirm('{{ __('Dzēst mašīnu') }} \"{{ $masina->model }}\"?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-hw btn-hw--sm">{{ __('Dzēst') }}</button>
                    </form>
                @elseif($showAdminDelete)
                    <form method="POST" action="{{ route('admin.dzest', $masina->id) }}"
                          onsubmit="return confirm('{{ __('Administrators: dzēst saturu') }} \"{{ $masina->model }}\"?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-hw btn-hw--sm">{{ __('Dzēst (admin)') }}</button>
                    </form>
                @endif
            </div>
        @endif
    </div>
</div>
