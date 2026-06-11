<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdministratoraKontrolieris extends Controller
{
    public function deleteContent(int $id)
    {
        $masina = Car::with('images')->findOrFail($id);

        foreach ($masina->images as $bilde) {
            Storage::disk('public')->delete($bilde->image_path);
        }
        $masina->delete();

        return redirect()->route('galerija')
            ->with('success', 'Saturs izdzēsts no sistēmas.');
    }

    public function deleteUser(int $id)
    {
        $lietotajs = User::with('cars.images')->findOrFail($id);

        if ($lietotajs->id === Auth::id()) {
            return back()->with('error', 'Savu kontu dzēsiet profila sadaļā, nevis kā administrators.');
        }

        foreach ($lietotajs->cars as $masina) {
            foreach ($masina->images as $bilde) {
                Storage::disk('public')->delete($bilde->image_path);
            }
        }

        $vards = $lietotajs->nickname;
        $lietotajs->delete();

        return redirect()->route('lietotaji')
            ->with('success', "Lietotājs \"{$vards}\" un viss tā saturs ir izdzēsts.");
    }
}
