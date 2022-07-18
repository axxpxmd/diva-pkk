<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\RTRW;
use App\Models\Rumah;
use App\Models\Anggota;
use App\Models\Dasawisma;
use App\Models\AnggotaDetail;

class AnggotaKeluargaController extends Controller
{
    protected $title = 'Anggota Keluarga';
    protected $desc  = 'Menu ini berisikan data anggota keluarga';
    protected $active_anggota = true;

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_anggota = $this->active_anggota;

        if ($request->ajax()) {
            return $this->dataTable();
        }

        $dasawisma_id = Auth::user()->dasawisma_id;
        $rtrw_id = Auth::user()->dasawisma->rtrw_id;

        $dasawismas = Dasawisma::select('id', 'nama')->get();
        $rtrws = RTRW::select('id', 'kecamatan_id', 'kelurahan_id', 'rw', 'rt')->with(['kecamatan', 'kelurahan'])->get();

        return view('pages.anggota_keluarga.index', compact(
            'title',
            'desc',
            'active_anggota'
        ));
    }

    public function dataTable()
    {
        $data = Anggota::queryTable();

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                $edit = '<a href="#" onclick="edit(' . $p->id . ')" class="text-info m-r-10" title="Edit Data"><i class="bi bi-pencil-fill"></i></a>';
                $delete = '<a href="#" onclick="remove(' . $p->id . ')" class="text-danger" title="Delete Data"><i class="bi bi-trash-fill"></i></a>';

                return $edit . $delete;
            })
            ->editColumn('status', function ($p) {
                return $p->status == 1 ? 'Hidup' : 'Meninggal';
            })
            ->rawColumns(['id', 'action'])
            ->addIndexColumn()
            ->toJson();
    }

    public function create(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_anggota = $this->active_anggota;
        $status = $request->status;

        $dasawisma_id = Auth::user()->dasawisma_id;
        $rtrw_id = Auth::user()->dasawisma->rtrw_id;

        $dasawismas = Dasawisma::select('id', 'nama')->get();
        $rtrws = RTRW::select('id', 'kecamatan_id', 'kelurahan_id', 'rw', 'rt')->with(['kecamatan', 'kelurahan'])->get();
        $rumah = Rumah::select('id', 'kepala_rumah', 'alamat_detail')->get();

        return view('pages.anggota_keluarga.create', compact(
            'title',
            'desc',
            'active_anggota',
            'dasawismas',
            'rtrws',
            'dasawisma_id',
            'rtrw_id',
            'rumah',
            'status'
        ));
    }

    public function checkValidationForm1(Request $request)
    {
        $request->validate([
            'dasawisma_id' => 'required',
            'rumah_id' => 'required',
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
            'status_dlm_klrga' => 'required|array',
            'agama' => 'required',
            'status_pendidkan' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'jabatan' => 'required'
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
            // 'status_ibu' => 'required_if:kelamin,Perempuan',
            'kbthn_khusus' => 'required',
            'jenis_kbthn_khusus' => 'required_if:kbthn_khusus,Ya',
            'buta' => 'required|in:0,1',
            'jenis_buta' => 'required_if:buta,1',
            'makanan_pokok' => 'required|in:0,1'
        ]);

        return response()->json([
            'message' => 'Success.'
        ]);
    }

    public function storeHidup(Request $request)
    {
        dd($request->all());
    }

    public function storeMeninggal(Request $request)
    {
        $request->validate([
            'dasawisma_id' => 'required',
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
         * 1. anggota
         * 2. anggota_details
         */

        DB::beginTransaction(); //* DB Transaction Begin

        try {
            // Tahap 1
            $inputAnggota = [
                'rumah_id' => $request->rumah_id,
                'nik' => $request->nik,
                'status_hidup' => 0,
                'no_kk' => $request->no_kk,
                'nama' => $request->nama,
                'kelamin' => $request->kelamin,
                'tmpt_lahir' => $request->tmpt_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'created_by' => Auth::user()->nama
            ];
            $anggota = Anggota::create($inputAnggota);

            // Tahap 2
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

        return response()->json(['message' => "Berhasil menyiman data."]);
    }
}
