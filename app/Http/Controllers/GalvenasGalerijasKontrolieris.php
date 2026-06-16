<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class GalvenasGalerijasKontrolieris extends Controller
{
    private function pielietotKartosanu(Builder $query, ?string $kartot): void
    {
        match ($kartot) {
            'nosaukums' => $query->orderBy('model'),
            'gads'      => $query->orderBy('year'),
            'serija'    => $query->orderBy('series'),
            'krasa'     => $query->orderBy('color'),
            'vecakie'   => $query->orderBy('created_at'),
            default     => $query->orderByDesc('created_at'),
        };
    }

    public function list(Request $request)
    {
        return $this->renderetGaleriju($request, __('Galvenā galerija'));
    }

    public function search(Request $request)
    {
        return $this->renderetGaleriju($request, __('Meklēšanas rezultāti'));
    }

    private function renderetGaleriju(Request $request, string $virsraksts)
    {
        $meklets = trim((string) $request->query('q', ''));

        $query = Car::query()->with(['user', 'images']);

        if ($meklets !== '') {
            $query->where(function (Builder $sub) use ($meklets) {
                $sub->where('model', 'like', "%{$meklets}%")
                    ->orWhere('series', 'like', "%{$meklets}%")
                    ->orWhere('color', 'like', "%{$meklets}%");
            });
        }

        if ($serija = $request->query('serija')) {
            $query->where('series', $serija);
        }

        $this->pielietotKartosanu($query, $request->query('kartot'));

        return view('galerija', [
            'masinas'      => $query->get(),
            'serijas'      => Car::query()->select('series')->distinct()->orderBy('series')->pluck('series'),
            'meklets'      => $meklets,
            'izveletaSer'  => $request->query('serija'),
            'kartot'       => $request->query('kartot'),
            'virsraksts'   => $virsraksts,
        ]);
    }

    public function detail(int $id)
    {
        $masina = Car::with(['user', 'images'])->findOrFail($id);

        return view('masina', ['masina' => $masina]);
    }

    public function users()
    {
        $lietotaji = User::withCount('cars')->orderBy('nickname')->get();

        return view('lietotaji', ['lietotaji' => $lietotaji]);
    }

    public function userGallery(int $id)
    {
        $lietotajs = User::findOrFail($id);
        $masinas = $lietotajs->cars()->with('images')->orderByDesc('created_at')->get();

        return view('lietotaja_galerija', [
            'lietotajs' => $lietotajs,
            'masinas'   => $masinas,
        ]);
    }
}
