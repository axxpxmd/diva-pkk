<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;

// Models
use App\Models\Dasawisma;
use App\Models\RTRW;
use App\Models\User;

class DasawismaController extends Controller
{
    protected $title = 'Dasawisma';
    protected $desc  = 'Menu ini berisikan data Dasawisma';
    protected $active_dasawisma = true;

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_dasawisma = $this->active_dasawisma;

        if ($request->ajax()) {
            return $this->dataTable();
        }

        $rtrws = RTRW::select('id', 'kecamatan_id', 'kelurahan_id', 'rw', 'rt')->get();
        $users = User::queryTable();

        return view('pages.dasawisma.index', compact(
            'title',
            'desc',
            'active_dasawisma',
            'rtrws',
            'users'
        ));
    }

    public function dataTable()
    {
        $data = Dasawisma::all();

        return DataTables::of($data)
            ->rawColumns(['id', 'nama'])
            ->addColumn('action', function ($p) {
                return '<a href="#" onclick="edit(' . $p->id . ')" class="text-info m-r-5" title="Edit Data"><i class="bi bi-pencil-fill"></i></a>
                        <a href="#" onclick="remove(' . $p->id . ')" class="text-danger" title="Delete Data"><i class="bi bi-trash-fill"></i></a>';
            })
            ->addColumn('alamat', function ($p) {
                return $p->rtrw->kecamatan->n_kecamatan . ' - ' . $p->rtrw->kelurahan->n_kelurahan . ' - RT ' . $p->rtrw->rt . ' / RW ' . $p->rtrw->rw;
            })
            ->editColumn('ketua_id', function ($p) {
                return $p->ketua->nama;
            })
            ->rawColumns(['id', 'action'])
            ->addIndexColumn()
            ->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'rtrw_id' => 'required|unique:dasawismas,rtrw_id',
            'nama' => 'required'
        ], [
            'rtrw_id.unique' => 'Alamat ini sudah terdapat dasawisma.'
        ]);

        $input = $request->all();
        Dasawisma::create($input);

        return response()->json(['message' => "Berhasil menyiman data."]);
    }

    public function edit($id)
    {
        $data = Dasawisma::find($id);

        return $data;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rtrw_id' => 'required|unique:dasawismas,rtrw_id,' . $id,
            'nama' => 'required'
        ], [
            'rtrw_id.unique' => 'Alamat ini sudah terdapat dasawisma.'
        ]);

        $input = $request->all();
        $data = Dasawisma::find($id);
        $data->update($input);

        return response()->json(['message' => "Berhasil memperbaharui data."]);
    }

    public function destroy($id)
    {
        Dasawisma::destroy($id);

        return response()->json(['message' => "Berhasil menghapus data."]);
    }
}
