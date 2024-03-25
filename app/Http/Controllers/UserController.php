<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    public function register(Request $request)
    {
        //validate request data
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|',
            'country_currency' => 'string',
        ]);
        if ($validator->fails()) {
            return redirect('/register')->withErrors($validator->errors())->withInput();
        }
        //create new user and save it in the database
        $request['password'] = Hash::make($request['password']);
        $user = User::create($request->all());
        Mail::to($user->email)->send(new VerifyEmail($user->username));
        return view('home')->with('msg', "Your account has been created successfully. Please check your email to verify your account.");
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/login')->withErrors($validator->errors())->withInput();
        }

        if (Auth::attempt($request->only('username', 'password'))) {
            $request->session()->regenerate();
            return redirect('/verify');
        }
        return redirect('/login')->withErrors("The provided credentials do not match our records.")->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function verifyEmail(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $user->email_verified_at = now();
        $user->save();
        return redirect('/');
    }

    public function sendVerifyEmail(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        if ($user->email_verified_at != null) {
            return redirect('/')->with('msg', "Your account has already been verified.");
        }
        Mail::to($user->email)->send(new VerifyEmail($user->username));
        return redirect('/');
    }

    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return redirect('/forget')->withErrors($validator->errors())->withInput();
        }
        $status = Password::broker('users')->sendResetLink($request->only('email'));
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : redirect('/')->withErrors(['email' => __($status)]);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'password02' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return redirect('/reset')->withErrors($validator->errors())->withInput();
        }
        $status = Password::broker('users')->reset(
            $request->only('email', 'password', 'password02', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );
        return $status === Password::PASSWORD_RESET
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}

