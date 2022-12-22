<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Anggota;

use Illuminate\Http\Request;
use App\Http\Helpers\CheckRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\RTRW;
use App\Models\Rumah;
use App\Models\Kecamatan;
use App\Models\Dasawisma;
use App\Models\KartuKeluarga;

class RumahController extends Controller
{
    protected $title = 'Rumah';
    protected $desc  = 'Menu ini berisikan data rumah';
    protected $active_rumah = true;

    public function __construct(CheckRole $checkRole)
    {
        $this->middleware(['permission:rumah']);
        $this->checkRole = $checkRole;
    }

    public function checkFilter()
    {
        $role_id = Auth::user()->modelHasRole->role_id;

        // Filter
        if ($role_id == 3) {
            $rtrwDisplay = true;
            $rwDisplay = false;
            $rtDisplay = false;
        } else {
            $rtrwDisplay = false;
            $rwDisplay = true;
            $rtDisplay = true;
        }

        $kecamatanDisplay = true;
        $kelurahanDisplay = true;

        return [$kecamatanDisplay, $kelurahanDisplay, $rtrwDisplay, $rwDisplay, $rtDisplay];
    }

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_rumah = $this->active_rumah;

        list($dasawisma_id, $kecamatan_id, $kelurahan_id, $rtrw_id, $rw, $rt, $role_id) = $this->checkRole->getFilterValue();

        $layak_huni   = $request->layak_huni;
        $kriteria_rmh = $request->kriteria_rmh;
        $kecamatan_id = $kecamatan_id ? $kecamatan_id : $request->kecamatan_filter;
        $kelurahan_id = $kelurahan_id ? $kelurahan_id : $request->kelurahan_filter;
        $rw = $rw ? $rw : $request->rw_filter;
        $rt = $rt ? $rt : $request->rt_filter;
        $rtrw_id = $rtrw_id ? $rtrw_id : $request->rtrw_filter;
        if ($request->ajax()) {
            return $this->dataTable($kecamatan_id, $kelurahan_id, $rtrw_id, $rt, $rw, $dasawisma_id, $kriteria_rmh, $layak_huni);
        }

        $dasawismas = Dasawisma::select('id', 'nama')->get();
        $rtrws = RTRW::select('id', 'kecamatan_id', 'kelurahan_id', 'rw', 'rt')->with(['kecamatan', 'kelurahan'])->get();
        $kecamatans = Kecamatan::select('id', 'n_kecamatan')->where('kabupaten_id', 40)->get();

        list($kecamatanDisplay, $kelurahanDisplay, $rtrwDisplay, $rwDisplay, $rtDisplay) = $this->checkFilter();

        $belumLengkap = count(Rumah::belumLengkapTotal($kecamatan_id, $kelurahan_id, $rtrw_id, $rt, $rw));

