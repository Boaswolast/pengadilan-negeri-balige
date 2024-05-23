<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    // protected function attemptLogin(Request $request)
    // {
    //     $credentials = $this->credentials($request);
    //     $credentials['is_active'] = 0;

    //     return Auth::attempt($credentials, $request->filled('remember'));
    // }
    protected function attemptLogin(Request $request)
    {
        $this->validateLogin($request);

        $credentials = $this->credentials($request);

        if (!Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'is_active' => 0], $request->filled('remember'))) {
            $user = \App\Models\User::where('email', $credentials['email'])->first();

            if (!$user) {
                return $this->sendFailedLoginResponse($request, 'email', 'Email belum terdaftar.');
            }

            if (!\Hash::check($credentials['password'], $user->password)) {
                return $this->sendFailedLoginResponse($request, 'password', 'Password salah.');
            }

            return $this->sendFailedLoginResponse($request);
        }

        return true;
    }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string|min:6',
        ], [
            'required' => 'Pastikan Email atau Password anda benar dan sudah terdaftar',
            'string' => 'Pastikan Email atau Password anda benar dan sudah terdaftar',
            'min' => 'Pastikan Email atau Password anda benar dan sudah terdaftar',
        ]);
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('check.is_active')->only('login');
    }

    protected function sendFailedLoginResponse(Request $request, $field = 'email', $message = null)
    {
        $message = $message ?: 'Email atau password yang Anda masukkan salah.';

        throw ValidationException::withMessages([
            $field => [$message],
        ]);
    }
}
