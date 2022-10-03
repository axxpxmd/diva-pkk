<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;

// Models
use App\Models\RTRW;
use App\Models\Kecamatan;
use App\Models\MappingRTRW;

class RTRWController extends Controller
{
    protected $title = 'RT/RW';
    protected $desc  = 'Menu ini berisikan data RT / RW';
    protected $active_rtrw = true;

    public function __construct()
    {
        $this->middleware(['permission:rt/rw']);
    }

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_rtrw = $this->active_rtrw;

        $rw = $request->rw_filter;
        $kecamatan_id = $request->kecamatan_filter;
        $kelurahan_id = $request->kelurahan_filter;
        if ($request->ajax()) {
            return $this->dataTable($rw, $kecamatan_id, $kelurahan_id);
        }

        $kecamatans = Kecamatan::select('id', 'n_kecamatan')->where('kabupaten_id', 40)->get();

        // Filter
        $rwDisplay = true;
        $kecamatanDisplay = true;
        $kelurahanDisplay = true;

        return view('pages.rtrw.index', compact(
            'title',
            'desc',
            'active_rtrw',
            'kecamatans',
            'kecamatanDisplay',
            'kelurahanDisplay',
            'rwDisplay',
        ));
    }

    public function dataTable($rw, $kecamatan_id, $kelurahan_id)
    {
        $data = RTRW::queryTable($rw, $kecamatan_id, $kelurahan_id);

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                $check = $p->dasawisma->count();

                $edit = '<a href="#" onclick="edit(' . $p->id . ')" class="text-info m-r-5" title="Edit Data"><i class="bi bi-pencil-fill"></i></a>';
                $delete = '<a href="#" onclick="remove(' . $p->id . ')" class="text-danger" title="Delete Data"><i class="bi bi-trash-fill"></i></a>';

                if ($check) {
                    return $edit;
                } else {
                    return $edit . $delete;
                }

                return '-';
            })
            ->editColumn('rt', function ($p) {
                $action = "<a href='" . route('rt-rw.show', $p->id) . "' class='text-info' title='Menampilkan Data'>" . $p->rt . "</a>";

                return $p->rt;
            })
            ->editColumn('kecamatan_id', function ($p) {
                return $p->n_kecamatan;
            })
            ->addColumn('jumlah', function ($p) {
                return 'Rumah ' . $p->rumah->count() . ' / ' . 'KK ' . $p->kk->count() . ' / ' . 'Warga ' . $p->warga->count();
            })
            ->editColumn('ketua_rt', function ($p) {
                $add = "<a href='" . route('rt-rw.createKetuaRT', $p->id) . "' class='text-info' title='Tambah Ketua RT'><i class='bi bi-person-plus-fill'></i></a>";

                if ($p->ketua_rt) {
                    $mappingRtRw = MappingRTRW::where('id', $p->ketua_rt)->first();

                    return $mappingRtRw->ketua . '&nbsp&nbsp&nbsp' . $add;
                } else {
                    return $add;
                }
            })
            ->editColumn('kelurahan_id', function ($p) {
                return $p->n_kelurahan;
            })
            ->rawColumns(['id', 'action', 'rt', 'ketua_rt'])
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

        return response()->json(['message' => "Berhasil Menyimpan data."]);
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

    public function createKetuaRT($id)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_rtrw = $this->active_rtrw;

        $rtrw = RTRW::find($id);
        $mappingRtRw = MappingRTRW::where('rtrw_id', $id)->get();

        return view('pages.rtrw.form_ketua_rt', compact(
            'title',
            'desc',
            'active_rtrw',
            'rtrw',
            'mappingRtRw'
        ));
    }

    public function storeKetuaRT(Request $request)
    {
        $request->validate([
            'ketua' => 'required',
            'no_hp' => 'required|numeric',
            'nik' => 'required|numeric|digits:16',
            'awal_menjabat' => 'required',
            'akhir_menjabat' => 'required',
            'status' => 'required'
        ]);

        $status = $request->status;
        $rtrw_id = $request->rtrw_id;

        // Check aktif
        if ($status == 1) {
            $mappingRtRw = MappingRTRW::where('rtrw_id', $rtrw_id)->where('status', 1)->count();
            if ($mappingRtRw != 0) {
                return redirect()
                    ->route('rt-rw.createKetuaRT', $rtrw_id)
                    ->withErrors("Terdapat Ketua yang masih aktif menjabat.");
            }
        }

        $input = $request->all();
        $data  = MappingRTRW::create($input);

        // 
        if ($status == 1) {
            $rtrw = RTRW::find($rtrw_id);
            $rtrw->update([
                'ketua_rt' => $data->id
            ]);
        }

        return redirect()
            ->route('rt-rw.createKetuaRT', $rtrw_id)
            ->withSuccess("Selamat, Data berhasil tersimpan.");
    }

    public function editKetuaRT($id)
    {
        $data = MappingRTRW::find($id);

        return $data;
    }

    public function updateKetuaRT(Request $request)
    {
        $request->validate([
            'ketua' => 'required',
            'no_hp' => 'required|numeric',
            'nik' => 'required|numeric|digits:16',
            'awal_menjabat' => 'required',
            'akhir_menjabat' => 'required',
            'status' => 'required'
        ]);

        $status = $request->status;
        $id = $request->id;
        $rtrw_id = $request->rtrw_id;

        // Check aktif
        if ($status == 1) {
            $mappingRtRw = MappingRTRW::where('rtrw_id', $rtrw_id)->whereNotIn('id', [$id])->where('status', 1)->count();
            if ($mappingRtRw != 0) {
                return redirect()
                    ->route('rt-rw.createKetuaRT', $rtrw_id)
                    ->withErrors("Terdapat Ketua yang masih aktif menjabat.");
            }
        }

        $input = $request->all();
        $data  = MappingRTRW::find($id);
        $data->update($input);

        // 
        if ($status == 1) {
            $rtrw = RTRW::find($rtrw_id);
            $rtrw->update([
                'ketua_rt' => $data->id
            ]);
        }

        return redirect()
            ->route('rt-rw.createKetuaRT', $rtrw_id)
            ->withSuccess("Selamat, Data berhasil diperbarui.");
    }
}
