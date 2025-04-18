<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserAuthRequest;
use Masmerise\Toaster\Toaster;

class AuthController extends Controller
{
    protected array $roles = [
        'admin' => UserRole::admin,
        'guru' => UserRole::guru,
        'siswa' => UserRole::siswa
    ];

    public function index() {
        return view('auth.login');
    }

    public function verify(UserAuthRequest $request) {
        $input = $request->input('text');
        $password = $request->validated()['password'];

        $response = filter_var($input, FILTER_VALIDATE_EMAIL)
            ? $this->loginWithEmail($input, $password, $request)
            : $this->loginWithUsername($input, $password, $request);
        
        if ($response) {
            return $response;
        }
        Toaster::error('Login Gagal');
        return redirect(route('login'));
    }

    private function loginWithUsername($username, $password, Request $request) {
        // dd('login with username', $username);
        foreach ($this->roles as $guard => $role) {
            if (Auth::guard($guard)->attempt([
                'username' => $username,
                'password' => $password,
                'role' => $role
            ])) {
                $request->session()->regenerate();
                return redirect()->intended(route("$guard.dashboard"));
            }
        }
        return null;
    }

    private function loginWithEmail($email, $password, Request $request) {
        // dd('login with email', $email);
        foreach ($this->roles as $guard => $role) {
            if (Auth::guard($guard)->attempt([
                'email' => $email,
                'password' => $password,
                'role' => $role
            ])) {
                $request->session()->regenerate();
                return redirect()->intended(route("$guard.dashboard"));
            }
        }
        return null;
    }

    public function logout() {
        foreach (array_keys($this->roles) as $guard) {
            if (Auth::guard(Str::lower($guard))->check()) {
                Auth::guard(Str::lower($guard))->logout();
                break;
            }
        }
        return redirect(route('login'));
    }
}
