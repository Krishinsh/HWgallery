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

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand hw-brand" href="{{ route('galerija') }}">
                <span class="hw-dot"></span> HotWheels Gallery
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#hwnav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="hwnav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('galerija') }}">{{ __('Galerija') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('lietotaji') }}">{{ __('Lietotāji') }}</a></li>
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('mana.kolekcija') }}">{{ __('Mana kolekcija') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('profils.show') }}">{{ __('Profils') }}</a></li>
                    @endauth
                </ul>

                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item d-flex align-items-center me-lg-3">
                        <a class="nav-link px-1 py-0 {{ app()->getLocale() === 'lv' ? 'fw-bold' : '' }}"
                           href="{{ route('lang.switch', 'lv') }}">LV</a>
                        <span class="text-muted mx-1">|</span>
                        <a class="nav-link px-1 py-0 {{ app()->getLocale() === 'en' ? 'fw-bold' : '' }}"
                           href="{{ route('lang.switch', 'en') }}">EN</a>
                    </li>
                    @auth
                        <li class="nav-item me-lg-3">
                            <a href="{{ route('profils.show') }}" class="hw-user text-decoration-none">{{ auth()->user()->nickname }}</a>
                            @if(auth()->user()->isAdmin())
                                <span class="hw-admin-badge">Admin</span>
                            @endif
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-hw btn-sm">{{ __('Izrakstīties') }}</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item me-lg-2 my-1 my-lg-0">
                            <a class="btn btn-outline-hw btn-sm" href="{{ route('login') }}">{{ __('Pieslēgties') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-hw btn-sm" href="{{ route('register') }}">{{ __('Reģistrēties') }}</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $kluda)
                        <li>{{ $kluda }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="hw-footer">
        <div class="container">{{ __('HWCollect — Hot Wheels kolekcijas galerija · Laravel 11 + MySQL') }}</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