        return view('pages.rumah.index', compact(
            'title',
            'desc',
            'active_rumah',
            'dasawismas',
            'rtrws',
            'dasawisma_id',
            'rtrw_id',
            'rtrwDisplay',
            'kecamatanDisplay',
            'kelurahanDisplay',
            'kecamatans',
            'kecamatan_id',
            'kelurahan_id',
            'role_id',
            'rwDisplay',
            'rtDisplay',
            'rw',
            'rt',
            'belumLengkap'
        ));
    }

    public function dataTable($kecamatan_id, $kelurahan_id, $rtrw_id, $rt, $rw, $dasawisma_id, $kriteria_rmh, $layak_huni)
    {
        $data = Rumah::queryTable($kecamatan_id, $kelurahan_id, $rtrw_id, $rt, $rw, $dasawisma_id, $kriteria_rmh, $layak_huni);

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                $edit = '<a href="#" onclick="edit(' . $p->id . ')" class="text-info m-r-10" title="Edit Data"><i class="bi bi-pencil-fill"></i></a>';
                $delete = '<a href="#" onclick="remove(' . $p->id . ')" class="text-danger" title="Delete Data"><i class="bi bi-trash-fill"></i></a>';

                if ($p->kk->count() == 0) {
                    return $edit . $delete;
                } else {
                    return $edit;
                }
            })
            ->editColumn('kepala_rumah', function ($p) {
                $action = "<a href='" . route('rumah.show', $p->id) . "' class='text-info' title='Menampilkan Data'>" . $p->kepala_rumah . "</a>";

                return $action;
            })
            ->addColumn('jumlah_kk', function ($p) {
                return $p->kk->count() . " <a href='" . route('rumah.show', $p->id) . "' class='text-info fs-16' title='Tambah KK'><i class='bi bi-file-plus-fill m-l-5'></i></a>";
            })
            ->editColumn('dasawisma_id', function ($p) {
                return $p->dasawisma ? $p->dasawisma->nama : '-';
            })
            ->editColumn('kriteria_rmh', function ($p) {
                $sehat = '<span class="badge bg-success">Sehat</span>';
                $KurangSehat = '<span class="badge bg-danger">Kurang Sehat</span>';

                return $p->kriteria_rmh == 1 ? $sehat : $KurangSehat;
            })
            ->editColumn('layak_huni', function ($p) {
                $ya = '<span class="badge bg-success">Ya</span>';
                $tidak = '<span class="badge bg-danger">Tidak</span>';

                return $p->layak_huni == 1 ? $ya : $tidak;
            })
            ->addColumn('jumlah_anggota', function ($p) {
                return $p->anggota->count() . ' Orang';
            })
            ->editColumn('status_isi', function ($p) {
                $lengkap = '<span class="badge bg-success">Lengkap</span>';
                $tidakLengkap = '<span class="badge bg-danger">Blm Lengkap</span>';

                return $p->status_isi == 1 ? $lengkap : $tidakLengkap;
            })
            ->rawColumns(['id', 'kriteria_rmh', 'action', 'kepala_rumah', 'jumlah_kk', 'layak_huni', 'status_isi'])
            ->addIndexColumn()
            ->toJson();
    }

    public function store(Request $request)
    {
        $role_id = Auth::user()->modelHasRole->role_id;
        if ($role_id == 3) {
            $request->validate([
                'kepala_rumah' => 'required|max:100',
                'alamat_detail' => 'required|max:200'
            ]);
        } else {
            $request->validate([
                'dasawisma_id' => 'required',
                'rtrw_id' => 'required',
                'kepala_rumah' => 'required|max:100',
                'alamat_detail' => 'required|max:200',
                'jamban' => 'required',
                'sumber_air' => 'required|array|max:200',
                'tempat_smph' => 'required',
                'saluran_pmbngn' => 'required',
                'stiker_p4k' => 'required',
                'kriteria_rmh' => 'required',
                'layak_huni' => 'required'
            ]);
        }

        // Check Duplikat
        $check = Rumah::where('kepala_rumah', $request->kepala_rumah)->where('alamat_detail', $request->alamat_detail)->count();
        if ($check != 0)
            return response()->json(['message' => "Error, data rumah sudah pernah disimpan."], 422);

        $input = $request->all();
        if ($role_id != 3) {
            $input['sumber_air'] = json_encode($request->sumber_air);
            $input['status_isi'] = 1;
        } else {
            $input['status_isi'] = 0;
        }

        $input['created_by'] = Auth::user()->nama;
        Rumah::create($input);

        return response()->json(['message' => "Berhasil Menyimpan data."]);
    }

    public function show(Request $request, $id)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_rumah = $this->active_rumah;
        $id    = $id;

        $data = Rumah::find($id);

        if ($request->ajax()) {
            return $this->dataTableKK($id);
        }

        return view('pages.rumah.show', compact(
            'title',
            'desc',
            'active_rumah',
            'id',
            'data'
        ));
    }

    public function dataTableKK($rumah_id)
    {
        $data = KartuKeluarga::where('rumah_id', $rumah_id)->get();

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                $check = $p->anggota()->count();

                $edit = '<a href="#" onclick="edit(' . $p->id . ')" class="text-info m-r-10" title="Edit Data"><i class="bi bi-pencil-fill"></i></a>';
                $delete = '<a href="#" onclick="remove(' . $p->id . ')" class="text-danger" title="Delete Data"><i class="bi bi-trash-fill"></i></a>';

                return $check != 0 ? $edit : $edit . $delete;
            })
            ->editColumn('domisili', function ($p) {
                return $p->domisili == 1 ? 'Tangerang Selatan' : 'Luar Tangerang Selatan';
            })
            ->addColumn('data_kk', function ($p) {
                $totalAnggota = $p->anggota->count();
                $dataRumah    = '<a href="' . route('cetakKartuKeluarga', $p->id) . '" target="blank" class="btn btn-sm btn-info m-r-5"><i class="bi bi-file-pdf-fill m-r-8"></i>Data KK</a>';

                return $totalAnggota != 0 ? $dataRumah : '-';
            })
            ->addColumn('total_anggota', function ($p) {
                $hidup        = $p->anggota(1)->count();
                $meninggal    = $p->anggota(2)->count();

                $addAnggota = '<a href="#" onclick="sendNoKK(' . $p->no_kk . ')" data-bs-toggle="modal" data-bs-target="#modalFormAddAnggota" class="text-success m-r-10" title="Tambah Anggota"><i class="bi bi-plus font-weight-bold fs-22"></i></a>';

                return $hidup . ' Hidup&nbsp; / &nbsp;' . $meninggal . ' Meninggal &nbsp;' . $addAnggota;
            })
            ->rawColumns(['id', 'action', 'total_anggota', 'data_kk'])
            ->addIndexColumn()
            ->toJson();
    }

    public function edit($id)
    {
        $data = Rumah::where('id', $id)->with(['rtrw'])->first();

        $dataRumah = [
            'id' => $data->id,
            'dasawisma_id' => $data->dasawisma_id,
            'rtrw_id' => $data->rtrw_id,
            'kepala_rumah' => $data->kepala_rumah,
            'alamat_detail' => $data->alamat_detail,
            'jamban' => $data->jamban,
            'sumber_air' => $data->sumber_air,
            'tempat_smph' => $data->tempat_smph,
            'saluran_pmbngn' => $data->saluran_pmbngn,
            'stiker_p4k' => $data->stiker_p4k,
            'kriteria_rmh' => $data->kriteria_rmh,
            'layak_huni' => $data->layak_huni,
            'kelurahan_id' => $data->rtrw->kelurahan_id,
            'kecamatan_id' => $data->rtrw->kecamatan_id,
            'status_isi' => $data->status_isi
        ];

        return $dataRumah;
    }

    public function update(Request $request, $id)
    {
        $role_id = Auth::user()->modelHasRole->role_id;
        if ($role_id == 3) {
            $request->validate([
                'rtrw_id' => 'required',
                'kepala_rumah' => 'required|max:100',
                'alamat_detail' => 'required|max:200'
            ]);
        } else {
            $request->validate([
                'dasawisma_id' => 'required',
                'rtrw_id' => 'required',
                'kepala_rumah' => 'required|max:100',
                'alamat_detail' => 'required|max:200',
                'jamban' => 'required',
                'sumber_air' => 'required|array|max:200',
                'tempat_smph' => 'required',
                'saluran_pmbngn' => 'required',
                'stiker_p4k' => 'required',
                'kriteria_rmh' => 'required',
                'layak_huni' => 'required'
            ]);
        }

        DB::beginTransaction(); //* DB Transaction Begin
        try {
            $input = $request->all();
            if ($role_id != 3) {
                $input['sumber_air'] = json_encode($request->sumber_air);
                $input['status_isi'] = 1;
            }
            $input['updated_by'] = Auth::user()->nama;

            $data = Rumah::find($id);
            $data->update($input);

            //* Check Duplicate
            $check = Rumah::where('kepala_rumah', $request->kepala_rumah)->where('alamat_detail', $request->alamat_detail)->count();
            if ($check > 1)
                return response()->json(['message' => "Error, data rumah sudah pernah disimpan."], 422);
        } catch (\Throwable $th) {
            DB::rollback(); //* DB Transaction Failed
            return response()->json(['message' => "Terjadi kesalahan, silahkan hubungi administrator"], 500);
        }

        DB::commit(); //* DB Transaction Success

        return response()->json(['message' => "Berhasil memperbaharui data."]);
    }

    public function destroy($id)
    {
        Rumah::destroy($id);

        return response()->json(['message' => "Berhasil menghapus data."]);
    }


    public function storeKK(Request $request)
    {
        $request->validate([
            'rumah_id' => 'required',
            'no_kk' => 'required|unique:kk,no_kk|digits:16|numeric',
            'nm_kpl_klrga' => 'required|max:100',
            'thn_input' => 'required|max:4'
        ]);

        $input = $request->all();
        $input['created_by'] = Auth::user()->nama;
        KartuKeluarga::create($input);

        return response()->json(['message' => "Berhasil Menyimpan data."]);
    }

    public function editKK($id)
    {
        $data = KartuKeluarga::find($id);

        return $data;
    }

    public function updateKK(Request $request, $id)
    {
        $request->validate([
            'rumah_id' => 'required',
            'no_kk' => 'required|digits:16|numeric|unique:kk,no_kk,' . $id,
            'nm_kpl_klrga' => 'required|max:100',
            'thn_input' => 'required|max:4'
        ]);

        $input = $request->all();
        $input['updated_by'] = Auth::user()->nama;

        $data = KartuKeluarga::find($id);

        // Update no_kk anggota
        $anggotas = Anggota::where('no_kk', $data->no_kk)->get();
        foreach ($anggotas as $i) {
            $anggota = Anggota::find($i->id);
            $anggota->update([
                'no_kk' => $request->no_kk
            ]);
        }

        $data->update($input);

        return response()->json(['message' => "Berhasil memperbaharui data."]);
    }

    public function destroyKK($id)
    {
        KartuKeluarga::destroy($id);

        return response()->json(['message' => "Berhasil menghapus data."]);
    }
}
