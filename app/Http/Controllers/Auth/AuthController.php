<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view("Auth.register");
    }

    public function saveRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => '',
            'license_no'=>'',
            'vehicle_no'=>'',
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registration Successful!');
    }

    public function showLogin()
    {
        return view('Auth.login');
    }

    public function saveLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $emailFound = User::where('email',$request->email)->count();
        if($emailFound == 0){
            return back()->with('error', 'Email Not Found Please Register!');
        }
        if(!Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return back()->with('error', 'Invalid Password!');
        }

        if (Auth::attempt(['email'=>$request->email,'password'=> $request->password])) {
            return redirect('/dashboard')->with('success', 'Login Succesfully!');
        }
        return back()->with('error', 'Invalid Credentials');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
