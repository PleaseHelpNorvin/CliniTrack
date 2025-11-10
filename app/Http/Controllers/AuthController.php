<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Services\ActivityLogService;
use App\Constants\ActivityActions; 


class AuthController extends Controller
{
    //
    public function index()
    {
        return view ('auth.login');    
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->with('error', 'Invalid email or password');
        }

        Auth::login($user);
        ActivityLogService::log(ActivityActions::LOGIN);

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'nurse' => redirect()->route('nurse.dashboard'),
            'staff' => redirect()->route('staff.dashboard'),
            default => redirect('/'),
        };
    }

    public function logout(Request $request)
    {   
        // use case:
        // <form method="POST" action="{{ route('logout') }}">
        //     @csrf
        //     <button type="submit" class="btn btn-danger">Logout</button>
        // </form>        
        // Logout user

        ActivityLogService::log(ActivityActions::LOGOUT);

        Auth::logout();

        // Invalidate session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out.');
    }

}
