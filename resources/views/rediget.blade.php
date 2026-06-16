@extends('layouts.app')

@section('title', __('Rediģēt mašīnu'))

@section('content')
    <div class="hw-page-header">
        <div>
            <h1 class="hw-heading">{{ __('Rediģēt mašīnu') }}</h1>
            <p class="hw-sub">{{ $masina->model }} ({{ $masina->year }})</p>
        </div>
    </div>

    @if($masina->images->count() > 0)
        <div class="hw-card hw-card--flat hw-card--mb">
            <div class="hw-card__body">
                <label class="hw-label">{{ __('Pašreizējās bildes') }}</label>
                <div class="hw-thumbs">
                    @foreach($masina->images as $bilde)
                        <div class="hw-thumb-wrap">
                            <img src="{{ $bilde->url }}" alt="bilde"
                                 class="hw-thumb {{ $bilde->is_primary ? 'hw-thumb--primary' : '' }}">
                            <form method="POST" action="{{ route('masina.bilde.dzest', [$masina->id, $bilde->id]) }}"
                                  onsubmit="return confirm('{{ __('Dzēst šo bildi?') }}');">
                                @csrf @method('DELETE')
                                <button type="submit" class="hw-thumb-del" title="Dzēst bildi">×</button>
                            </form>
                        </div>
                    @endforeach
                </div>
                <p class="hw-sub hw-sub--sm" style="margin-top:.5rem;">{{ __('Sarkanā ietvarā — galvenā bilde.') }}</p>
            </div>
        </div>
    @endif

    <form action="{{ route('masina.rediget', $masina->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="hw-grid--2">
            <div class="hw-card">
                <div class="hw-card__body">
                    <div class="hw-field">
                        <label for="model" class="hw-label">{{ __('Nosaukums') }}</label>
                        <input type="text" class="hw-input {{ $errors->has('model') ? 'hw-input--err' : '' }}"
                               id="model" name="model" value="{{ old('model', $masina->model) }}" required>
                        @error('model')<div class="hw-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="hw-field">
                        <label for="year" class="hw-label">{{ __('Gads') }}</label>
                        <input type="number" class="hw-input {{ $errors->has('year') ? 'hw-input--err' : '' }}"
                               id="year" name="year" value="{{ old('year', $masina->year) }}" required>
                        @error('year')<div class="hw-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="hw-field">
                        <label for="series" class="hw-label">{{ __('Sērija') }}</label>
                        <input type="text" class="hw-input" id="series" name="series"
                               value="{{ old('series', $masina->series) }}">
                    </div>
                    <div class="hw-field">
                        <label for="color" class="hw-label">{{ __('Krāsa') }}</label>
                        <input type="text" class="hw-input" id="color" name="color"
                               value="{{ old('color', $masina->color) }}">
                    </div>
                    <div class="hw-field">
                        <label for="description" class="hw-label">{{ __('Apraksts') }}</label>
                        <textarea class="hw-textarea" id="description" name="description">{{ old('description', $masina->description) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="hw-card">
                <div class="hw-card__body">
                    <div class="hw-field">
                        <label for="images" class="hw-label">{{ __('Pievienot bildes (neobligāti)') }}</label>
                        <input type="file" class="hw-input" id="images" name="images[]" accept="image/*" multiple>
                        <div id="preview" class="hw-thumbs"></div>
                        <p class="hw-sub hw-sub--sm" style="margin-top:.6rem;">
                            {{ __('Jaunās bildes tiek pievienotas esošajām. Atļauts: PNG, JPG, GIF, WEBP (līdz 5 MB katra).') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="hw-form-actions">
            <button type="submit" class="btn-hw">{{ __('Saglabāt izmaiņas') }}</button>
            <a href="{{ route('masina.detail', $masina->id) }}" class="btn-out">{{ __('Atcelt') }}</a>
        </div>
    </form>
@endsection

@section('scripts')
<script>
    document.getElementById('images').addEventListener('change', function (e) {
        var preview = document.getElementById('preview');
        preview.innerHTML = '';
        Array.from(e.target.files).forEach(function (file) {
            var reader = new FileReader();
            reader.onload = function (ev) {
                var img = document.createElement('img');
                img.src = ev.target.result;
                img.className = 'hw-thumb';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
</script>
@endsection
