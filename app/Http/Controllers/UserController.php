<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function profile_index()
  {
    $this->data['title'] = 'Profile';
    $this->data['user'] = auth()->user();
    return view('pages.dashboard.profile', $this->data);
  }

  public function profile_update(Request $request)
  {
    $user = User::find(auth()->id());
    $validatedData = $request->validate([
      'name' => 'required|string|max:255',
      'username' => "required|string|max:255|unique:users,username,$user->id",
    ], [
      'name.required' => 'Nama harus diisi.',
      'username.required' => 'Username harus diisi.',
      'username.unique' => 'Username sudah terdaftar.',
    ]);

    $user->update($validatedData);

    session()->flash('success', 'Profile updated successfully.');
    return redirect()->route('dashboard.profile.index');
  }

  public function profile_updatepassword(Request $request)
  {
    $user = User::find(auth()->id());
    $validatedData = $request->validate([
      'old_password' => 'required|string|min:8',
      'new_password' => 'required|string|min:8',
      'confirm_password' => 'required|string|min:8|same:new_password',
    ], [
      'old_password.required' => 'Password lama harus diisi.',
      'old_password.min' => 'Password lama minimal 8 karakter.',
      'new_password.required' => 'Password baru harus diisi.',
      'new_password.min' => 'Password baru minimal 8 karakter.',
      'confirm_password.required' => 'Konfirmasi password baru harus diisi.',
      'confirm_password.min' => 'Konfirmasi password baru minimal 8 karakter.',
      'confirm_password.same' => 'Konfirmasi password baru tidak sama dengan password baru.',
    ]);

    if (!Hash::check($validatedData['old_password'], $user->password)) {
      return back()->withErrors(['old_password' => 'Password lama tidak sesuai.']);
    }

    $user->update(['password' => Hash::make($validatedData['new_password'])]);

    session()->flash('success', 'Password updated successfully.');
    return redirect()->route('dashboard.profile.index');
  }
}
