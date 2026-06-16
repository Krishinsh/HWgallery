<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('HotWheels Gallery')) — HWCollect</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <nav class="hw-nav">
        <div class="hw-wrap">
            <div class="hw-nav__inner">
                <a class="hw-brand" href="{{ route('galerija') }}">
                    <span class="hw-dot"></span> HotWheels Gallery
                </a>

                <button class="hw-nav__toggle" id="hw-toggle" aria-label="Izvēlne" aria-expanded="false">
                    <span></span><span></span><span></span>
                </button>

                <div class="hw-nav__menu" id="hw-menu">
                    <div class="hw-nav__left">
                        <a class="hw-nav__link" href="{{ route('galerija') }}">{{ __('Galerija') }}</a>
                        <a class="hw-nav__link" href="{{ route('lietotaji') }}">{{ __('Lietotāji') }}</a>
                        @auth
                            <a class="hw-nav__link" href="{{ route('mana.kolekcija') }}">{{ __('Mana kolekcija') }}</a>
                            <a class="hw-nav__link" href="{{ route('profils.show') }}">{{ __('Profils') }}</a>
                        @endauth
                    </div>

                    <div class="hw-nav__right">
                        <div class="hw-lang">
                            <a href="{{ route('lang.switch', 'lv') }}"
                               class="{{ app()->getLocale() === 'lv' ? 'hw-lang--active' : '' }}">LV</a>
                            <span class="hw-lang__sep">|</span>
                            <a href="{{ route('lang.switch', 'en') }}"
                               class="{{ app()->getLocale() === 'en' ? 'hw-lang--active' : '' }}">EN</a>
                        </div>

                        @auth
                            <a href="{{ route('profils.show') }}" class="hw-user">{{ auth()->user()->nickname }}</a>
                            @if(auth()->user()->isAdmin())
                                <span class="hw-admin-badge">Admin</span>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn-out btn-out--sm">{{ __('Izrakstīties') }}</button>
                            </form>
                        @else
                            <a class="btn-out btn-out--sm" href="{{ route('login') }}">{{ __('Pieslēgties') }}</a>
                            <a class="btn-hw btn-hw--sm" href="{{ route('register') }}">{{ __('Reģistrēties') }}</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="hw-main">
        <div class="hw-wrap">
            @if(session('success'))
                <div class="hw-alert hw-alert--ok">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="hw-alert hw-alert--err">{{ session('error') }}</div>
            @endif
            @if(session('warning'))
                <div class="hw-alert hw-alert--warn">{{ session('warning') }}</div>
            @endif
            @if($errors->any())
                <div class="hw-alert hw-alert--err">
                    <ul>
                        @foreach($errors->all() as $kluda)
                            <li>{{ $kluda }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="hw-footer">
        <div class="hw-wrap">{{ __('HWCollect — Hot Wheels kolekcijas galerija · Laravel 11 + MySQL') }}</div>
    </footer>

    <script>
        (function () {
            var btn  = document.getElementById('hw-toggle');
            var menu = document.getElementById('hw-menu');
            btn.addEventListener('click', function () {
                var open = menu.classList.toggle('open');
                btn.classList.toggle('open', open);
                btn.setAttribute('aria-expanded', open);
            });
        })();
    </script>

    @yield('scripts')
</body>
</html>
