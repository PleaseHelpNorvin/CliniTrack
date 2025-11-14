<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    //
    public function confirmPasswordForm()   
    {
        return view('admin_pages.settings_pages.confirm_password');
    }

    /**
     * Check if the entered password is correct.
     */
    public function checkPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        if (!Hash::check($request->password, $request->user()->password)) {
            return back()->withErrors(['password' => 'Incorrect password']);
        }

        // Mark the password as confirmed in session
        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->route('admin.settings.index');
    }

    /**
     * Show the settings page (profile/forms) after password confirmed.
     */
    public function index()
    {
        return view('admin_pages.settings_pages.index'); // your forms/settings page
    }

    /**
     * Update profile info (name, email)
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('name', 'email'));

        return back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Update password
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Incorrect current password']);
        }

        $user->password = $request->new_password;
        $user->save();

        return back()->with('success', 'Password changed successfully.');
    }
}
