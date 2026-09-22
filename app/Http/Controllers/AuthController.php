<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showRegisterForm() {
        return view('auth.register');
    }    

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' =>  ['required', Password::min(8)->mixedCase()]
        ], [
            'name.required' => 'nama harus diisi',
            'email.unique' => 'email sudah terpakai',
            'email.required' => 'email harus diisi'
        ]); 

        try {
            User::create($request->all());
            return redirect('/login');
        } catch (Exception $e) {
            report($e);
            return back();
        }

    }    

    public function showLoginForm() {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('auth.login');
    }    

    public function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('/');
        } else {
            return redirect('/login')->with('error', 'email atau password salah');
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

//
}
