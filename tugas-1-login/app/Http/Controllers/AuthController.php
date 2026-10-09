<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showlogin(){
        return view('login');
    }

    public function login(Request $request){
        //validasi inpt
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // Cek username & password (Password otomatis dicocokkan dengan Bcrypt hash)
        if (Auth::attempt($credentials)) {
            // Regenerasi session untuk mencegah serangan Session Fixation
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');

    }
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    
}
