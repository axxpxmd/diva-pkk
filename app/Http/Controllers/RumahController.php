<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\RTRW;
use App\Models\Rumah;
use App\Models\Anggota;
use App\Models\Dasawisma;
use App\Models\KartuKeluarga;

class RumahController extends Controller
{
    protected $title = 'Rumah';
    protected $desc  = 'Menu ini berisikan data rumah';
    protected $active_rumah = true;

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_rumah = $this->active_rumah;

        $dasawisma_id = Auth::user()->dasawisma_id;
        $rtrw_id = Auth::user()->dasawisma->rtrw_id;

        $layak_huni = $request->layak_huni;
        $kriteria_rmh = $request->kriteria_rmh;
        if ($request->ajax()) {
            return $this->dataTable($layak_huni, $kriteria_rmh);
        }

        $dasawismas = Dasawisma::select('id', 'nama')->get();
        $rtrws = RTRW::select('id', 'kecamatan_id', 'kelurahan_id', 'rw', 'rt')->with(['kecamatan', 'kelurahan'])->get();

        return view('pages.rumah.index', compact(
            'title',
            'desc',
            'active_rumah',
            'dasawismas',
            'rtrws',
            'dasawisma_id',
            'rtrw_id'
        ));
    }

    public function dataTable($layak_huni, $kriteria_rmh)
    {
        $data = Rumah::queryTable($layak_huni, $kriteria_rmh);

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
                return $p->kk->count() . " <a href='" . route('rumah.show', $p->id) . "' class='text-success fs-16' title='Tambah KK'><i class='bi bi-file-plus-fill m-l-5'></i></a>";
            })
            ->editColumn('dasawisma_id', function ($p) {
                return $p->dasawisma->nama;
            })
            ->editColumn('kriteria_rmh', function ($p) {
                $sehat = '<span class="badge bg-success">Sehat</span>';
                $KurangSehat = '<span class="badge bg-danger">Kurang Sehat</span>';

                return $p->kriteria_rmh == 1 ? $sehat : $KurangSehat;
            })
            ->addColumn('jumlah_anggota', function ($p) {
                return $p->anggota->count() . ' Orang';
            })
            ->rawColumns(['id', 'kriteria_rmh', 'action', 'kepala_rumah', 'jumlah_kk'])
            ->addIndexColumn()
            ->toJson();
    }

    public function store(Request $request)
    {
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

        // Check Duplikat
        $check = Rumah::where('kepala_rumah', $request->kepala_rumah)->where('alamat_detail', $request->alamat_detail)->count();
        if ($check != 0)
            return response()->json(['message' => "Error, data rumah sudah pernah disimpan."], 422);

        $input = $request->all();
        $input['sumber_air'] = json_encode($request->sumber_air);
        $input['created_by'] = Auth::user()->nama;
        Rumah::create($input);

        return response()->json(['message' => "Berhasil menyiman data."]);
    }

    public function show(Request $request, $id)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_rumah = $this->active_rumah;
        $id    = $id;

        $data = Rumah::find($id);
        $rumah_id = $data->id;

        if ($request->ajax()) {
            return $this->dataTableKK($rumah_id);
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
                $edit = '<a href="#" onclick="edit(' . $p->id . ')" class="text-info m-r-10" title="Edit Data"><i class="bi bi-pencil-fill"></i></a>';
                $delete = '<a href="#" onclick="remove(' . $p->id . ')" class="text-danger" title="Delete Data"><i class="bi bi-trash-fill"></i></a>';

                return $edit . $delete;
            })
            ->editColumn('domisili', function ($p) {
                return $p->domisili == 1 ? 'Tangerang Selatan' : 'Luar Tangerang Selatan';
            })
            ->addColumn('data_kk', function ($p) {
                $dataRumah = '<a href="' . route('cetakKartuKeluarga', $p->id) . '" target="blank" class="btn btn-sm btn-info m-r-5"><i class="bi bi-file-pdf-fill m-r-8"></i>Data KK</a>';
            
                return $dataRumah;
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
        $data = Rumah::find($id);

        return $data;
    }

    public function update(Request $request, $id)
    {
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

        $input = $request->all();
        $input['sumber_air'] = json_encode($request->sumber_air);
        $input['updated_by'] = Auth::user()->nama;

        $data = Rumah::find($id);
        $data->update($input);

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
            'no_kk' => 'required|unique:kk,no_kk|max:16',
            'nm_kpl_klrga' => 'required|max:100',
            'thn_input' => 'required|max:4'
        ]);

        $input = $request->all();
        $input['created_by'] = Auth::user()->nama;
        KartuKeluarga::create($input);

        return response()->json(['message' => "Berhasil menyiman data."]);
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
            'no_kk' => 'required|max:16|unique:kk,no_kk,' . $id,
            'nm_kpl_klrga' => 'required|max:100',
            'thn_input' => 'required|max:4'
        ]);

        $input = $request->all();
        $input['updated_by'] = Auth::user()->nama;

        $data = KartuKeluarga::find($id);
        $data->update($input);

        return response()->json(['message' => "Berhasil memperbaharui data."]);
    }

    public function destroyKK($id)
    {
        KartuKeluarga::destroy($id);

        return response()->json(['message' => "Berhasil menghapus data."]);
    }
}
