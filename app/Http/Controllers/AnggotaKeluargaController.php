<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

// Models
use App\Models\RTRW;
use App\Models\Rumah;
use App\Models\Anggota;
use App\Models\Dasawisma;

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
        // $request->validate([
        //     'dasawisma_id' => 'required',
        //     'rumah_id' => 'required',
        //     'terdaftar_dukcapil' => 'required|in:0, 1',
        //     'nik' => 'required_if:terdaftar_dukcapil,1',
        //     'domisili' => 'required_if:terdaftar_dukcapil,1|in:0,1',
        //     'no_kk' => 'required_if:terdaftar_dukcapil,1',
        //     'nama' => 'required|string|max:100',
        //     'kelamin' => 'required|in:Laki - laki,Perempuan',
        //     'tmpt_lahir' => 'required|string|max:200',
        //     'tgl_lahir' => 'required',
        //     'akta_kelahiran' => 'required',
        //     'status_kawin' => 'required',
        //     'status_dlm_klrga' => 'required|array',
        //     'agama' => 'required',
        //     'status_pendidkan' => 'required',
        //     'pendidikan' => 'required',
        //     'pekerjaan' => 'required',
        //     'jabatan' => 'required'
        // ]);

        // $nik = Str::length($request->nik);
        // $no_kk = Str::length($request->nik);
        // if ($nik > 0) {
        //     $request->validate([
        //         'nik' => 'digits:16'
        //     ]);
        // }
        // if ($no_kk > 0) {
        //     $request->validate([
        //         'no_kk' => 'digits:16'
        //     ]);
        // }

        return response()->json([
            'message' => 'Success.'
        ]);
    }
}
