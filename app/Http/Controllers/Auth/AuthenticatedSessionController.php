<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show the login form.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login submission with role-based validation.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Capture the role from the tab
        $selectedRole = $request->input('role');  // 'admin', 'student', 'teacher'

        // Authenticate the user (this only checks email/password)
        $request->authenticate();

        // Regenerate session
        $request->session()->regenerate();

        $user = Auth::user();

        // Match the tab role to the user's role from DB
        if (
            ($selectedRole === 'admin' && $user->role != 1) ||
            ($selectedRole === 'teacher' && $user->role != 2) ||
            ($selectedRole === 'student' && $user->role != 3)
        ) {
            Auth::logout(); // Force logout if mismatch
            return back()->withErrors([
                'email' => 'You selected the wrong login portal for your account.',
            ]);
        }

        // Role-based redirect
        switch ($user->role) {
            case 1:
                return redirect()->route('dashboard');            // Admin
            case 2:
                return redirect()->route('teachers-dashboard');   // Teacher
            case 3:
                return redirect()->route('students-dashboard');   // Student
            default:
                return redirect()->route('landingpage');          // Unknown role fallback
        }
    }

    /**
     * Logout the user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
