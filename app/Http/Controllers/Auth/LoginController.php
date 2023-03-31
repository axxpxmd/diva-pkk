<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

// Models
use App\Models\User;
use App\Models\MappingRT;
use App\Models\MappingRW;
use App\Models\ModelHasRole;

class LoginController extends Controller
{
    public function index()
    {
        $url = url()->full();
        $text = config('app.check_url');

        $check_url = Str::contains($url, [$text]);

        if ($check_url) {
            return view('auth.login2');
        } else {
            return view('auth.login2');
        }
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
                $rt = MappingRT::where('nik', $request->username)->where('status', 1)->first();
                $rw = MappingRW::where('nik', $request->username)->where('status', 1)->first();

                if ($rt && $rw) {
                    $validator->errors()->add('user', 'Silahkan nonaktifkan salah satu akun.');
                } else {
                    // check RT
                    if ($rt) {
                        ModelHasRole::where('model_id', $user->id)->delete();

                        $model_has_role = new ModelHasRole();
                        $model_has_role->role_id    = 3;
                        $model_has_role->model_type = 'app\Models\User';
                        $model_has_role->model_id   = $user->id;
                        $model_has_role->save();
                    }
                    // check RW
                    if ($rw) {
                        ModelHasRole::where('model_id', $user->id)->delete();

                        $model_has_role = new ModelHasRole();
                        $model_has_role->role_id    = 4;
                        $model_has_role->model_type = 'app\Models\User';
                        $model_has_role->model_id   = $user->id;
                        $model_has_role->save();
                    }
                }
            }

            Auth::login($user, $request->remember);
            return redirect(route('dashboard'));
        }

        if ($type == 2) {
            return redirect('/loginpengajuanrt')
                ->withErrors($validator)
                ->withInput();
        } else {
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function logout(Request $request)
    {
        $role_id = Auth::user()->modelHasRole->role_id;

        if ($role_id == 3 || $role_id == 4 || $role_id == 5 || $role_id == 6 || $role_id == 10) {
            Auth::logout();
            return redirect('/loginpengajuanrt');
        } else {
            Auth::logout();
            return redirect('/login');
        }
    }
}
