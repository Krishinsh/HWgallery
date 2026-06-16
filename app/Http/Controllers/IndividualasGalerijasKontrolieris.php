<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class IndividualasGalerijasKontrolieris extends Controller
{
    private function noteikumi(): array
    {
        return [
            'model'       => ['required', 'string', 'max:255'],
            'year'        => ['required', 'integer', 'min:1950', 'max:' . (date('Y') + 1)],
            'series'      => ['nullable', 'string', 'max:255'],
            'color'       => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:2000'],
            'images'      => ['nullable', 'array', 'max:8'],
            'images.*'    => ['image', 'mimes:png,jpg,jpeg,gif,webp', 'max:5120'],
        ];
    }

    private function atributi(): array
    {
        return [
            'model'       => __('nosaukums'),
            'year'        => __('gads'),
            'series'      => __('sērija'),
            'color'       => __('krāsa'),
            'description' => __('apraksts'),
            'images.*'    => __('bilde'),
        ];
    }

    private function zinojumi(): array
    {
        return [
            'model.required'  => __('Nosaukums ir obligāts.'),
            'year.required'   => __('Gads ir obligāts.'),
            'year.integer'    => __('Gadam jābūt skaitlim.'),
            'year.min'        => __('Gadam jābūt vismaz 1950.'),
            'year.max'        => __('Gads nevar būt lielāks par :max.'),
            'images.*.image'  => __('Failam jābūt attēlam.'),
            'images.*.mimes'  => __('Atļautie formāti: png, jpg, jpeg, gif, webp.'),
            'images.*.max'    => __('Bilde nedrīkst pārsniegt 5 MB.'),
        ];
    }

    public function select(Request $request)
    {
        $masinas = Auth::user()->cars()->with('images')->orderByDesc('created_at')->get();

        return view('mana_kolekcija', ['masinas' => $masinas]);
    }

    public function search(Request $request)
    {
        $meklets = trim((string) $request->query('q', ''));

        $masinas = Auth::user()->cars()
            ->with('images')
            ->when($meklets !== '', function ($query) use ($meklets) {
                $query->where(function ($sub) use ($meklets) {
                    $sub->where('model', 'like', "%{$meklets}%")
                        ->orWhere('series', 'like', "%{$meklets}%")
                        ->orWhere('color', 'like', "%{$meklets}%");
                });
            })
            ->orderByDesc('created_at')
            ->get();

        return view('mana_kolekcija', ['masinas' => $masinas, 'meklets' => $meklets]);
    }

    public function pievienotForm()
    {
        return view('pievieno');
    }

    public function create(Request $request)
    {
        $dati = $request->validate($this->noteikumi(), $this->zinojumi(), $this->atributi());

        $masina = Auth::user()->cars()->create([
            'model'       => $dati['model'],
            'year'        => $dati['year'],
            'series'      => $dati['series'] ?: 'Mainline',
            'color'       => $dati['color'] ?: 'Nav norādīta',
            'description' => $dati['description'] ?? null,
        ]);

        $this->saglabatBildes($request, $masina);

        return redirect()->route('mana.kolekcija')
            ->with('success', 'Mašīna veiksmīgi pievienota kolekcijai.');
    }

    public function edit(int $id)
    {
        $masina = Car::with('images')->findOrFail($id);
        $this->parbauditIpasnieku($masina);

        return view('rediget', ['masina' => $masina]);
    }

    public function update(Request $request, int $id)
    {
        $masina = Car::with('images')->findOrFail($id);
        $this->parbauditIpasnieku($masina);

        $dati = $request->validate($this->noteikumi(), $this->zinojumi(), $this->atributi());

        $masina->model       = $dati['model'];
        $masina->year        = $dati['year'];
        $masina->series      = $dati['series'] ?: $masina->series;
        $masina->color       = $dati['color'] ?: $masina->color;
        $masina->description = $dati['description'] ?? null;
        $masina->save();

        $this->saglabatBildes($request, $masina);

        return redirect()->route('masina.detail', $masina->id)
            ->with('success', 'Izmaiņas saglabātas.');
    }

    public function delete(int $id)
    {
        $masina = Car::with('images')->findOrFail($id);
        $this->parbauditIpasnieku($masina);

        foreach ($masina->images as $bilde) {
            Storage::disk('public')->delete($bilde->image_path);
        }
        $masina->delete();

        return redirect()->route('mana.kolekcija')
            ->with('success', 'Mašīna izdzēsta no kolekcijas.');
    }

    public function dzestBildi(int $carId, int $imageId)
    {
        $masina = Car::with('images')->findOrFail($carId);
        $this->parbauditIpasnieku($masina);

        $bilde = CarImage::where('car_id', $masina->id)->findOrFail($imageId);
        $byPrimary = $bilde->is_primary;

        Storage::disk('public')->delete($bilde->image_path);
        $bilde->delete();

        if ($byPrimary) {
            $cita = $masina->images()->first();
            if ($cita) {
                $cita->is_primary = true;
                $cita->save();
            }
        }

        return back()->with('success', 'Bilde izdzēsta.');
    }

    private function saglabatBildes(Request $request, Car $masina): void
    {
        if (! $request->hasFile('images')) {
            return;
        }

        $vaiPirma = $masina->images()->count() === 0;

        foreach ($request->file('images') as $fails) {
            $cels = $fails->store('cars', 'public');

            $masina->images()->create([
                'image_path' => $cels,
                'is_primary' => $vaiPirma,
            ]);

            $vaiPirma = false;
        }
    }

    private function parbauditIpasnieku(Car $masina): void
    {
        if ($masina->user_id !== Auth::id() && ! Auth::user()->isAdmin()) {
            abort(403, 'Šī nav jūsu mašīna.');
        }
    }
}
