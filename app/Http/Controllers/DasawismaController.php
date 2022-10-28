<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use App\Http\Helpers\CheckRole;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\User;
use App\Models\Dasawisma;
use App\Models\Kecamatan;
use App\Models\DasawismaUser;

class DasawismaController extends Controller
{
    protected $title = 'Dasawisma';
    protected $desc  = 'Menu ini berisikan data Dasawisma';
    protected $active_dasawisma = true;

    public function __construct(CheckRole $checkRole)
    {
        $this->middleware(['permission:dasawisma']);
        $this->checkRole = $checkRole;
    }

    public function checkFilter()
    {
        $role_id = Auth::user()->modelHasRole->role_id;

        // Filter
        if ($role_id == 3) {
            $rtDisplay = false;
            $rwDisplay = false;
            $rtrwDisplay = true;
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
        $active_dasawisma = $this->active_dasawisma;

        list($dasawisma_id, $kecamatan_id, $kelurahan_id, $rtrw_id, $rw, $rt, $role_id) = $this->checkRole->getFilterValue();

        $kecamatan_id = $kecamatan_id ? $kecamatan_id : $request->kecamatan_filter;
        $kelurahan_id = $kelurahan_id ? $kelurahan_id : $request->kelurahan_filter;
        $rw = $rw ? $rw : $request->rw_filter;
        $rt = $rt ? $rt : $request->rt_filter;
        if ($request->ajax()) {
            return $this->dataTable($kecamatan_id, $kelurahan_id, $rw, $rt, $role_id);
        }
        
        $kecamatans = Kecamatan::select('id', 'n_kecamatan')->where('kabupaten_id', 40)->get();

        list($kecamatanDisplay, $kelurahanDisplay, $rtrwDisplay, $rwDisplay, $rtDisplay) = $this->checkFilter();

        return view('pages.dasawisma.index', compact(
            'title',
            'desc',
            'active_dasawisma',
            'kecamatans',
            'rtrwDisplay',
            'kecamatanDisplay',
            'kelurahanDisplay',
            'role_id',
            'kecamatan_id',
            'kelurahan_id',
            'rw',
            'rt',
            'rtrw_id',
            'rwDisplay',
            'rtDisplay'
        ));
    }

    public function dataTable($kecamatan_id, $kelurahan_id, $rw, $rt, $role_id)
    {
        $data = Dasawisma::queryTable($kecamatan_id, $kelurahan_id, $rw, $rt);

        return DataTables::of($data)
            ->rawColumns(['id', 'nama'])
            ->addColumn('action', function ($p) use ($role_id) {
                $check = $p->dasawismaUser->count();

                $edit = '<a href="#" onclick="edit(' . $p->id . ')" class="text-info m-r-5" title="Edit Data"><i class="bi bi-pencil-fill"></i></a>';
                $delete = '<a href="#" onclick="remove(' . $p->id . ')" class="text-danger" title="Delete Data"><i class="bi bi-trash-fill"></i></a>';

                if ($role_id != 2) {
                    if ($check) {
                        return $edit;
                    } else {
                        return $edit . $delete;
                    }
                } else {
                    return '-';
                }
            })
            ->editColumn('nama', function ($p) {
                $action = "<a href='" . route('dasawisma.show', $p->id) . "' class='text-info' title='Menampilkan Data'>" . $p->nama . "</a>";

                return $action;
            })
            ->addColumn('alamat', function ($p) {
                return $p->rtrw->kecamatan->n_kecamatan . ' - ' . $p->rtrw->kelurahan->n_kelurahan . ' - RW ' . $p->rtrw->rw . ' / RT ' . $p->rtrw->rt;
            })
            ->editColumn('ketua_id', function ($p) {
                $totalKetua =  $p->dasawismaUser->count();
                $show = '<a href="#" onclick="showKetua(' . $p->id . ')" class="text-info m-l-10" title="Tampilkan Daftar Ketua"><i class="bi bi-eye-fill"></i></a>';

                if ($totalKetua == 0) {
                    return $totalKetua;
                } else {
                    return $totalKetua . $show;
                }
            })
            ->addColumn('jumlah', function ($p) {
                return 'Rumah ' . $p->rumah->count() . ' / ' . 'KK ' . $p->kk->count() . ' / ' . 'Warga ' . $p->warga->count();
            })
            ->rawColumns(['id', 'action', 'ketua_id', 'nama'])
            ->addIndexColumn()
            ->toJson();
    }

    public function showKetua($id)
    {
        $data = DasawismaUser::where('dasawisma_id', $id)->get();

        $dataUser = [];
        foreach ($data as $key => $i) {
            $dataUser[$key] = [
                'ketua' => $i->user->nama,
                'dasawisma' => $i->dasawisma->nama,
                'no_telp' => $i->user->no_telp
            ];
        }

        return $dataUser;
    }

    public function show($id)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_dasawisma = $this->active_dasawisma;

        $data = Dasawisma::find($id);
        $listKetua = User::where('dasawisma_id', $id)->get();

        return view('pages.dasawisma.show', compact(
            'title',
            'desc',
            'active_dasawisma',
            'data',
            'listKetua'
        ));
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

        return response()->json(['message' => "Berhasil Menyimpan data."]);
    }

    public function edit($id)
    {
        $data = Dasawisma::find($id);

        $dataDasawisma = [
            'id' => $data->id,
            'nama' => $data->nama,
            'kecamatan_id' => $data->rtrw->kecamatan_id,
            'kelurahan_id' => $data->rtrw->kelurahan_id,
            'rtrw_id' => $data->rtrw_id
        ];

        return $dataDasawisma;
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
