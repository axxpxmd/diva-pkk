<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\RTRW;
use App\Models\Keluarga;
use App\Models\Dasawisma;
use App\Models\JumlahDetail;

class KartuKeluargaController extends Controller
{
    protected $title = 'Rumah';
    protected $desc  = 'Menu ini berisikan data kartu rumah';
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
            ->editColumn('dasawisma_id', function ($p) {
                return $p->dasawisma->nama;
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
            'jamban' => 'required',
            'beras' => 'required_without:non_beras',
            'pdam' => 'required_without_all:sumur,sungai,lainnya',
            'tempat_smph' => 'required',
            'saluran_pmbngn' => 'required',
            'stiker_p4k' => 'required',
            'kriteria_rmh' => 'required',
            'aktifitas_up2k' => 'required',
            'aktifitas_lngkngn' => 'required'
        ], [
            'rtrw_id.required' => 'RT/RW wajib diisi.',
            'dasawisma_id.required' => 'Dasawisma wajib diisi.',
            'alamat_detail.required' => 'Alamat wajib diisi.',
            'nm_kpl_klrg.required' => 'Nama Kepala wajib diisi.',
            'jml_laki.required' => 'Jumlah Laki - Laki wajib diisi.',
            'jml_perempuan.required' => 'Jumlah Perempuan wajib diisi.',
            'beras.required_without' => 'Makanan Pokok minimal pilih salah satu.'
        ]);

        /* Tahapan : 
         * 1. tmusers
         * 2. model_has_roles
         */

        DB::beginTransaction(); //* DB Transaction Begin

        try {
            //* Tahap 1
            $dataJumlahDetail = [
                'balita' => $request->balita,
                'pus' => $request->pus,
                'wus' => $request->wus,
                'buta' => $request->buta,
                'ibu_hamil' => $request->ibu_hamil,
                'ibu_menyusui' => $request->ibu_menyusui,
                'lansia' => $request->lansia,
                'berkebutuhan_khusus' => $request->berkebutuhan_khusus
            ];

            $jumlahDetail = JumlahDetail::create($dataJumlahDetail);

            //* Tahap 2

            //TODO: Makanan pokok
            if ($request->non_beras) {
                $mkn_pokok = $request->non_beras;
            } elseif ($request->beras) {
                $mkn_pokok = $request->beras;
            } elseif ($request->beras && $request->non_bera) {
                $mkn_pokok = 3;
            }

            //TODO: Sumber air
            $sumberAir = array($request->pdam, $request->sumur, $request->sungai, $request->lainnya);
            $sumberAirNoEmptyOrNull = array_filter($sumberAir, function ($v) {
                return !is_null($v) && $v !== '';
            });
            $sumberAirNoEmptyOrNull = array_values($sumberAirNoEmptyOrNull);
            $outputSumberAir = "";
            for ($i = 0; $i < count($sumberAirNoEmptyOrNull); $i++) {
                $outputSumberAir .= $sumberAirNoEmptyOrNull[$i] . "|";
            }

            //TODO: Aktifitas UP2K 
            if ($request->aktifitas_up2k == 1) {
                $aktifitasUP2K = 'Tidak : ' . $request->aktifitas_up2k_usaha;
            } else {
                $aktifitasUP2K = 'Ya';
            }

            $dataKeluarga = [
                'rtrw_id' => $request->rtrw_id,
                'dasawisma_id' => $request->dasawisma_id,
                'alamat_detail' => $request->alamat_detail,
                'nm_kpl_klrg' => $request->nm_kpl_klrg,
                'jml_laki' => $request->jml_laki,
                'jml_perempuan' => $request->jml_perempuan,
                'jml_keluarga' => $request->jml_laki + $request->jml_perempuan,
                'jml_detail_id' => $jumlahDetail->id,
                'mkn_pokok' => $mkn_pokok,
                'jamban' => $request->jamban,
                'sumber_air' => $outputSumberAir,
                'tempat_smph' => $request->tempat_smph,
                'saluran_pmbngn' => $request->saluran_pmbngn,
                'stiker_p4k' => $request->stiker_p4k,
                'kriteria_rmh' => $request->kriteria_rmh,
                'aktifitas_up2k' => $aktifitasUP2K,
                'aktifitas_lngkngn' => $request->aktifitasUP2K
            ];

            Keluarga::create($dataKeluarga);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback(); //* DB Transaction Failed
            return response()->json(['message' => "Terjadi kesalahan, silahkan hubungi administrator"], 500);
        }

        DB::commit(); //* DB Transaction Success

        return response()->json(['message' => "Berhasil menyiman data."]);
    }
}
