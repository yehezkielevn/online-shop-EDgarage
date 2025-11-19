<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ================================
    // SHOW LOGIN
    // ================================
    public function showLogin()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect('/admin/dashboard');
            }
            return redirect('/');
        }

        return redirect()->route('home', ['login' => 1]);
    }

    // ================================
    // SHOW REGISTER
    // ================================
    public function showRegister()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect('/admin/dashboard');
            }
            return redirect('/');
        }

        return view('auth.register');
    }

    // ================================
    // REGISTER USER / ADMIN PERTAMA
    // ================================
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nomor_hp' => 'nullable|string|max:20',
            'password' => 'required|confirmed|min:6',
        ]);

        // User pertama otomatis admin
        $isFirstAdmin = User::where('role', 'admin')->count() === 0;

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'nomor_hp' => $validated['nomor_hp'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => $isFirstAdmin ? 'admin' : 'user',
        ]);

        // Login otomatis setelah register
        Auth::login($user);
        $request->session()->regenerate();

        // Jika admin pertama → dashboard
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard')
                ->with('success', 'Akun admin berhasil dibuat. Selamat datang, ' . $user->name . '!');
        }

        // Selain itu → ke homepage
        return redirect()->route('home')
            ->with('success', 'Pendaftaran berhasil! Selamat datang, ' . $user->name . '!');
    }

    // ================================
    // LOGIN
    // ================================
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Admin → dashboard
            if (Auth::user()->role === 'admin') {
                return redirect('/admin/dashboard')
                    ->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
            }

            // User → homepage
            return redirect()->route('home')
                ->with('success', 'Berhasil login sebagai pengguna.');
        }

        return redirect()->route('home')
            ->withErrors(['email' => 'Email atau password salah.'])
            ->withInput($request->only('email'))
            ->with('open_login', true);
    }

    // ================================
    // LOGOUT
    // ================================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
