<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        
        return auth()->user() == null ? view('auth.register') : redirect()->route('dashboard');

    }
    
    public function store(StoreUserRequest $request)
    {
        // Create the user with the additional fields
        $user = User::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number, // Store phone number
            'designation' => $request->designation,   // Store designation
            'dob' => $request->dob,                   // Store date of birth
            'gender' => $request->gender,             // Store gender
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password before storing
        ]);

        $user->assignRole('teacher');

        // Fire the Registered event after the user is created
        event(new Registered($user));

        Auth::login($user);

        // Redirect to the intended route (home or dashboard)
        return redirect()->route('dashboard');
    }

    /**
     * Step 1: Initiate OTP login
     */
    public function sendOtp(Request $request)
    {
        // Validate email input
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
    
        // Retrieve the user from the database
        $user = User::where('email', $request->email)->first();
    
        // Generate a numeric OTP (e.g., 6 digits)
        $otp = rand(100000, 999999);
    
        // Set OTP expiry (e.g., 10 minutes)
        $otpExpiry = Carbon::now()->addMinutes(10);
    
        // Save OTP and expiry to the user's record
        $user->otp = $otp;
        $user->otp_expiry = $otpExpiry;
        $user->save();
    
        // Send OTP via email using a dedicated Mailable
        Mail::to($user->email)->send(new OtpMail($otp));
    
        // Store a session flag indicating that the OTP has been sent
        Session::put('email', $user->email);
        Session::put('otp_sent', true);
    
        // Return the response (optional: you could redirect instead of returning a JSON response)
        return redirect()->back()->with('status', 'OTP sent to your email address.');
    }

    /**
     * Step 2: Verify OTP entered by user
     */
    public function verifyOtp(Request $request)
    {
        // Validate OTP and email input
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);
    
        $email = Session::get('email');

        // Retrieve the user from the database
        $user = User::where('email', $email)->first();
    
        // Check if the OTP exists and hasn't expired
        if ($user->otp === $request->otp && Carbon::now()->lessThanOrEqualTo($user->otp_expiry)) {
            // OTP is valid, log the user in
            Auth::login($user);
    
            // Clear OTP and expiry from the user's record
            $user->otp = null;
            $user->otp_expiry = null;
            $user->save();
    
            // Remove OTP sent session flag
            Session::forget('email');
            Session::forget('otp_sent');
    
            // Redirect user to dashboard or intended route
            return redirect()->route('dashboard')->with('status', 'Login successful!');
        }
    
        // OTP is invalid or expired
        return back()->withErrors(['otp' => 'Invalid OTP or OTP has expired.']);
    }
}
