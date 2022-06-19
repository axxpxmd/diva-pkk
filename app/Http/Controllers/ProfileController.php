<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\User;

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
}
