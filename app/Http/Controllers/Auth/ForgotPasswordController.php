<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Password_reset_tokens;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('Auth.forgot-password');
    }

    //send mail link
    public function sendResetLinkEmail(Request $req)
    {
        $req->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink(
            $req->only('email')
        );

        return back()->with('success', __($status));
    }

    //show reset password page
    public function showResetForm($token)
    {
        return view('auth.reset-password', compact('token'));
    }

    public function reset(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'token' => 'required'
        ]);

        $status = Password::reset(
            $req->only('email', 'password', 'password_cofirmed', 'token'),
            function($user, $password){
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return redirect()->route('login')->with('success', __($status));
    }
}
