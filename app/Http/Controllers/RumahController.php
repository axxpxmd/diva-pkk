<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\RTRW;
use App\Models\Rumah;
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

        if ($request->ajax()) {
            return $this->dataTable();
        }

        $dasawisma_id = Auth::user()->dasawisma_id;
        $rtrw_id = Auth::user()->dasawisma->rtrw_id;

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

    public function dataTable()
    {
        $data = Rumah::all();

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                $check = KartuKeluarga::where('rumah_id', $p->id)->count();

                $edit = '<a href="#" onclick="edit(' . $p->id . ')" class="text-info m-r-10" title="Edit Data"><i class="bi bi-pencil-fill"></i></a>';
                $delete = '<a href="#" onclick="remove(' . $p->id . ')" class="text-danger" title="Delete Data"><i class="bi bi-trash-fill"></i></a>';

                if ($check == 0) {
                    return $edit . $delete;
                } else {
                    return $edit;
                }
            })
            ->editColumn('kepala_rumah', function ($p) {
                $action = "<a href='" . route('rumah.show', $p->id) . "' class='text-info' title='Menampilkan Data'>" . $p->kepala_rumah . "</a>";

                return $action;
            })
            ->editColumn('dasawisma_id', function ($p) {
                return $p->dasawisma->nama;
            })
            ->editColumn('kriteria_rmh', function ($p) {
                $sehat = '<span class="badge bg-success">Sehat</span>';
                $KurangSehat = '<span class="badge bg-danger">Kurang Sehat</span>';

                return $p->kriteria_rmh == 1 ? $sehat : $KurangSehat;
            })
            ->rawColumns(['id', 'kriteria_rmh', 'action', 'kepala_rumah'])
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
        $title = 'Kartu Keluarga';
        $desc  = $this->desc;
        $active_rumah = $this->active_rumah;
        $id    = $id;

        if ($request->ajax()) {
            return $this->dataTableKK();
        }

        $data = Rumah::find($id);

        return view('pages.rumah.show', compact(
            'title',
            'desc',
            'active_rumah',
            'id',
            'data'
        ));
    }

    public function dataTableKK()
    {
        $data = KartuKeluarga::all();

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