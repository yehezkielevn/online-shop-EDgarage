<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // 1. TAMPILKAN HALAMAN PROFIL
    public function index()
    {
        $user = Auth::user();
        // Ambil riwayat transaksi user
        $transactions = $user->transactions()->with('product')->latest()->get();
        
        return view('user.profile', compact('user', 'transactions'));
    }

    // 2. UPDATE DATA PROFIL
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'nomor_hp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update Foto jika ada upload baru
        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada (selain default)
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            // Simpan foto baru
            $path = $request->file('foto_profil')->store('profiles', 'public');
            $user->foto_profil = $path;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->nomor_hp = $request->nomor_hp;
        $user->alamat = $request->alamat;
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // 3. GANTI PASSWORD
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah!']);
        }

        Auth::user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password berhasil diganti!');
    }

    // 4. HAPUS AKUN (Fitur Tambahan)
    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        // Hapus foto profil fisik agar tidak nyampah
        if ($user->foto_profil) {
            Storage::disk('public')->delete($user->foto_profil);
        }

        // Logout & Hapus
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Akun Anda telah dihapus permanen.');
    }
}