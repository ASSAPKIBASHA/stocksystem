<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function showRegister(){
        return view('auth.register');
    }


    public function register(Request $request){
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
             'email' => 'required|email|unique:users'
        ]);

        $user = User::create([
            'username' =>$validated['username'],
             'email' => $validated['email'],
            'password' => Hash::make($validated['password'])

        ]);
        $user->save();

        return redirect()->route('login.show')->with('success', 'registration successfully done');
       
    
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'email' => 'required|email'
        ]);
        if(auth()->attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success','logged in');
        }


        return back()->withErrors([
            'username' => 
            'the provided username does not meet our records'
        ]);
       
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regerateToken();
        return redirect('/');
    }
}
