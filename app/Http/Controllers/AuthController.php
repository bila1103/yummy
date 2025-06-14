<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function show()
  {
    return view('pages.auth.register');
  }
  public function register(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'username' => 'required|string|max:255|unique:users',
      'password' => 'required|string|min:6',

    ]);


   $user = User::create([
      'name' => $validated['name'],
      'username' => $validated['username'],
      'password' => Hash::make($validated['password']),
      'is_verified' => 0,
    ]);
       
    return redirect('/auth/login')->with('success', 'Akun berhasil dibuat!');

  }
  // Login Page
  public function login()
  {
    if (Auth::check()) {
      return redirect('dashboard');
    }
    $this->data['title'] = 'Login';
    return view('pages.auth.login', $this->data);
  }



  // Authentication
  public function authenticate(Request $request)
  {
    $credentials = $request->validate(
      [
        'username' => 'required|string',
        'password' => 'required|string'
      ],
      [
        'username.required' => 'Username is required',
        'password.required' => 'Password is required'
      ]
    );

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return redirect('dashboard')->with('success', "You're Logged in");
    }

    session()->flash('error', 'Your Credentials Are Wrong');
    return back();
  }
  // Query untuk mengambil data pada tabel user
  // SELECT * FROM users WHERE username = ? LIMIT 1;

  // Logout
  public function logout()
  {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();

    session()->flash('success', 'Logout Success');
    return redirect()->route('login');
  }
}
