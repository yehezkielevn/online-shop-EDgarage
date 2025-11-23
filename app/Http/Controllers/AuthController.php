<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\LoginActivity;

class AuthController extends Controller
{
    // --- VIEW ---
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        return view('auth.login');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        return view('auth.register');
    }

    // --- PROCESS ---
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'nomor_hp'  => 'required|string|max:20', // Wajib ada
            'alamat'    => 'required|string',         // Wajib ada
            'password'  => 'required|confirmed|min:6',
        ]);

        // Cek Admin Pertama
        $isFirstAdmin = User::count() === 0;

        // Simpan User
        $user = User::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'nomor_hp'  => $validated['nomor_hp'],
            'alamat'    => $validated['alamat'],
            'password'  => Hash::make($validated['password']),
            'role'      => $isFirstAdmin ? 'admin' : 'user',
            'is_admin'  => $isFirstAdmin ? true : false,
        ]);

        // --- MODIFIKASI: JANGAN LOGIN OTOMATIS ---
        // Auth::login($user); <--- KITA HAPUS INI
        
        // Redirect ke Halaman Login dengan Pesan Sukses
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login dengan akun baru Anda.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Regenerate session ID untuk keamanan
            $request->session()->regenerate(); 
            
            $user = User::find(Auth::id());
            
            // Catat Log
            $this->logActivity($user);

            // Redirect sesuai role
            return $this->redirectBasedOnRole($user)->with('success', 'Berhasil login.');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Anda telah logout.');
    }

    // --- HELPER FUNCTIONS ---
    private function logActivity($user)
    {
        try {
            LoginActivity::create([
                'user_id'   => $user->id,
                'name'      => $user->name,
                'email'     => $user->email,
                'role'      => $user->role,
                'login_at'  => now(),
            ]);
        } catch (\Exception $e) {
            // Silent fail
        }
    }

    private function redirectBasedOnRole($user = null)
    {
        $user = $user ?? Auth::user();

        // Logika Cek Admin yang Kuat
        if ($user->is_admin || strtolower(trim($user->role)) === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');
    }
}