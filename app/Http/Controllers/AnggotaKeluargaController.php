<?php

namespace App\Http\Controllers;

use Validator;
use DataTables;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Helpers\CheckRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\RTRW;
use App\Models\Rumah;
use App\Models\Anggota;
use App\Models\Dasawisma;
use App\Models\Kecamatan;
use App\Models\AnggotaDetail;

class AnggotaKeluargaController extends Controller
{
    protected $title = 'Warga';
    protected $desc  = 'Menu ini berisikan data warga';
    protected $active_anggota = true;

    public function __construct(CheckRole $checkRole)
    {
        $this->middleware(['permission:anggota kk']);
        $this->checkRole = $checkRole;
    }

    public function checkFilter()
    {
        $role_id = Auth::user()->modelHasRole->role_id;

        // Filter
        $rtrwDisplay = false;
        $rwDisplay = true;
        $rtDisplay = true;

        $kecamatanDisplay = true;
        $kelurahanDisplay = true;

        return [$kecamatanDisplay, $kelurahanDisplay, $rtrwDisplay, $rwDisplay, $rtDisplay];
    }

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_anggota = $this->active_anggota;

        list($dasawisma_id, $kecamatan_id, $kelurahan_id, $rtrw_id, $rw, $rt, $role_id) = $this->checkRole->getFilterValue();

        $kelamin      = $request->kelamin;
        $status_hidup = $request->status_hidup;
        $rumah_id     = $request->rumah_filter;
        $kecamatan_id = $kecamatan_id ? $kecamatan_id : $request->kecamatan_filter;
        $kelurahan_id = $kelurahan_id ? $kelurahan_id : $request->kelurahan_filter;
        $rw = $rw ? $rw : $request->rw_filter;
        $rt = $rt ? $rt : $request->rt_filter;
        $rtrw_id = $rtrw_id ? $rtrw_id : $request->rtrw_filter;
        if ($request->ajax()) {
            return $this->dataTable($rtrw_id, $kecamatan_id, $kelurahan_id, $kelamin, $status_hidup, $dasawisma_id, $rumah_id, $rw, $rt);
        }

        $dasawismas = Dasawisma::select('id', 'nama')->get();
        $rtrws = RTRW::select('id', 'kecamatan_id', 'kelurahan_id', 'rw', 'rt')->with(['kecamatan', 'kelurahan'])->get();
        $kecamatans = Kecamatan::select('id', 'n_kecamatan')->where('kabupaten_id', 40)->get();

        list($kecamatanDisplay, $kelurahanDisplay, $rtrwDisplay, $rwDisplay, $rtDisplay) = $this->checkFilter();

