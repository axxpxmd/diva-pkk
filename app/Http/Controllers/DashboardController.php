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

        $totalRumah = Rumah::join('rt_rw', 'rt_rw.id', '=', 'rumah.rtrw_id')
            ->when($kecamatan_filter != 'null', function ($q) use ($kecamatan_filter) {
                return $q->where('kecamatan_id', $kecamatan_filter);
            })
            ->when($kelurahan_filter != 'null', function ($q) use ($kelurahan_filter) {
                return $q->where('kelurahan_id', $kelurahan_filter);
            })
            ->when($rtrw_filter != 'null', function ($q) use ($rtrw_filter) {
                return $q->where('rtrw_id', $rtrw_filter);
            })
            ->count();
        $jumlahKK = KartuKeluarga::join('rt_rw', 'rt_rw.id', '=', 'kk.rtrw_id')
            ->when($kecamatan_filter != 'null', function ($q) use ($kecamatan_filter) {
                return $q->where('kecamatan_id', $kecamatan_filter);
            })
            ->when($kelurahan_filter != 'null', function ($q) use ($kelurahan_filter) {
                return $q->where('kelurahan_id', $kelurahan_filter);
            })
            ->when($rtrw_filter != 'null', function ($q) use ($rtrw_filter) {
                return $q->where('rtrw_id', $rtrw_filter);
            })
            ->count();
        $jumlahAnggota = Anggota::join('rt_rw', 'rt_rw.id', '=', 'anggota.rtrw_id')
            ->when($kecamatan_filter != 'null', function ($q) use ($kecamatan_filter) {
                return $q->where('kecamatan_id', $kecamatan_filter);
            })
            ->when($kelurahan_filter != 'null', function ($q) use ($kelurahan_filter) {
                return $q->where('kelurahan_id', $kelurahan_filter);
            })
            ->when($rtrw_filter != 'null', function ($q) use ($rtrw_filter) {
                return $q->where('rtrw_id', $rtrw_filter);
            })
            ->count();

        $totalPus = Anggota::anggota(4, $kecamatan_filter, $kelurahan_filter, $rtrw_filter);
        $totalWus = Anggota::anggota(5, $kecamatan_filter, $kelurahan_filter, $rtrw_filter);
        $totalStunting = Anggota::anggota(11, $kecamatan_filter, $kelurahan_filter, $rtrw_filter);
        $totalDomTangsel = Anggota::anggota(12, $kecamatan_filter, $kelurahan_filter, $rtrw_filter);
        $totalDomLuarTangsel = Anggota::anggota(13, $kecamatan_filter, $kelurahan_filter, $rtrw_filter);

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
            'totalDomLuarTangsel'
        ));
    }
}
