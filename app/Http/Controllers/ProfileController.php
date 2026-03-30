<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Rating;
use App\Models\User;
use File;
use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function userProfile()
    {
        $user = auth()->user();
        $rating = Rating::where('given_to', $user->id)->get();
        $totalRating = Rating::where('given_to', $user->id)->count();
        $avgRating = Rating::where('given_to', $user->id)->avg('rating');
        return view('profile.profile', compact('user', 'avgRating', 'totalRating', 'rating'));
    }
    /**
     * Display the user's profile form.
     */
    public function showEdit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $req, $id)
    {
        if (auth()->user()->id != $id) {
            return back()->with('error', 'Unothorise Access!');
        }

        //find user
        $user = User::findOrFail($id);

        $req->validate([
            'name' => 'required|',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        //image
        $file = $req->file('image');
        $imageName = '';
        if ($file) {
            $imageName = time() . '.' . $file->extension();
            $file->move(public_path('userImages'), $imageName);
        } else if ($user->image) {
            $imageName = $user->image;
        }

        //license and vehicle no
        if (!$req->license_no)
            $req->license_no = "";
        if (!$req->vehicle_no)
            $req->vehicle_no = "";

        $user->update([
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'license_no' => $req->license_no,
            'vehicle_no' => $req->vehicle_no,
            'image' => $imageName
        ]);

        $user->save();
        return redirect('profile')->with('success', 'Profile Updated Successfully!');
    }

    //Change Password page
    public function showChangePassword()
    {
        return view('profile.showChangePass');
    }

    //save new Password
    public function savePassword(Request $req)
    {
        $req->validate([
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|min:6',
        ]);

        if ($req->new_password != $req->confirm_password) {
            return back()->with('errorpass', 'New password and confirm password do not match');
        }

        $user = auth()->user();

        if (Hash::check($req->confirm_password, $user->password)) {
            return back()->with('errorpass', 'Please Enter New Password, it is Your Old Password.');
        }
        if (!Hash::check($req->current_password, $user->password)) {
            return back()->with('incorrect', 'Current password is incorrect');
        }
        else{
            $user->password = Hash::make($req->confirm_password);
            $user->save();
        }
        return redirect('profile')->with('success', 'Password Changed Successfully!');
    }
}
