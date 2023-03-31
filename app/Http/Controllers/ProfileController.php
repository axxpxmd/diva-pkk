<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// Models
use App\Models\User;
use Illuminate\Foundation\Auth\User as IlluminateUser;

class ProfileController extends Controller
{
    protected $title = 'Profile';
    protected $desc  = 'Menu ini berisikan informasi akun pengguna';
    protected $active_profile = true;

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_profile = $this->active_profile;

        if ($request->ajax()) {
            return $this->dataTable();
        }

        $user = User::find(Auth::user()->id);

        //* Get first letter form full name
        $words = explode(" ", $user->nama);
        $acronym = "";

        foreach ($words as $w) {
            $acronym .= $w[0];
        }

        return view('pages.profile.index', compact(
            'title',
            'desc',
            'active_profile',
            'user',
            'acronym'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required|digits:16|unique:users,nik,' . $id,
            'no_telp' => 'required',
            'alamat' => 'required'
        ]);

        $input = $request->all();
        $data = User::find($id);
        $data->update($input);

        return redirect()
            ->route('profile.index')
            ->withSuccess('Selamat! Data berhasil diperbaharui.');
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password'
        ]);

        $data = User::find($id);
        $data->update([
            'password' => \md5($request->password)
        ]);

        return redirect()
            ->route('profile.index')
            ->withSuccess('Selamat! Password berhasil diperbaharui.');
    }

    public function updatePhoto(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        $data = User::find($id);

        // Saved Photo to Storage
        $file     = $request->file('foto');
        $fileName = time() . "." . $file->getClientOriginalName();
        $request->file('foto')->storeAs('foto_profile/', $fileName, 'sftp', 'public');

        // Delete old Photo from Storage
        $exist = $data->foto;
        Storage::disk('sftp')->delete('foto_profile/' . $exist);

        $data->update([
            'foto' => $fileName
        ]);

        return redirect()
            ->route('profile.index')
            ->withSuccess('Selamat! Foto berhasil diperbaharui.');
    }

    public function resetPassword($username)
    {
        $data = User::where('username', $username)->first();
        $data->update([
            'password' => \md5('123456789')
        ]);

        return redirect()->back()->withSuccess("Password telah direset menjadi 123456789");
    }
}
