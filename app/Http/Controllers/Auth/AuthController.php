<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        
        return view('auth.login');
    }

    /**
     * Handle login attempt
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            // Update last login timestamp
            Auth::user()->update(['last_login_at' => now()]);

            // Redirect based on user role
            return $this->redirectBasedOnRole(Auth::user());
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'You have been logged out successfully.');
    }

    /**
     * Show registration form (admin only in production)
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle registration
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,aggregator,farmer',
            'depot_id' => 'nullable|exists:depots,id',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'depot_id' => $validated['depot_id'] ?? null,
        ]);

        Auth::login($user);

        return $this->redirectBasedOnRole($user);
    }

    /**
     * Redirect user based on their role
     */
    private function redirectBasedOnRole(User $user)
    {
        switch ($user->role) {
            case User::ROLE_ADMIN:
                return redirect()->route('dashboard')->with('success', 'Welcome back, Administrator!');
            case User::ROLE_AGGREGATOR:
                return redirect()->route('dashboard')->with('success', 'Welcome back, Aggregator!');
            case User::ROLE_FARMER:
                // Check if farmer profile is complete
                if (!$user->farmer) {
                    return redirect()->route('farmers.create')->with('info', 'Please complete your farmer profile.');
                }
                return redirect()->route('dashboard')->with('success', 'Welcome back!');
            default:
                return redirect()->route('dashboard');
        }
    }

    /**
     * Show forgot password form
     */
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle forgot password
     */
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // In a real application, you would send a password reset email
        // For now, we'll just return a success message
        
        return back()->with('success', 'Password reset link sent to your email address.');
    }
}