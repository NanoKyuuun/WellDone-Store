<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registView()
    {
        return view('auth.register');
    }
    public function loginView(Request $request)
    {
        return view('auth.login');
    }
    public function register(Request $request)
    {
        // dd($request);
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'no_wa' => 'required|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);

        // Membuat pengguna baru

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->no_wa = $request->no_wa;
        $user->password = bcrypt($request->password);
        $user->save();


        // Otomatis login setelah registrasi (opsional)

        // Redirect ke halaman dashboard atau halaman lain setelah registrasi
        return redirect('/login');
    }

    public function login(Request $request)
    {
        // dd($request);
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->with('failed', 'Login failed!!');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}