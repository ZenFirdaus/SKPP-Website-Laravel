<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Validasi email sesuai role
            if ($user->role === 'staff' && $user->email !== env('STAFF_EMAIL')) {
                Auth::logout();
                return back()->withErrors(['email' => 'Email tidak diizinkan untuk role staff.']);
            }

            if ($user->role === 'kepala' && $user->email !== env('KEPALA_EMAIL')) {
                Auth::logout();
                return back()->withErrors(['email' => 'Email tidak diizinkan untuk role kepala.']);
            }

            return $this->redirectByRole($user->role);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    protected function redirectByRole(string $role)
    {
        return match ($role) {
            'staff'  => redirect()->route('mitra.dashboard'), // staff tetap diarahkan ke dashboard mitra
            'kepala' => redirect()->route('kepala.pengecekan.index'),
            default  => redirect()->route('mitra.dashboard'),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}