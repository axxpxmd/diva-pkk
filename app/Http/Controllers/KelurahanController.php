<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Models
use App\Models\User;
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
            ->editColumn('n_kelurahan', function ($p) {
                $action = "<a href='" . route('kelurahan.show', $p->id) . "' class='text-info' title='Menampilkan Data'>" . $p->n_kelurahan . "</a>";

                return $action;
            })
            ->addColumn('jumlah', function ($p) {
                return 'RT ' . $p->rt->count() . ' / ' . 'RW ' . $p->rw->count() . ' / ' . 'Rumah ' . $p->rumah->count() . ' / ' . 'KK ' . $p->kk->count() . ' / ' . 'Warga ' . $p->warga->count();
            })
            ->rawColumns(['id', 'ketua_kelurahan', 'n_kelurahan'])
            ->addIndexColumn()
            ->toJson();
    }

    public function show($id)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_kelurahan = $this->active_kelurahan;

        $data = Kelurahan::find($id);
        $listKetua = MappingKelurahan::where('kelurahan_id', $id)->get();

        return view('pages.kelurahan.show', compact(
            'title',
            'desc',
            'active_kelurahan',
            'listKetua',
            'data'
        ));
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

        /**
         * Tahapan 
         * 1. Check status aktif ketua kelurahan
         * 2. kelurahan_mappings (create)
         * 3. kelurahan (create)
         * 4. users (create)
         */

        DB::beginTransaction(); //* DB Transaction Begin
        try {
            //* Tahap 1
            if ($status == 1) {
                $mappingKelurahan = MappingKelurahan::where('kelurahan_id', $kelurahan_id)->where('status', 1)->count();
                if ($mappingKelurahan != 0) {
                    return redirect()
                        ->route('kelurahan.createKetuaKelurahan', $kelurahan_id)
                        ->withErrors("Terdapat Ketua yang masih aktif menjabat.");
                }
            }

            //* Tahap 2
            $input = $request->all();
            $input = $request->except(['kecamatan_id']);
            $data  = MappingKelurahan::create($input);

            //* Tahap 3
            if ($status == 1) {
                $kelurahan = Kelurahan::find($kelurahan_id);
                $kelurahan->update([
                    'ketua_kelurahan' => $data->id
                ]);
            }

            //* Tahap 4
            $checkUser = User::where('nik', $request->nik)->count();
            if (!$checkUser) {
                $data_user = [
                    'dasawisma_id' => 0,
                    'rtrw_id' => 0,
                    'kelurahan_id' => $request->kelurahan_id,
                    'kecamatan_id' => $request->kecamatan_id,
                    'username' => $request->nik,
                    'password' => \md5('123456789'),
                    'no_telp' => $request->no_hp,
                    's_aktif' => $status == 1 ? 1 : 0,
                    'nama' => $request->ketua,
                    'nik' => $request->nik,
                    'foto' => 'default.png'
                ];
                User::create($data_user);
            }
        } catch (\Throwable $th) {
            DB::rollback(); //* DB Transaction Failed
            return redirect()
                ->route('kelurahan.createKetuaKelurahan', $kelurahan_id)
                ->withErrors("Terjadi kesalahan, silahkan hubungi administrator");
        }
        DB::commit(); //* DB Transaction Success

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

        /**
         * Tahapan
         * 1. Check status aktif ketua kelurahan
         * 2. kelurahan_mappings (update)
         * 3. kelurahan (update)
         * 4. users (update)
         */

        try {
            //* Tahap 1
            if ($status == 1) {
                $mappingKelurahan = MappingKelurahan::where('kelurahan_id', $kelurahan_id)->whereNotIn('id', [$id])->where('status', 1)->count();
                if ($mappingKelurahan != 0) {
                    return redirect()
                        ->route('kelurahan.createKetuaKelurahan', $kelurahan_id)
                        ->withErrors("Terdapat Ketua yang masih aktif menjabat.");
                }
            }

            //* Tahap 4
            $data  = MappingKelurahan::find($id);
            $user = User::where('nik', $data->nik)->first();
            $user->update([
                's_aktif' => $status == 1 ? 1 : 0,
                'nik' => $request->nik,
                'no_telp' => $request->no_telp,
                'nama' => $request->ketua
            ]);

            //* Tahap 2
            $input = $request->all();
            $input = $request->except(['kecamatan_id']);
            $data->update($input);

            //* Tahap 3
            $kelurahan = Kelurahan::find($kelurahan_id);
            if ($status == 1) {
                $kelurahan->update([
                    'ketua_kelurahan' => $data->id
                ]);
            } else {
                $kelurahan->update([
                    'ketua_kelurahan' => null
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollback(); //* DB Transaction Failed
            return redirect()
                ->route('kelurahan.createKetuaKelurahan', $kelurahan_id)
                ->withErrors("Terjadi kesalahan, silahkan hubungi administrator");
        }
        DB::commit(); //* DB Transaction Success

        return redirect()
            ->route('kelurahan.createKetuaKelurahan', $kelurahan_id)
            ->withSuccess("Selamat, Data berhasil diperbarui.");
    }

    public function deleteKetua($id)
    {
        $data = MappingKelurahan::find($id);

        if ($data->status == 1) {
            $ketua_kelurahan = Kelurahan::where('ketua_kelurahan', $id)->first();
            $ketua_kelurahan->update([
                'ketua_kelurahan' => null
            ]);
        }

        $data->delete();

        return response()->json(['message' => "Berhasil menghapus data."]);
    }
}
