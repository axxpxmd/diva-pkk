<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;

// Models
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\MappingKelurahan;

class KelurahanController extends Controller
{
    protected $title = 'Kelurahan';
    protected $desc  = 'Menu ini berisikan data Kelurahan';
    protected $active_kelurahan = true;

    public function __construct()
    {
        $this->middleware(['permission:rt/rw']);
    }

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_kelurahan = $this->active_kelurahan;

        $kecamatan_id = $request->kecamatan_filter;
        if ($request->ajax()) {
            return $this->dataTable($kecamatan_id);
        }

        $kecamatans = Kecamatan::select('id', 'n_kecamatan')->where('kabupaten_id', 40)->get();

        // Filter
        $kecamatanDisplay = true;

        return view('pages.kelurahan.index', compact(
            'title',
            'desc',
            'active_kelurahan',
            'kecamatans',
            'kecamatanDisplay'
        ));
    }

    public function dataTable($kelurahan_id)
    {
        $data = Kelurahan::queryTable($kelurahan_id);

        return DataTables::of($data)
            ->editColumn('kecamatan_id', function ($p) {
                return $p->kecamatan->n_kecamatan;
            })
            ->addColumn('ketua_kelurahan', function ($p) {
                $add = "<a href='" . route('kelurahan.createKetuaKelurahan', $p->id) . "' class='text-info' title='Tambah Ketua RT'><i class='bi bi-person-plus-fill'></i></a>";

                if ($p->ketua_kelurahan) {
                    $mappingKelurahan = MappingKelurahan::where('id', $p->ketua_kelurahan)->first();

                    return $mappingKelurahan->ketua . '&nbsp&nbsp&nbsp' . $add;
                } else {
                    return $add;
                }
            })
            ->addColumn('jumlah', function ($p) {
                return 'RT ' . $p->rt->count() . ' / ' . 'RW ' . $p->rw->count() . ' / ' . 'Rumah ' . $p->rumah->count() . ' / ' . 'KK ' . $p->kk->count(). ' / ' . 'Warga ' . $p->warga->count();
            })
            ->rawColumns(['id', 'ketua_kelurahan'])
            ->addIndexColumn()
            ->toJson();
    }

    public function createKetuaKelurahan($id)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_kelurahan = $this->active_kelurahan;

        $kelurahan = Kelurahan::find($id);
        $mappingKelurahan = MappingKelurahan::where('kelurahan_id', $id)->get();

        return view('pages.kelurahan.form_ketua_kelurahan', compact(
            'title',
            'desc',
            'active_kelurahan',
            'kelurahan',
            'mappingKelurahan'
        ));
    }

    public function storeKetuaKelurahan(Request $request)
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
        $kelurahan_id = $request->kelurahan_id;

        // Check aktif
        if ($status == 1) {
            $mappingKelurahan = MappingKelurahan::where('kelurahan_id', $kelurahan_id)->where('status', 1)->count();
            if ($mappingKelurahan != 0) {
                return redirect()
                    ->route('kelurahan.createKetuaKelurahan', $kelurahan_id)
                    ->withErrors("Terdapat Ketua yang masih aktif menjabat.");
            }
        }

        $input = $request->all();
        $data  = MappingKelurahan::create($input);

        // update table kelurahan
        if ($status == 1) {
            $kelurahan = Kelurahan::find($kelurahan_id);
            $kelurahan->update([
                'ketua_kelurahan' => $data->id
            ]);
        }

        return redirect()
            ->route('kelurahan.createKetuaKelurahan', $kelurahan_id)
            ->withSuccess("Selamat, Data berhasil tersimpan.");
    }

    public function editKetuaKelurahan($id)
    {
        $data = MappingKelurahan::find($id);

        return $data;
    }

    public function updateKetuaKelurahan(Request $request)
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
        $kelurahan_id = $request->kelurahan_id;

        // Check aktif
        if ($status == 1) {
            $mappingKelurahan = MappingKelurahan::where('kelurahan_id', $kelurahan_id)->whereNotIn('id', [$id])->where('status', 1)->count();
            if ($mappingKelurahan != 0) {
                return redirect()
                    ->route('kelurahan.createKetuaKelurahan', $kelurahan_id)
                    ->withErrors("Terdapat Ketua yang masih aktif menjabat.");
            }
        }

        $input = $request->all();
        $data  = MappingKelurahan::find($id);
        $data->update($input);

        // update table kelurahan
        if ($status == 1) {
            $kelurahan = Kelurahan::find($kelurahan_id);
            $kelurahan->update([
                'ketua_kelurahan' => $data->id
            ]);
        }

        return redirect()
            ->route('kelurahan.createKetuaKelurahan', $kelurahan_id)
            ->withSuccess("Selamat, Data berhasil diperbarui.");
    }
}
