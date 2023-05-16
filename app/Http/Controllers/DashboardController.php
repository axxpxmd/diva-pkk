<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Helpers\CheckRole;
use App\Models\Anggota;
use App\Models\KartuKeluarga;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\RTRW;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Rumah;

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
        $role_id = Auth::user()->modelHasRole->role_id;

        $kecamatans = Kecamatan::select('id', 'n_kecamatan')->where('kabupaten_id', 40)->get();

        list($dasawisma_id, $kecamatan_id, $kelurahan_id, $rtrw_id, $rw, $rt, $role_id) = $this->checkRole->getFilterValue();

        // Params
        $tahun_filter = $request->tahun;
        $rtrw_filter  = $request->rtrw_filter ? $request->rtrw_filter : null;
        $kecamatan_filter = $request->kecamatan_filter ? $request->kecamatan_filter : null;
        $kelurahan_filter = $request->kelurahan_filter ? $request->kelurahan_filter : null;

        //* Filter
        $tahun   = $tahun ? $tahun : $tahun;
        $rtrw_id = $rtrw_id ? $rtrw_id : $rtrw_filter;
        $kecamatan_id = $kecamatan_id ? $kecamatan_id : $kecamatan_filter;
        $kelurahan_id = $kelurahan_id ? $kelurahan_id : $kelurahan_filter;

        $rtrw = RTRW::find($rtrw_id);
        $kecamatan = Kecamatan::find($kecamatan_id);
        $kelurahan = Kelurahan::find($kelurahan_id);

        $totalRumah = Rumah::totalRumah($kecamatan_filter, $kelurahan_filter, $rtrw_filter);
        $jumlahKK = KartuKeluarga::totalKK($kecamatan_filter, $kelurahan_filter, $rtrw_filter);
        $jumlahAnggota = Anggota::totalWarga($kecamatan_filter, $kelurahan_filter, $rtrw_filter);
       
        $totalPus = Anggota::anggota(4, $kecamatan_filter, $kelurahan_filter, $rtrw_filter);
        $totalWus = Anggota::anggota(5, $kecamatan_filter, $kelurahan_filter, $rtrw_filter);
        $totalStunting = Anggota::anggota(11, $kecamatan_filter, $kelurahan_filter, $rtrw_filter);
        $totalDomTangsel = Anggota::anggota(12, $kecamatan_filter, $kelurahan_filter, $rtrw_filter);
        $totalDomLuarTangsel = Anggota::anggota(13, $kecamatan_filter, $kelurahan_filter, $rtrw_filter);
        $totalLakiLaki = Anggota::anggota(1, $kecamatan_filter, $kelurahan_filter, $rtrw_filter);
        $totalPerempuan = Anggota::anggota(2, $kecamatan_filter, $kelurahan_filter, $rtrw_filter);
        $totalLajang = Anggota::anggota(14, $kecamatan_filter, $kelurahan_filter, $rtrw_filter);
        $totalMenikah = Anggota::anggota(15, $kecamatan_filter, $kelurahan_filter, $rtrw_filter);
        $totalJanda = Anggota::anggota(16, $kecamatan_filter, $kelurahan_filter, $rtrw_filter);
        $totalDuda = Anggota::anggota(17, $kecamatan_filter, $kelurahan_filter, $rtrw_filter);

        //* RUMAH

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
            'rtrw',
            'totalRumah',
            'jumlahKK',
            'jumlahAnggota',
            'totalPus',
            'totalWus',
            'totalStunting',
            'totalDomTangsel',
            'totalDomLuarTangsel',
            'totalLakiLaki',
            'totalPerempuan',
            'totalLajang',
            'totalMenikah',
            'totalJanda',
            'totalDuda'
        ));
    }
}
