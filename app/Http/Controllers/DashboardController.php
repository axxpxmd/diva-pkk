<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Kecamatan;

class DashboardController extends Controller
{
    protected $title = 'Dashboard';
    protected $active_dashboard = true;

    public function index(Request $request)
    {
        $title = $this->title;
        $active_dashboard = $this->active_dashboard;

        $tahun = $request->tahun;
        $kecamatan_id = $request->kecamatan_id;
        $kelurahan_id = $request->kelurahan_id;
        $rtrw_id = $request->rtrw_id;

        $kecamatans = Kecamatan::select('id', 'n_kecamatan')->where('kabupaten_id', 40)->get();

        return view('pages.dashboard.index', compact(
            'title',
            'active_dashboard',
            'kecamatans',
            'tahun', 
            'kecamatan_id',
            'kelurahan_id',
            'rtrw_id'
        ));
    }
}
