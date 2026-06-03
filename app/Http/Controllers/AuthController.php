<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $dati = $request->validate([
            'nickname' => ['required', 'string', 'max:255', 'unique:users,nickname'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [], [
            'nickname' => 'lietotājvārds',
            'email'    => 'e-pasts',
            'password' => 'parole',
        ]);

        $lietotajaLoma = Role::firstOrCreate(
            ['name' => 'user'],
            ['description' => 'Reģistrēts lietotājs — pārvalda savu kolekciju un profilu']
        );

        $lietotajs = User::create([
            'nickname' => $dati['nickname'],
            'email'    => $dati['email'],
            'password' => $dati['password'],
            'role_id'  => $lietotajaLoma->id,
        ]);

        Auth::login($lietotajs);
        $request->session()->regenerate();

        return redirect()->route('mana.kolekcija')
            ->with('success', 'Konts izveidots. Laipni lūdzam HWCollect!');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $dati = $request->validate([
            'login'    => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $lauks = filter_var($dati['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'nickname';

        $akreditacija = [
            $lauks     => $dati['login'],
            'password' => $dati['password'],
        ];

        if (Auth::attempt($akreditacija, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('galerija'))
                ->with('success', 'Veiksmīga pieslēgšanās.');
        }

        return back()
            ->withInput($request->only('login'))
            ->with('error', 'Nepareizs lietotājvārds/e-pasts vai parole.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('galerija')
            ->with('success', 'Jūs esat izrakstījies.');
    }
}
