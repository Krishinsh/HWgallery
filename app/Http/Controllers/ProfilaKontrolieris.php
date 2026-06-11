<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfilaKontrolieris extends Controller
{
    public function show()
    {
        $lietotajs = Auth::user()->loadCount('cars');

        return view('profils', ['lietotajs' => $lietotajs]);
    }

    public function update(Request $request)
    {
        $lietotajs = Auth::user();

        $dati = $request->validate([
            'nickname' => ['required', 'string', 'max:255', Rule::unique('users', 'nickname')->ignore($lietotajs->id)],
            'email'    => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($lietotajs->id)],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ], [], [
            'nickname' => 'lietotājvārds',
            'email'    => 'e-pasts',
            'password' => 'parole',
        ]);

        $lietotajs->nickname = $dati['nickname'];
        $lietotajs->email    = $dati['email'];

        if (! empty($dati['password'])) {
            $lietotajs->password = $dati['password'];
        }

        $lietotajs->save();

        return redirect()->route('profils.show')
            ->with('success', 'Profils atjaunināts.');
    }

    public function destroy(Request $request)
    {
        $lietotajs = Auth::user()->load('cars.images');

        foreach ($lietotajs->cars as $masina) {
            foreach ($masina->images as $bilde) {
                Storage::disk('public')->delete($bilde->image_path);
            }
        }

        Auth::logout();
        $lietotajs->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('galerija')
            ->with('success', 'Tavs konts un visa kolekcija ir dzēsta.');
    }
}
