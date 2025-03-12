<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
<<<<<<< HEAD
    
=======

        
>>>>>>> 3564f8aa615b12ed2a22b05693f9024994f54f82
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);
<<<<<<< HEAD
    
=======

>>>>>>> 3564f8aa615b12ed2a22b05693f9024994f54f82
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
<<<<<<< HEAD
    
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
=======

        $credentials = $request->only('email', 'password');

   
        if ($request->email === 'admin@gmail.com' && $request->password === 'admin1234') {
           
            $admin = User::updateOrCreate(
                ['email' => 'admin@gmail.com'],
                [
                    'name' => 'Administrator',
                    'password' => Hash::make('admin1234'),
                    'role' => 'admin',
                ]
            );

            Auth::login($admin);
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

  
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            
            if (optional(Auth::user())->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email/Password is wrong. Please, try again.',
        ])->withInput();
>>>>>>> 3564f8aa615b12ed2a22b05693f9024994f54f82
    }

    public function logout(Request $request)
    {
<<<<<<< HEAD
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
=======
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function adminDashboard()
    {
  
        if (!Auth::user() || ! optional(Auth::user())->isAdmin()) {
            return redirect()->route('dashboard');
        }

       
        $userCount = User::where('role', 'user')->count();

        return view('admin.dashboard', [
            'userCount' => $userCount,
        ]);
    }
>>>>>>> 3564f8aa615b12ed2a22b05693f9024994f54f82
}
