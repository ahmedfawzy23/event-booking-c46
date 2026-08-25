<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);

        $otp = rand(100000, 999999);
        Otp::create([
            'user_id' => $user->id,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(10),
        ]);
        Mail::to($user->email)->send(new OtpMail($otp));

        return response()->json([
            'message' => 'User Registerd Succssfully',
            'user' => $user,
        ], 201);
    }

    public function resendOtp(User $user)
    {
        $otp = $user->otp;
        $allowedResend = $otp?->updated_at?->addMinutes(1) ?? now()->subMinute();
        if (!$otp || $otp->expires_at < now() || $allowedResend < now()) {
            // dd($allowedResend);
            $newOtp = rand(100000, 999999);
            Otp::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'otp' => $newOtp,
                    'expires_at' => now()->addMinutes(10),
                ]
            );
            Mail::to($user->email)->send(new OtpMail($newOtp));

            return response()->json([
                'message' => 'OTP Resend Successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'You can resend OTP after ' . $allowedResend->diffForHumans(),
            ], 400);
        }
    }
    public function verifyOtp(Request $request, User $user)
    {
        $otp = $user->otp;
        $validated = $request->validate([
            'otp' => 'required',
        ]);
        if (!$otp || $otp->expires_at < now() || $otp->otp !== $validated['otp']) {
            return response()->json([
                'message' => 'Invalid OTP',
            ], 401);
        }

        $user->update([
            'email_verified_at' => now(),
        ]);
        $otp->delete();

        return response()->json([
            'message' => 'Email Verified Successfully',
        ], 200);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $validated['email'])->first();

        if (!$user || !auth()->attempt($validated)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        } else if (!$user->email_verified_at) {
            return response()->json([
                'message' => 'Please verify your email',
            ], 401);
        }

        $token = $user->createToken('auth_token', ['*'], now()->addMinutes(60))->plainTextToken;


        return response()->json([
            'message' => 'User Login Successfully',
            'user' => $user,
            'token' => $token,
        ], 200);
    }
}
