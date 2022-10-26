<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Helpers\CheckRole;

// Models
use App\Models\RTRW;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class DashboardController extends Controller
{
    protected $title = 'Dashboard';
    protected $active_dashboard = true;

    public function __construct(CheckRole $checkRole)
    {
        $this->checkRole = $checkRole;
    }

    public function index(Request $request)
    {
        $time = Carbon::now();
        $tahun = $time->format('Y');

        $title = $this->title;
        $active_dashboard = $this->active_dashboard;

        $kecamatans = Kecamatan::select('id', 'n_kecamatan')->where('kabupaten_id', 40)->get();

        list($dasawisma_id, $kecamatan_id, $kelurahan_id, $rtrw_id, $rw, $rt, $role_id) = $this->checkRole->getFilterValue();

        //* Filter
        $tahun   = $tahun ? $tahun : $request->tahun;
        $rtrw_id = $rtrw_id ? $rtrw_id : $request->rtrw_filter;
        $kecamatan_id = $kecamatan_id ? $kecamatan_id : $request->kecamatan_filter;
        $kelurahan_id = $kelurahan_id ? $kelurahan_id : $request->kelurahan_filter;

        $rtrw = RTRW::find($rtrw_id);
        $kecamatan = Kecamatan::find($kecamatan_id);
        $kelurahan = Kelurahan::find($kelurahan_id);

        // dd($kecamatan_id);

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
