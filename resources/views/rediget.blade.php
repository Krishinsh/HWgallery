@extends('layouts.app')

@section('title', __('Rediģēt mašīnu'))

@section('content')
    <div class="mb-3">
        <h1 class="hw-heading">{{ __('Rediģēt mašīnu') }}</h1>
        <p class="hw-sub mb-0">{{ $masina->model }} ({{ $masina->year }})</p>
    </div>

    {{-- Esošās bildes ar dzēšanu (atsevišķas formas, ārpus galvenās formas) --}}
    @if($masina->images->count() > 0)
        <div class="hw-card mb-4">
            <div class="hw-card__body">
                <label class="form-label fw-semibold">{{ __('Pašreizējās bildes') }}</label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($masina->images as $bilde)
                        <div class="position-relative">
                            <img src="{{ $bilde->url }}" alt="bilde"
                                 style="width:96px;height:96px;object-fit:cover;border-radius:10px;
                                        border:2px solid {{ $bilde->is_primary ? 'var(--hw-red)' : 'var(--line)' }};">
                            <form method="POST" action="{{ route('masina.bilde.dzest', [$masina->id, $bilde->id]) }}"
                                  onsubmit="return confirm('{{ __('Dzēst šo bildi?') }}');"
                                  style="position:absolute;top:-8px;right:-8px;">
                                @csrf @method('DELETE')
                                <button type="submit" title="Dzēst bildi"
                                        style="border:none;border-radius:50%;width:24px;height:24px;line-height:1;
                                               background:var(--hw-red);color:#fff;font-weight:700;cursor:pointer;">×</button>
                            </form>
                        </div>
                    @endforeach
                </div>
                <p class="hw-sub small mt-2 mb-0">{{ __('Sarkanā ietvarā — galvenā bilde.') }}</p>
            </div>
        </div>
    @endif

    <form action="{{ route('masina.rediget', $masina->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <div class="hw-card">
                    <div class="hw-card__body">
                        <div class="mb-3">
                            <label for="model" class="form-label fw-semibold">{{ __('Nosaukums') }}</label>
                            <input type="text" class="form-control @error('model') is-invalid @enderror"
                                   id="model" name="model" value="{{ old('model', $masina->model) }}" required>
                            @error('model')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="year" class="form-label fw-semibold">{{ __('Gads') }}</label>
                            <input type="number" class="form-control @error('year') is-invalid @enderror"
                                   id="year" name="year" value="{{ old('year', $masina->year) }}" required>
                            @error('year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="series" class="form-label fw-semibold">{{ __('Sērija') }}</label>
                            <input type="text" class="form-control" id="series" name="series"
                                   value="{{ old('series', $masina->series) }}">
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label fw-semibold">{{ __('Krāsa') }}</label>
                            <input type="text" class="form-control" id="color" name="color"
                                   value="{{ old('color', $masina->color) }}">
                        </div>
                        <div class="mb-0">
                            <label for="description" class="form-label fw-semibold">{{ __('Apraksts') }}</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $masina->description) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="hw-card">
                    <div class="hw-card__body">
                        <label for="images" class="form-label fw-semibold">{{ __('Pievienot bildes (neobligāti)') }}</label>
                        <input type="file" class="form-control"
                               id="images" name="images[]" accept="image/*" multiple>
                        <div id="preview" class="d-flex flex-wrap gap-2 mt-3"></div>
                        <p class="hw-sub small mt-2 mb-0">{{ __('Jaunās bildes tiek pievienotas esošajām. Atļauts: PNG, JPG, GIF, WEBP (līdz 5 MB katra).') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-hw">{{ __('Saglabāt izmaiņas') }}</button>
            <a href="{{ route('masina.detail', $masina->id) }}" class="btn btn-outline-hw">{{ __('Atcelt') }}</a>
        </div>
    </form>
@endsection

@section('scripts')
<script>
    const input = document.getElementById('images');
    const preview = document.getElementById('preview');
    input.addEventListener('change', function (e) {
        preview.innerHTML = '';
        Array.from(e.target.files).forEach(function (file) {
            const reader = new FileReader();
            reader.onload = function (ev) {
                const img = document.createElement('img');
                img.src = ev.target.result;
                img.style.width = '90px';
                img.style.height = '90px';
                img.style.objectFit = 'cover';
                img.style.borderRadius = '10px';
                img.style.border = '1px solid var(--line)';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
</script>
@endsection
