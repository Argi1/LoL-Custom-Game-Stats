<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;

class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }  
      
    public function authenticate(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt(['name' => $credentials['name'], 'password' => 'a', 'first_signin' => 1])) {
            // First time login 
            $user = User::firstWhere('name', $credentials['name']);
            $user->password = Hash::make($credentials['password']);
            $user->first_signin = 0;
            $user->save();
            return redirect()->intended('/admin/game')->withSuccess('Signed in');
        }
        elseif (Auth::attempt(['name' => $credentials['name'], 'password' => $credentials['password'], 'first_signin' => 0])) {
            // Authentication passed...
            return redirect()->intended('/admin/game')->withSuccess('Signed in');
        }
        
        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function signOut(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
  
        return redirect('/');
    }
}
