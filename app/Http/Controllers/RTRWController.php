<?php

namespace App\Http\Controllers;

use App\Models\Dasawisma;
use DataTables;

use Illuminate\Http\Request;

// Models
use App\Models\RTRW;
use App\Models\Kecamatan;

class RTRWController extends Controller
{
    protected $title = 'RT/RW';
    protected $desc  = 'Menu ini berisikan data RT / RW';
    protected $active_rtrw = true;

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_rtrw = $this->active_rtrw;

        if ($request->ajax()) {
            return $this->dataTable();
        }

        $kecamatans = Kecamatan::select('id', 'n_kecamatan')->where('kabupaten_id', 40)->get();

        return view('pages.rtrw.index', compact(
            'title',
            'desc',
            'active_rtrw',
            'kecamatans'
        ));
    }

    public function dataTable()
    {
        $data = RTRW::queryTable();

        return DataTables::of($data)
            ->rawColumns(['id', 'nama'])
            ->addColumn('action', function ($p) {
                $check = Dasawisma::where('rtrw_id', $p->id)->count();

                $edit = '<a href="#" onclick="edit(' . $p->id . ')" class="text-info m-r-5" title="Edit Data"><i class="bi bi-pencil-fill"></i></a>';
                $delete = '<a href="#" onclick="remove(' . $p->id . ')" class="text-danger" title="Delete Data"><i class="bi bi-trash-fill"></i></a>';

                if ($check) {
                    return $edit;
                } else {
                    return $edit . $delete;
                }

                return '<a href="#" onclick="edit(' . $p->id . ')" class="text-info m-r-5" title="Edit Data"><i class="bi bi-pencil-fill"></i></a>
                        <a href="#" onclick="remove(' . $p->id . ')" class="text-danger" title="Delete Data"><i class="bi bi-trash-fill"></i></a>';
            })
            ->editColumn('kecamatan_id', function ($p) {
                return $p->kecamatan->n_kecamatan;
            })
            ->editColumn('kelurahan_id', function ($p) {
                return $p->kelurahan->n_kelurahan;
            })
            ->rawColumns(['id', 'action'])
            ->addIndexColumn()
            ->toJson();
    }

    public function store(Request $request)
    {
        //* Validation
        $request->validate([
            'kecamatan_id' => 'required',
            'kelurahan_id' => 'required',
            'rt' => 'required|digits:3|numeric',
            'rw' => 'required|digits:3|numeric',
            'keterangan' => 'max:500'
        ]);

        //* Get params
        $kecamatan_id = $request->kecamatan_id;
        $kelurahan_id = $request->kelurahan_id;
        $rt = $request->rt;
        $rw = $request->rw;

        //* Check existing data
        $check = RTRW::where('kecamatan_id', $kecamatan_id)->where('kelurahan_id', $kelurahan_id)->where('rt', $rt)->where('rw', $rw)->first();
        if ($check) {
            return response()->json(['message' => "Data sudah pernah disimpan."], 422);
        }

        $input = $request->all();
        RTRW::create($input);

        return response()->json(['message' => "Berhasil menyiman data."]);
    }

    public function edit($id)
    {
        $data = RTRW::find($id);

        return $data;
    }

    public function update(Request $request, $id)
    {
        //* Validation
        $request->validate([
            'kecamatan_id' => 'required',
            'kelurahan_id' => 'required',
            'rt' => 'required|digits:3|numeric',
            'rw' => 'required|digits:3|numeric',
            'keterangan' => 'string|max:500'
        ]);

        //* Get params
        $kecamatan_id = $request->kecamatan_id;
        $kelurahan_id = $request->kelurahan_id;
        $rt = $request->rt;
        $rw = $request->rw;

        //* Check existing data
        $check = RTRW::where('kecamatan_id', $kecamatan_id)->where('kelurahan_id', $kelurahan_id)->where('rt', $rt)->where('rw', $rw)->count();
        if ($check == 2) {
            return response()->json(['message' => "Data sudah pernah disimpan."], 422);
        }

        $input = $request->all();
        $data  = RTRW::find($id);
        $data->update($input);

        return response()->json(['message' => "Berhasil memperbaharui data."]);
    }

    public function destroy($id)
    {
        RTRW::destroy($id);

        return response()->json(['message' => "Berhasil menghapus data."]);
    }
}