        return view('pages.anggota_keluarga.index', compact(
            'title',
            'desc',
            'active_anggota',
            'rtrwDisplay',
            'kecamatanDisplay',
            'kelurahanDisplay',
            'kecamatans',
            'kecamatan_id',
            'kelurahan_id',
            'rtrw_id',
            'rwDisplay',
            'rtDisplay',
            'rt',
            'rw',
            'dasawisma_id',
            'role_id'
        ));
    }

    public function dataTable($rtrw_id, $kecamatan_id, $kelurahan_id, $kelamin, $status_hidup, $dasawisma_id, $rumah_id, $rw, $rt)
    {
        $data = Anggota::queryTable($rtrw_id, $kecamatan_id, $kelurahan_id, $kelamin, $status_hidup, $dasawisma_id, $rumah_id, $rw, $rt);

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                $edit = '<a href="#" onclick="edit(' . $p->id . ')" class="text-info m-r-10" title="Edit Data"><i class="bi bi-pencil-fill"></i></a>';
                $delete = '<a href="#" onclick="remove(' . $p->id . ')" class="text-danger" title="Delete Data"><i class="bi bi-trash-fill"></i></a>';

                return '-';
            })
            ->editColumn('nama', function ($p) {
                $action = "<a href='" . route('anggota-keluarga.show', $p->id) . "' class='text-info' title='Menampilkan Data'>" . $p->nama . "</a>";

                return $action;
            })
            ->editColumn('status_hidup', function ($p) {
                $hidup = '<span class="badge bg-success">Hidup</span>';
                $meninggal = '<span class="badge bg-danger">Meninggal</span>';

                return $p->status_hidup == 1 ? $hidup : $meninggal;
            })
            ->editColumn('domisili', function ($p) {
                return $p->anggotaDetail->domisili == 1 ? 'Tangsel' : 'Luar Tangsel';
            })
            ->rawColumns(['id', 'action', 'nama', 'status_hidup'])
            ->addIndexColumn()
            ->toJson();
    }

    public function create(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_anggota = $this->active_anggota;

        list($dasawisma_id, $kecamatan_id, $kelurahan_id, $rtrw_id, $rw, $rt, $role_id) = $this->checkRole->getFilterValue();

        $status   = $request->status;
        $rumah_id = $request->rumah_id;
        $no_kk    = $request->no_kk;

        if ($rumah_id && $no_kk) {
            $rtrw = RTRW::select('id', 'kecamatan_id', 'kelurahan_id', 'rw', 'rt')->where('id', $request->rtrw_id)->first();
            $kecamatan_id = $rtrw->kecamatan_id;
            $kelurahan_id = $rtrw->kelurahan_id;
            $rw = $rtrw->rw;
            $rt = $rtrw->rt;
            $rtrw_id = $request->rtrw_id;
            $dasawisma_id = $request->dasawisma_id;
        } else {
            $kecamatan_id = $kecamatan_id ? $kecamatan_id : $request->kecamatan_filter;
            $kelurahan_id = $kelurahan_id ? $kelurahan_id : $request->kelurahan_filter;
            $rw = $rw ? $rw : $request->rw_filter;
            $rt = $rt ? $rt : $request->rt_filter;
            $rtrw_id = $rtrw_id ? $rtrw_id : $request->rtrw_filter;
        }

        $dasawismas = Dasawisma::select('id', 'nama')->get();
        $rtrw = RTRW::select('id', 'kecamatan_id', 'kelurahan_id', 'rw', 'rt')->where('id', $rtrw_id)->first();
        $kecamatans = Kecamatan::select('id', 'n_kecamatan')->where('kabupaten_id', 40)->get();

        if ($role_id == 3) {
            $view = 'pages.anggota_keluarga.createRT';
        } else {
            $view = 'pages.anggota_keluarga.create';
        }

        return view($view, compact(
            'title',
            'desc',
            'active_anggota',
            'dasawismas',
            'dasawisma_id',
            'rtrw_id',
            'status',
            'rumah_id',
            'no_kk',
            'kecamatans',
            'kecamatan_id',
            'kelurahan_id'
        ));
    }

    public function checkValidationForm1(Request $request)
    {
        $request->validate([
            'dasawisma_id' => 'required',
            'rumah_id' => 'required',
            'rtrw_id' => 'required',
            'terdaftar_dukcapil' => 'required|in:0, 1',
            'nik' => 'required_if:terdaftar_dukcapil,1',
            'domisili' => 'required_if:terdaftar_dukcapil,1|in:0,1',
            'no_kk' => 'required_if:terdaftar_dukcapil,1',
            'nama' => 'required|string|max:100',
            'kelamin' => 'required|in:Laki - laki,Perempuan',
            'tmpt_lahir' => 'required|string|max:200',
            'tgl_lahir' => 'required',
            'akta_kelahiran' => 'required',
            'status_kawin' => 'required',
            'status_dlm_klrga' => 'required',
            'agama' => 'required',
            'status_pendidkan' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required'
        ]);

        $nik = Str::length($request->nik);
        $no_kk = Str::length($request->nik);
        if ($nik > 0) {
            $request->validate([
                'nik' => 'digits:16'
            ]);
        }
        if ($no_kk > 0) {
            $request->validate([
                'no_kk' => 'digits:16'
            ]);
        }

        return response()->json([
            'message' => 'Success.'
        ]);
    }

    public function checkValidationForm2(Request $request)
    {
        $request->validate([
            'bpjs' => 'required',
            'kb' => 'required_if:kelamin,Perempuan',
            'aktif_posyandu' => 'required_if:kb,Ya',
            'frekuensi_posyandu' => 'required_if:aktif_posyandu,Ya',
            'aktif_posbindu' => 'required_if:kb,Ya',
            'aktif_posbindu' => 'required_if:aktif_posbindu,Ya',
            'kbthn_khusus' => 'required',
            'jenis_kbthn_khusus' => 'required_if:kbthn_khusus,Ya',
            'buta' => 'required|in:0,1',
            'jenis_buta' => 'required_if:buta,1',
            'makanan_pokok' => 'required|in:0,1,2'
        ]);

        return response()->json([
            'message' => 'Success.'
        ]);
    }

    public function genereateNoRegist($c_kel, $kel_id)
    {
        // 36.74.xxx.xxx.xxxx.xxx (tanpa titik)
        // Prov.Tangsel.Kec.Kel.Tahun Input.Nomor urut input

        $time = Carbon::now();
        $year = $time->format('y');

        $total = Anggota::join('rumah', 'rumah.id', '=', 'anggota.rumah_id')
            ->join('rt_rw', 'rt_rw.id', '=', 'rumah.rtrw_id')
            ->where('rt_rw.kelurahan_id', $kel_id)
            ->where(DB::raw('YEAR(anggota.created_at)'), '=', $time->year)
            ->orderBy('anggota.id', 'DESC')
            ->first();

        if ($total != null) {
            $noUrut = substr($total->no_registrasi, 17) + 1;
        } else {
            $noUrut = '1';
        }

        //* No Urut terdiri dari 5 digits
        if (\strlen($noUrut) == 1) {
            $generateNoRegistrasi = '0000' . $noUrut;
        } elseif (\strlen($noUrut) == 2) {
            $generateNoRegistrasi = '000' . $noUrut;
        } elseif (\strlen($noUrut) == 3) {
            $generateNoRegistrasi = '00' . $noUrut;
        } elseif (\strlen($noUrut) == 4) {
            $generateNoRegistrasi = '0' . $noUrut;
        } elseif (\strlen($noUrut) == 5) {
            $generateNoRegistrasi = $noUrut;
        }

        return $c_kel . '.' . $year . '.' . $generateNoRegistrasi;
    }

    public function storeRT(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'rumah_id' => 'required',
            'rtrw_id' => 'required',
            'terdaftar_dukcapil' => 'required|in:0, 1',
            'nik' => 'required_if:terdaftar_dukcapil,1',
            'domisili' => 'required_if:terdaftar_dukcapil,1|in:0,1',
            'no_kk' => 'required_if:terdaftar_dukcapil,1',
            'nama' => 'required|string|max:100',
            'kelamin' => 'required|in:Laki - laki,Perempuan',
            'tmpt_lahir' => 'required|string|max:200',
            'tgl_lahir' => 'required',
            'akta_kelahiran' => 'required',
            'status_kawin' => 'required',
            'status_dlm_klrga' => 'required',
            'agama' => 'required',
            'status_pendidkan' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required'
        ]);

          /* Tahapan : 
         * 1. Generate No Registrasi
         * 2. Store Data
         */

        //* Tahap 1
        $rtrw  = RTRW::find($request->rtrw_id);
        $c_kel = $rtrw->kelurahan->kode;
        $kel_id = $rtrw->kelurahan->id;

        $noRegistrasi = $this->genereateNoRegist($c_kel, $kel_id);

        $checkGenerate = [
            'noRegistrasi'  => $noRegistrasi,
        ];
        Validator::make($checkGenerate, [
            'noRegistrasi'  => 'required|unique:anggota,no_registrasi',
        ])->validate();

        DB::beginTransaction(); //* DB Transaction Begin
        try {
            //* Tahap 2
            $data1Anggota = [
                'status_hidup' => 1,
                'rumah_id' => $request->rumah_id,
                'rtrw_id' => $request->rtrw_id,
                'nik' => $request->nik,
                'no_kk' => $request->no_kk,
                'nama' => $request->nama,
                'kelamin' => $request->kelamin,
                'tmpt_lahir' => $request->tmpt_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'akta_kelahiran' => $request->akta_kelahiran,
                'status_kawin' => $request->status_kawin,
                'agama' => $request->agama,
                'status_pendidkan' => $request->status_pendidkan,
                'pendidikan' => $request->pendidikan,
                'pekerjaan' => $request->pekerjaan,
                'jabatan' => $request->jabatan,
                'status_dlm_klrga' =>  $request->status_dlm_klrga,
                'no_registrasi' => $noRegistrasi,
                'created_by' => Auth::user()->nama,
                'status_lengkap' => 0
            ];
            $anggota = Anggota::create($data1Anggota);

            $data1AnggotaDetail = [
                'anggota_id' => $anggota->id,
                'domisili' => $request->domisili,
                'almt_luar_tangsel' => $request->almt_luar_tangsel,
                'terdaftar_dukcapil' => $request->terdaftar_dukcapil,
                'wus' => $request->wus,
                'pus' => $request->pus,
                'created_by' => Auth::user()->nama
            ];
            AnggotaDetail::create($data1AnggotaDetail);
        } catch (\Throwable $th) {
            DB::rollback(); //* DB Transaction Failed
            return response()->json(['message' => "Terjadi kesalahan, silahkan hubungi administrator"], 500);
        }

        DB::commit(); //* DB Transaction Success

        return response()->json(['message' => "Berhasil Menyimpan data."]);
    }

    public function storeHidup(Request $request)
    {
        /* Tahapan : 
         * 1. Generate No Registrasi
         * 2. Data 1
         * 3. Data 2
         * 4. Data 3
         */

        //* Tahap 1
        $rtrw  = RTRW::find($request->rtrw_id);
        $c_kel = $rtrw->kelurahan->kode;
        $kel_id = $rtrw->kelurahan->id;

        $noRegistrasi = $this->genereateNoRegist($c_kel, $kel_id);

        $checkGenerate = [
            'noRegistrasi'  => $noRegistrasi,
        ];
        Validator::make($checkGenerate, [
            'noRegistrasi'  => 'required|unique:anggota,no_registrasi',
        ])->validate();

        DB::beginTransaction(); //* DB Transaction Begin
        try {
            //* Tahap 2
            $data1Anggota = [
                'status_hidup' => 1,
                'rumah_id' => $request->rumah_id,
                'rtrw_id' => $request->rtrw_id,
                'nik' => $request->nik,
                'no_kk' => $request->no_kk,
                'nama' => $request->nama,
                'kelamin' => $request->kelamin,
                'tmpt_lahir' => $request->tmpt_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'akta_kelahiran' => $request->akta_kelahiran,
                'status_kawin' => $request->status_kawin,
                'agama' => $request->agama,
                'status_pendidkan' => $request->status_pendidkan,
                'pendidikan' => $request->pendidikan,
                'pekerjaan' => $request->pekerjaan,
                'jabatan' => $request->jabatan,
                'status_dlm_klrga' =>  $request->status_dlm_klrga,
                'no_registrasi' => $noRegistrasi,
                'created_by' => Auth::user()->nama,
                'status_lengkap' => 1
            ];
            $anggota = Anggota::create($data1Anggota);

            $data1AnggotaDetail = [
                'anggota_id' => $anggota->id,
                'domisili' => $request->domisili,
                'almt_luar_tangsel' => $request->almt_luar_tangsel,
                'terdaftar_dukcapil' => $request->terdaftar_dukcapil,
                'wus' => $request->wus,
                'pus' => $request->pus,
                'created_by' => Auth::user()->nama
            ];
            $anggotaDetail = AnggotaDetail::create($data1AnggotaDetail);

            //* Tahap 3
            $data2Anggota = [
                'bpjs' => $request->bpjs,
                'asuransi_lainnya' => $request->asuransi_lainnya ? json_encode($request->asuransi_lainnya) : null,
                'kbthn_khusus' => $request->kbthn_khusus,
                'buta' => $request->buta,
                'makanan_pokok' => $request->makanan_pokok,
                'kb' => $request->kb == 'Ya' ? $request->jenis_kb : $request->kb,
                'aktif_posyandu' => $request->aktif_posyandu == 'Ya' ? $request->frekuensi_posyandu : $request->aktif_posyandu,
                'aktif_posbindu' => $request->aktif_posbindu == 'Ya' ? $request->frekuensi_posbindu : $request->aktif_posbindu,
                'status_ibu' => $request->status_ibu,
                'status_anak' => $request->status_anak,
                'stunting' => $request->stunting
            ];
            $anggota->update($data2Anggota);

            $data2AnggotaDetail = [
                'jenis_kbthn_khusus' => $request->jenis_kbthn_khusus,
                'jenis_buta' => $request->jenis_buta ? json_encode($request->jenis_buta) : null,
            ];
            $anggotaDetail->update($data2AnggotaDetail);

            //* Tahap 4
            $data3AnggotaDetail = [
                'prgrm_bina_balita' => $request->prgrm_bina_balita,
                'tabungan' => $request->tabungan,
                'klmpk_belajar' => $request->klmpk_belajar == 1 ? $request->jns_klmpk_belajar : 'Tidak',
                'paud' => $request->paud,
                'kgtn_koperasi' => $request->kgtn_koperasi,
                'jns_kgtn_koperasi' => $request->jns_kgtn_koperasi,
                'kgtn_pancasila' => $request->kgtn_pancasila,
                'jns_kgtn_pancasila' => $request->jns_kgtn_pancasila ? json_encode($request->jns_kgtn_pancasila) : null,
                'gotong_royong' => $request->gotong_royong,
                'jns_gotong_royong' => $request->jns_gotong_royong ? json_encode($request->jns_gotong_royong) : null,
                'hatinya_pkk' => $request->hatinya_pkk,
                'jns_hatinya_pkk' => $request->jns_hatinya_pkk ? json_encode($request->jns_hatinya_pkk) : null,
                'industri_rmh_up2k' => $request->industri_rmh_up2k,
                'jns_industri_rmh_up2k' => $request->jns_industri_rmh_up2k ? json_encode($request->jns_industri_rmh_up2k) : null,
                'kgtn_kshtn_lingkungan' => $request->kgtn_kshtn_lingkungan,
                'jns_kgtn_keagamaan' => $request->jns_kgtn_keagamaan
            ];
            $anggotaDetail->update($data3AnggotaDetail);
        } catch (\Throwable $th) {
            DB::rollback(); //* DB Transaction Failed
            return response()->json(['message' => "Terjadi kesalahan, silahkan hubungi administrator"], 500);
        }

        DB::commit(); //* DB Transaction Success

        return response()->json(['message' => "Berhasil Menyimpan data."]);
    }

    public function storeMeninggal(Request $request)
    {
        $request->validate([
            'rumah_id' => 'required',
            'terdaftar_dukcapil' => 'required|in:0, 1',
            'nik' => 'required_if:terdaftar_dukcapil,1|unique:anggota,nik',
            'domisili' => 'required_if:terdaftar_dukcapil,1|in:0,1',
            'no_kk' => 'required_if:terdaftar_dukcapil,1',
            'nama' => 'required|string|max:100',
            'kelamin' => 'required|in:Laki - laki,Perempuan',
            'tmpt_lahir' => 'required|string|max:200',
            'tgl_lahir' => 'required',
            'tgl_meninggal' => 'required',
            'sebab_meninggal' => 'required|in:Hamil,Sakit,Lahir mati',
            'akte_kematian' => 'required|in:0,1'
        ]);

        /*
         * Tahapan
         * 1. Generate No Registrasi
         * 2. anggota
         * 3. anggota_details
         */

        //* Tahap 1
        $rumah = Rumah::find($request->rumah_id);
        $rtrw  = $rumah->rtrw;
        $c_kel = $rtrw->kelurahan->kode;
        $kel_id = $rtrw->kelurahan->id;

        $noRegistrasi = $this->genereateNoRegist($c_kel, $kel_id);

        $checkGenerate = [
            'noRegistrasi'  => $noRegistrasi,
        ];
        Validator::make($checkGenerate, [
            'noRegistrasi'  => 'required|unique:anggota,no_registrasi',
        ])->validate();

        DB::beginTransaction(); //* DB Transaction Begin

        try {
            //* Tahap 2
            $inputAnggota = [
                'rtrw_id' => $request->rtrw_id,
                'rumah_id' => $request->rumah_id,
                'nik' => $request->nik,
                'status_hidup' => 0,
                'no_kk' => $request->no_kk,
                'nama' => $request->nama,
                'kelamin' => $request->kelamin,
                'tmpt_lahir' => $request->tmpt_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'no_registrasi' => $noRegistrasi,
                'created_by' => Auth::user()->nama
            ];
            $anggota = Anggota::create($inputAnggota);

            //* Tahap 3
            $inputAnggotaDetail = [
                'anggota_id' => $anggota->id,
                'tgl_meninggal' => $request->tgl_meninggal,
                'sebab_meninggal' => $request->sebab_meninggal,
                'akte_kematian' => $request->akte_kematian,
                'domisili' => $request->domisili,
                'terdaftar_dukcapil' => $request->terdaftar_dukcapil,
                'created_by' => Auth::user()->nama
            ];
            AnggotaDetail::create($inputAnggotaDetail);
        } catch (\Throwable $th) {
            DB::rollback(); //* DB Transaction Failed
            return response()->json(['message' => "Terjadi kesalahan, silahkan hubungi administrator"], 500);
        }

        DB::commit(); //* DB Transaction Success

        return response()->json(['message' => "Berhasil Menyimpan data."]);
    }

    public function show($id)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_anggota = $this->active_anggota;

        $anggota = Anggota::find($id);
        $anggota_detail = AnggotaDetail::where('anggota_id', $id)->first();

        return view('pages.anggota_keluarga.show.show', compact(
            'title',
            'desc',
            'active_anggota',
            'anggota',
            'anggota_detail'
        ));
    }
}
