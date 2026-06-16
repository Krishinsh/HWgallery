@extends('layouts.app')

@section('title', __('Pievienot mašīnu'))

@section('content')
    <div class="hw-page-header">
        <div>
            <h1 class="hw-heading">{{ __('Pievienot mašīnu') }}</h1>
            <p class="hw-sub">{{ __('Pievieno jaunu Hot Wheels modeli savai kolekcijai') }}</p>
        </div>
    </div>

    <form action="{{ route('masina.pievienot') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="hw-grid--2">
            <div class="hw-card">
                <div class="hw-card__body">
                    <div class="hw-field">
                        <label for="model" class="hw-label">{{ __('Nosaukums') }}</label>
                        <input type="text" class="hw-input {{ $errors->has('model') ? 'hw-input--err' : '' }}"
                               id="model" name="model" value="{{ old('model') }}"
                               placeholder="{{ __('Piem. Twin Mill') }}" required>
                        @error('model')<div class="hw-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="hw-field">
                        <label for="year" class="hw-label">{{ __('Gads') }}</label>
                        <input type="number" class="hw-input {{ $errors->has('year') ? 'hw-input--err' : '' }}"
                               id="year" name="year" value="{{ old('year') }}"
                               placeholder="{{ __('Piem. 1969') }}" required>
                        @error('year')<div class="hw-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="hw-field">
                        <label for="series" class="hw-label">{{ __('Sērija') }}</label>
                        <input type="text" class="hw-input" id="series" name="series"
                               value="{{ old('series') }}" placeholder="{{ __('Piem. Super Treasure Hunt') }}">
                    </div>
                    <div class="hw-field">
                        <label for="color" class="hw-label">{{ __('Krāsa') }}</label>
                        <input type="text" class="hw-input" id="color" name="color"
                               value="{{ old('color') }}" placeholder="{{ __('Piem. Sarkana') }}">
                    </div>
                    <div class="hw-field">
                        <label for="description" class="hw-label">{{ __('Apraksts') }}</label>
                        <textarea class="hw-textarea" id="description" name="description"
                                  placeholder="{{ __('Brīvs apraksts par modeli...') }}">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="hw-card">
                <div class="hw-card__body">
                    <div class="hw-field">
                        <label for="images" class="hw-label">{{ __('Bildes') }}</label>
                        <input type="file" class="hw-input" id="images" name="images[]" accept="image/*" multiple>
                        <div id="preview" class="hw-thumbs"></div>
                        <p class="hw-sub hw-sub--sm" style="margin-top:.6rem;">
                            {{ __('Vari pievienot vairākas bildes. Atļauts: PNG, JPG, GIF, WEBP (līdz 5 MB katra). Pirmā bilde būs galvenā.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="hw-form-actions">
            <button type="submit" class="btn-hw">{{ __('Pievienot mašīnu') }}</button>
            <a href="{{ route('mana.kolekcija') }}" class="btn-out">{{ __('Atcelt') }}</a>
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
