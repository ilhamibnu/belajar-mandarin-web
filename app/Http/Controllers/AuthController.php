<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function postlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password wajib diisi'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('/admin/dashboard')->with('login', 'Login berhasil');
        }

        return redirect('/admin/login')->with('logingagal', 'Login gagal, email atau password salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login')->with('logout', 'Logout berhasil');
    }
}
