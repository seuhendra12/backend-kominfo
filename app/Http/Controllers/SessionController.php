<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Iluminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use App\Models\LoginHistory;
use App\Models\User;

class SessionController extends Controller
{
  public function index()
  {
    return view("login.index");
  }
  public function login(Request $request)
  {

    $request->validate(
      [
        'email' => 'required',
        'password' => ['required', 'string', Password::min(8)
          ->mixedCase()
          ->letters()
          ->numbers()
          ->symbols()],
        'captcha' => 'required|captcha'
      ],
      [
        'email.required' => 'Email wajib diisi',
        'password.required' => 'Password wajib diisi'
      ]
    );

    $infologin = [
      'email' => $request->email,
      'password' => $request->password,
    ];

    $user = User::where('email', $infologin['email'])->first();

    if ($user && $user->is_active == 1 && Auth::attempt($infologin)) {
      $user = Auth::user();

      $history = LoginHistory::create([
        'user_id' => $user->id,
        'ip_address' => $request->ip(),
        'user_agent' => $request->header('User-Agent'),
      ]);

      if ($history) {
        return redirect()->intended('/');
      } else {
        return redirect()->back()->withErrors([
          'email' => 'Failed to save login history.',
        ]);
      }
    } else if ($user && $user->is_active == 0) {
      $request->session()->put('email', $request->input('email'));
      return back()->with('errorLogin', 'Your account is not active !');
    } else {
      $request->session()->put('email', $request->input('email'));
      return back()->with('errorLogin', 'Email or password invalid !');
    }
  }
  public function reloadCaptcha()
  {
    return response()->json(['captcha' => captcha_img()]);
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
  }
}
