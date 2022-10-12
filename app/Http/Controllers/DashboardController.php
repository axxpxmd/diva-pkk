<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\RTRW;

class DashboardController extends Controller
{
    protected $title = 'Dashboard';
    protected $active_dashboard = true;

    public function index(Request $request)
    {
        $title = $this->title;
        $active_dashboard = $this->active_dashboard;

        $kecamatans = Kecamatan::select('id', 'n_kecamatan')->where('kabupaten_id', 40)->get();

        //* Filter
        $tahun   = $request->tahun;
        $rtrw_id = $request->rtrw_id;
        $kecamatan_id = $request->kecamatan_id;
        $kelurahan_id = $request->kelurahan_id;

        $rtrw = RTRW::find($rtrw_id);
        $kecamatan = Kecamatan::find($kecamatan_id);
        $kelurahan = Kelurahan::find($kelurahan_id);

        return view('pages.dashboard.index', compact(
            'title',
            'active_dashboard',
            'kecamatans',
            'tahun', 
            'kecamatan_id',
            'kelurahan_id',
            'rtrw_id',
            'kecamatan', 
            'kelurahan',
            'rtrw'
        ));
    }
}
