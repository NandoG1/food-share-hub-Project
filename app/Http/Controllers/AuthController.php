<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);
    
        Auth::login($user);
    
        return redirect()->route('dashboard-user')->with('success', 'Registration successful!');
    }


    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        $credentials = $request->only('email', 'password');
        
        if (!Auth::attempt($credentials, $request->filled('remember'))) {
            return back()->withErrors([
                'email' => 'Email/Password salah. Coba lagi.',
            ])->withInput();
        }
    
        // **Pastikan user benar-benar sudah login**
        $user = Auth::user();
        if (!$user) {
            return back()->withErrors(['email' => 'Login gagal, coba lagi.']);
        }
    
        return $user->role == 'admin'
            ? redirect()->route('dashboard-admin')
            : redirect()->route('dashboard-user');
    
        // return back()->withErrors([
        //     'email' => 'Email/Password salah. Coba lagi.',
        // ])->withInput();
    }

    public function logout(Request $request)
    {
         if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return redirect()->route('login');
    }

    // public function dashboard()
    // {
    //     return view('dashboard');
    // }
}
