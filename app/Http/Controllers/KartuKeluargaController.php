<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\RTRW;
use App\Models\Keluarga;
use App\Models\Dasawisma;

class KartuKeluargaController extends Controller
{
    protected $title = 'Keluarga';
    protected $desc  = 'Menu ini berisikan data kartu keluarga';
    protected $active_kk = true;

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_kk = $this->active_kk;

        if ($request->ajax()) {
            return $this->dataTable();
        }

        return view('pages.keluarga.index', compact(
            'title',
            'desc',
            'active_kk'
        ));
    }

    public function dataTable()
    {
        $data = Keluarga::all();

        return DataTables::of($data)
            ->rawColumns(['id', 'nama'])
            ->addColumn('action', function ($p) {
                return '-';
            })
            ->rawColumns(['id', 'action', 'alamat'])
            ->addIndexColumn()
            ->toJson();
    }

    public function create()
    {
        $title = $this->title;
        $desc  = 'Menu ini untuk menambah data keluarga';
        $active_kk = $this->active_kk;

        $dasawisma_id = Auth::user()->dasawisma_id;
        $rtrw_id = Auth::user()->rtrw_id;

        $dasawismas = Dasawisma::select('id', 'nama')->get();
        $rtrws = RTRW::select('id', 'kecamatan_id', 'kelurahan_id', 'rw', 'rt')->with(['kecamatan', 'kelurahan'])->get();

        return view('pages.keluarga.create', compact(
            'title',
            'desc',
            'active_kk',
            'dasawismas',
            'rtrws',
            'dasawisma_id',
            'rtrw_id'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rtrw_id' => 'required',
            'dasawisma_id' => 'required',
            'alamat_detail' => 'required',
            'nm_kpl_klrg' => 'required',
            'jml_laki' => 'required',
            'jml_perempuan' => 'required',
            'jamban' => 'required'
        ], [
            'rtrw_id.required' => 'RT/RW wajib diisi.',
            'dasawisma_id.required' => 'Dasawisma wajib diisi.',
            'alamat_detail.required' => 'Alamat wajib diisi.',
            'nm_kpl_klrg.required' => 'Nama Kepala wajib diisi.',
            'jml_laki.required' => 'Jumlah Laki - Laki wajib diisi.',
            'jml_perempuan.required' => 'Jumlah Perempuan wajib diisi.',
        ]);

        return response()->json(['message' => "Berhasil menyiman data."]);
    }
}
