<?php

namespace App\Http\Controllers;

use App\helper\JWTToken;
use App\Mail\OtpMail;
use App\Models\User;
use cache;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function registration(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|min:12|max:25|unique:users',
                'password' => 'required|min:3|max:5'
            ]);

            $name = $request->name;
            $email = $request->email;
            $password = $request->password;

            User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password
            ]);
            return response()->json([
                'status' => 'success',
                'msag' => 'Created'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'msag' => $e->getMessage()
            ]);
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:3|max:5'
            ]);
            // dd('ss');
            $email = $request->email;
            $password = $request->password;
            $user = User::where('email', $email)->where('password', $password)->first();
            // dd($user);
            if ($user) {
                // dd($user);
                $token = JWTToken::CreateToken($user->email, $user->id);
                return response()->json([
                    'status' => 'success',
                    'msag' => 'login successfull',
                ])->cookie('token', $token, 60 * 60 * 24);
            } else {
                // return '';
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Email and password does not exist'
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function logout()
    {
        return redirect('/login')->cookie('token', null, -1);
    }

    public function sendOtp(Request $request)
    {
        try {
            $email = $request->email;
            $otp = rand(1000, 9999);
            $user = User::where('email', $email)->first();

            if ($user) {
                Mail::to($email)->send(new OtpMail($otp));
                User::where('email', $email)->update(['otp' => $otp]);

                return response()->json([
                    'status' => 'success',
                    'msag' => 'OTP has been send in your mail'
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'msag' => $e->getMessage()
            ]);
        }
    }

    public function verifyOtp(Request $request)
    {
        try {
            $email = $request->email;
            $otp = $request->otp;

            $user = User::where('email', $email)->where('otp', $otp)->first();

            if ($user) {
                User::where('email', $email)->where('otp', $otp)->update(['otp' => '0']);
                $token = JWTToken::CreateToken($user->email, $user->id);
                return response()->json([
                    'status' => 'success',
                    'msag' => 'OTP has been verifyed successfully'
                ])->cookie('token', $token, 3600);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'msag' => $e->getMessage()
            ]);
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            $email = $request->header('email');
            $password = $request->password;

            User::where('email', $email)->update(['password' => $password]);

            return response()->json([
                'status' => 'success',
                'msag' => 'password changed successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage()
            ]);
        }
    }
}
