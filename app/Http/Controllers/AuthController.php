<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\TwilioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    protected $twilio;

    public function __construct(TwilioService $twilio)
    {
        $this->twilio = $twilio;
    }

    public function registView()
    {
        return view('auth.register');
    }

    public function loginView(Request $request)
    {
        return view('auth.login');
    }

    // authController.php

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'no_wa' => 'required|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->no_wa = $request->no_wa;
        $user->password = bcrypt($request->password);
        $user->save();

        $verificationCode = Str::random(6);

        // Log the generated verification code
        // \Log::info("Generated verification code for user {$user->id}: $verificationCode");

        $this->twilio->sendVerificationCode($request->no_wa, $verificationCode);

        // Save the verification code to the user's record
        $user->verification_code = $verificationCode;
        $user->save();

        return redirect()->route('verification.notice');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->with('failed', 'Login failed!!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function verifyView()
    {
        return view('auth.verify');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'no_wa' => 'required',
            'verification_code' => 'required',
        ]);

        $user = User::where('no_wa', $request->no_wa)->first();

        if ($user) {
            // Log the verification attempt
            // \Log::info("Verifying code for user {$user->id}: {$request->verification_code}");

            if ($user->verification_code === $request->verification_code) {
                $user->update(['email_verified_at' => now()]);
                Auth::login($user);

                return redirect()->route('home')->with('status', 'Your account has been verified.');
            }
        }

        // Log invalid verification
        // \Log::error('Invalid verification attempt', [
        //     'no_wa' => $request->no_wa,
        //     'submitted_code' => $request->verification_code,
        //     'stored_code' => $user ? $user->verification_code : 'User not found'
        // ]);

        return back()->withErrors(['verification_code' => 'The provided verification code is invalid.']);
    }
}
