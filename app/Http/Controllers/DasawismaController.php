<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;

// Models
use App\Models\RTRW;
use App\Models\User;
use App\Models\Dasawisma;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class DasawismaController extends Controller
{
    protected $title = 'Dasawisma';
    protected $desc  = 'Menu ini berisikan data Dasawisma';
    protected $active_dasawisma = true;

    public function __construct()
    {
        $this->middleware(['permission:dasawisma']);
    }

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_dasawisma = $this->active_dasawisma;

        $rw = $request->rw_filter;
        $kecamatan_id = $request->kecamatan_filter;
        $kelurahan_id = $request->kelurahan_filter;
        if ($request->ajax()) {
            return $this->dataTable($rw, $kecamatan_id, $kelurahan_id);
        }

        $kecamatans = Kecamatan::select('id', 'n_kecamatan')->where('kabupaten_id', 40)->get();
        $users = User::queryTable();

        // Filter
        $rwDisplay = true;
        $kecamatanDisplay = true;
        $kelurahanDisplay = true;

        return view('pages.dasawisma.index', compact(
            'title',
            'desc',
            'active_dasawisma',
            'users',
            'kecamatans',
            'rwDisplay',
            'kecamatanDisplay',
            'kelurahanDisplay'
        ));
    }

    public function dataTable($rw, $kecamatan_id, $kelurahan_id)
    {
        $data = Dasawisma::queryTable($rw, $kecamatan_id, $kelurahan_id);

        return DataTables::of($data)
            ->rawColumns(['id', 'nama'])
            ->addColumn('action', function ($p) {
                $check = User::where('dasawisma_id', $p->id)->count();

                $edit = '<a href="#" onclick="edit(' . $p->id . ')" class="text-info m-r-5" title="Edit Data"><i class="bi bi-pencil-fill"></i></a>';
                $delete = '<a href="#" onclick="remove(' . $p->id . ')" class="text-danger" title="Delete Data"><i class="bi bi-trash-fill"></i></a>';

                if ($check) {
                    return $edit;
                } else {
                    return $edit . $delete;
                }
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
            'rtrw_id.unique' => 'RT ini sudah terdapat dasawisma.'
        ]);

        $input = $request->all();
        $input = $request->except(['kecamatan_id', 'kelurahan_id']);
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
            'nama' => 'required'
        ]);

        $input = $request->all();
        $input = $request->except(['kecamatan_id', 'kelurahan_id']);
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
