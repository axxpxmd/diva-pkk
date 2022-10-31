<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

// Models
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function index2()
    {
        return view('auth.login2');
    }

    public function login(Request $request)
    {
        $type = $request->type;

        $validator = Validator::make($request->all(), [
            'username' => 'required|max:30',
            'password' => 'required|max:30'
        ]);

        $user = User::whereusername($request->username)
            ->wherepassword(md5($request->password))
            ->first();

        if (!$user) {
            $validator->errors()->add('user', 'Username atau password tidak ditemukan.');
        } else {
            if ($user->s_aktif != 1) {
                $validator->errors()->add('user', 'Akun pengguna sudah tidak aktif.');
            } else {
                Auth::login($user, $request->remember);
                return redirect(route('dashboard'));
            }
        }

        if ($type == 2) {
            return redirect('/login2')
                ->withErrors($validator)
                ->withInput();
        } else {
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
