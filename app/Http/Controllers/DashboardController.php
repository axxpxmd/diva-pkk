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

        if ($role_id == 1 || $role_id == 9 || $role_id == 10) {
            $disable = false;
        } else {
            $disable = true;
        }

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

        $totalRumah = Rumah::totalRumah($kecamatan_id, $kelurahan_id, $rtrw_id);
        $jumlahKK = KartuKeluarga::totalKK($kecamatan_id, $kelurahan_id, $rtrw_id);
        $jumlahAnggota = Anggota::totalWarga($kecamatan_id, $kelurahan_id, $rtrw_id);

        $totalPus = Anggota::anggota(4, $kecamatan_id, $kelurahan_id, $rtrw_id);
        $totalWus = Anggota::anggota(5, $kecamatan_id, $kelurahan_id, $rtrw_id);
        $totalStunting = Anggota::anggota(11, $kecamatan_id, $kelurahan_id, $rtrw_id);
        $totalDomTangsel = Anggota::anggota(12, $kecamatan_id, $kelurahan_id, $rtrw_id);
        $totalDomLuarTangsel = Anggota::anggota(13, $kecamatan_id, $kelurahan_id, $rtrw_id);
        $totalLakiLaki = Anggota::anggota(1, $kecamatan_id, $kelurahan_id, $rtrw_id);
        $totalPerempuan = Anggota::anggota(2, $kecamatan_id, $kelurahan_id, $rtrw_id);
        $totalLajang = Anggota::anggota(14, $kecamatan_id, $kelurahan_id, $rtrw_id);
        $totalMenikah = Anggota::anggota(15, $kecamatan_id, $kelurahan_id, $rtrw_id);
        $totalJanda = Anggota::anggota(16, $kecamatan_id, $kelurahan_id, $rtrw_id);
        $totalDuda = Anggota::anggota(17, $kecamatan_id, $kelurahan_id, $rtrw_id);

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
            'totalDuda',
            'disable'
        ));
    }
}
