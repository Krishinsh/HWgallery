@extends('layouts.app')

@section('title', __('Pievienot mašīnu'))

@section('content')
    <div class="mb-3">
        <h1 class="hw-heading">{{ __('Pievienot mašīnu') }}</h1>
        <p class="hw-sub mb-0">{{ __('Pievieno jaunu Hot Wheels modeli savai kolekcijai') }}</p>
    </div>

    <form action="{{ route('masina.pievienot') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <div class="hw-card">
                    <div class="hw-card__body">
                        <div class="mb-3">
                            <label for="model" class="form-label fw-semibold">{{ __('Nosaukums') }}</label>
                            <input type="text" class="form-control @error('model') is-invalid @enderror"
                                   id="model" name="model" value="{{ old('model') }}" placeholder="{{ __('Piem. Twin Mill') }}" required>
                            @error('model')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="year" class="form-label fw-semibold">{{ __('Gads') }}</label>
                            <input type="number" class="form-control @error('year') is-invalid @enderror"
                                   id="year" name="year" value="{{ old('year') }}" placeholder="{{ __('Piem. 1969') }}" required>
                            @error('year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="series" class="form-label fw-semibold">{{ __('Sērija') }}</label>
                            <input type="text" class="form-control" id="series" name="series"
                                   value="{{ old('series') }}" placeholder="{{ __('Piem. Super Treasure Hunt') }}">
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label fw-semibold">{{ __('Krāsa') }}</label>
                            <input type="text" class="form-control" id="color" name="color"
                                   value="{{ old('color') }}" placeholder="{{ __('Piem. Sarkana') }}">
                        </div>
                        <div class="mb-0">
                            <label for="description" class="form-label fw-semibold">{{ __('Apraksts') }}</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                      placeholder="{{ __('Brīvs apraksts par modeli...') }}">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="hw-card">
                    <div class="hw-card__body">
                        <label for="images" class="form-label fw-semibold">{{ __('Bildes') }}</label>
                        <input type="file" class="form-control"
                               id="images" name="images[]" accept="image/*" multiple>
                        <div id="preview" class="d-flex flex-wrap gap-2 mt-3"></div>
                        <p class="hw-sub small mt-2 mb-0">{{ __('Vari pievienot vairākas bildes. Atļauts: PNG, JPG, GIF, WEBP (līdz 5 MB katra). Pirmā bilde būs galvenā.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-hw">{{ __('Pievienot mašīnu') }}</button>
            <a href="{{ route('mana.kolekcija') }}" class="btn btn-outline-hw">{{ __('Atcelt') }}</a>
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
