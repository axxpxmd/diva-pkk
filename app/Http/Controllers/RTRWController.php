<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use App\Http\Helpers\CheckRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\RTRW;
use App\Models\User;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\MappingRT;
use App\Models\MappingRW;
use App\Models\ModelHasRole;

class RTRWController extends Controller
{
    protected $title = 'RT/RW';
    protected $desc  = 'Menu ini berisikan data RT / RW';
    protected $active_rtrw = true;

    public function __construct(CheckRole $checkRole)
    {
        $this->middleware(['permission:rt/rw']);
        $this->checkRole = $checkRole;
    }

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_rtrw = $this->active_rtrw;

        list($dasawisma_id, $kecamatan_id, $kelurahan_id, $rtrw_id, $rw, $rt, $role_id) = $this->checkRole->getFilterValue();

        $kecamatan_id = $kecamatan_id ? $kecamatan_id : $request->kecamatan_filter;
        $kelurahan_id = $kelurahan_id ? $kelurahan_id : $request->kelurahan_filter;
        $rw = $rw ? $rw : $request->rw_filter;
        if ($request->ajax()) {
            return $this->dataTable($kecamatan_id, $kelurahan_id, $rw, $role_id);
        }

        $kecamatans = Kecamatan::select('id', 'n_kecamatan')->where('kabupaten_id', 40)->get();

        // Filter
        $rwDisplay = true;
        $kecamatanDisplay = true;
        $kelurahanDisplay = true;

        // Total
        $totalRT = RTRW::count();
        $totalRW = RTRW::groupBy('rw')->count();

        return view('pages.rtrw.index', compact(
            'title',
            'desc',
            'active_rtrw',
            'kecamatans',
            'kecamatanDisplay',
            'kelurahanDisplay',
            'rwDisplay',
            'totalRT',
            'totalRW',
            'role_id'
        ));
    }

    public function dataTable($kecamatan_id, $kelurahan_id, $rw, $role_id)
    {
        $data = RTRW::queryTable($kecamatan_id, $kelurahan_id, $rw);

        return DataTables::of($data)
            ->addColumn('action', function ($p) use($role_id) {
                $checkDasawisma = $p->dasawisma->count();
                $checkKetuaRT = $p->ketuaRT->count();
                $checkKetuaRW = $p->ketua_rw;

                $edit = '<a href="#" onclick="edit(' . $p->id . ')" class="text-info m-r-5" title="Edit Data"><i class="bi bi-pencil-fill"></i></a>';
                $delete = '<a href="#" onclick="remove(' . $p->id . ')" class="text-danger" title="Delete Data"><i class="bi bi-trash-fill"></i></a>';

                if ($role_id == 3 || $role_id == 4) {
                    return '-';
                } else {
                    if ($checkDasawisma || $checkKetuaRT || $checkKetuaRW) {
                        return $edit;
                    } else {
                        return $edit . $delete;
                    }
                }
            })
            ->editColumn('rt', function ($p) {
                $action = "<a href='" . route('rt-rw.show', [$p->id, 'kategori=rt']) . "' class='text-info' title='Menampilkan Data'>" . $p->rt . "</a>";

                return $action;
            })
            ->editColumn('rw', function ($p) {
                $action = "<a href='" . route('rt-rw.show', [$p->id, 'kategori=rw']) . "' class='text-info' title='Menampilkan Data'>" . $p->rw . "</a>";

                return $action;
            })
            ->editColumn('kecamatan_id', function ($p) {
                return $p->n_kecamatan;
            })
            ->addColumn('jumlah', function ($p) {
                return 'Rumah ' . $p->rumah->count() . ' / ' . 'KK ' . $p->kk->count() . ' / ' . 'Warga ' . $p->warga->count();
            })
            ->editColumn('ketua_rt', function ($p) use ($role_id) {
                $add = "<a href='" . route('rt-rw.createKetuaRT', [$p->id, 'kategori=rt']) . "' class='text-info' title='Tambah Ketua RT'><i class='bi bi-person-plus-fill'></i></a>";

                if ($p->ketua_rt) {
                    $mappingRtRw = MappingRT::where('id', $p->ketua_rt)->first();
                    if ($role_id == 3 || $role_id == 4) {
                        return $mappingRtRw->ketua;
                    } else {
                        return $mappingRtRw->ketua . '&nbsp&nbsp&nbsp' . $add;
                    }
                } else {
                    if ($role_id == 3 || $role_id == 4) {
                       return '-';
                    } else {
                        return $add;
                    }
                }
            })
            ->editColumn('ketua_rw', function ($p) use ($role_id) {
                $add = "<a href='" . route('rt-rw.createKetuaRT', [$p->id, 'kategori=rw']) . "' class='text-info' title='Tambah Ketua RT'><i class='bi bi-person-plus-fill'></i></a>";

                if ($p->ketua_rw) {
                    $mappingRW = MappingRW::where('id', $p->ketua_rw)->first();

                    if ($role_id == 3 || $role_id == 4) {
                        return $mappingRW->ketua;
                    } else {
                        return $mappingRW->ketua . '&nbsp&nbsp&nbsp' . $add;
                    }
                } else {
                    if ($role_id == 3 || $role_id == 4) {
                        return '-';
                     } else {
                         return $add;
                     }
                }
            })
            ->editColumn('kelurahan_id', function ($p) {
                return $p->n_kelurahan;
            })
            ->rawColumns(['id', 'action', 'rt', 'rw', 'ketua_rt', 'ketua_rw'])
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

        $kelurahan = Kelurahan::find($kelurahan_id);
        $n_kelurahan = $kelurahan->n_kelurahan;
        $n_kecamatan = $kelurahan->kecamatan->n_kecamatan;

        //* Check existing data
        $check = RTRW::where('kecamatan_id', $kecamatan_id)->where('kelurahan_id', $kelurahan_id)->where('rt', $rt)->where('rw', $rw)->first();
        if ($check) {
            return response()->json(['message' => "Data sudah pernah disimpan."], 422);
        }

        $input = $request->all();
        RTRW::create(array_merge($input, ['n_kecamatan' => $n_kecamatan, 'n_kelurahan' => $n_kelurahan]));

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

        $kelurahan = Kelurahan::find($kelurahan_id);
        $n_kelurahan = $kelurahan->n_kelurahan;
        $n_kecamatan = $kelurahan->kecamatan->n_kecamatan;

        //* Check existing data
        $check = RTRW::where('kecamatan_id', $kecamatan_id)->where('kelurahan_id', $kelurahan_id)->where('rt', $rt)->where('rw', $rw)->count();
        if ($check == 2) {
            return response()->json(['message' => "Data sudah pernah disimpan."], 422);
        }

        $input = $request->all();
        $data  = RTRW::find($id);
        $data->update(array_merge($input, ['n_kecamatan' => $n_kecamatan, 'n_kelurahan' => $n_kelurahan]));

        return response()->json(['message' => "Berhasil memperbaharui data."]);
    }

    public function show(Request $request, $id)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_rtrw = $this->active_rtrw;
        $kategori = $request->kategori;

        $data = RTRW::find($id);

        if ($kategori == 'rt') {
            $listKetua = MappingRT::where('rtrw_id', $id)->get();
        }

        $totalRT = 0;
        if ($kategori == 'rw') {
            $listKetua = MappingRW::where('kecamatan_id', $data->kecamatan_id)->where('kelurahan_id', $data->kelurahan_id)->where('rw', $data->rw)->get();
            $totalRT   = RTRW::where('kecamatan_id', $data->kecamatan_id)->where('kelurahan_id', $data->kelurahan_id)->where('rw', $data->rw)->get();
        }

        return view('pages.rtrw.show', compact(
            'title',
            'desc',
            'active_rtrw',
            'listKetua',
            'kategori',
            'data',
            'totalRT'
        ));
    }

    public function destroy($id)
    {
        RTRW::destroy($id);

        return response()->json(['message' => "Berhasil menghapus data."]);
    }

    public function createKetuaRT(Request $request, $id)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_rtrw = $this->active_rtrw;

        $kategori = $request->kategori;

        $rtrw = RTRW::find($id);

        if ($kategori == 'rt') {
            $datas = MappingRT::where('rtrw_id', $id)->get();
        } else {
            $datas = MappingRW::where('kecamatan_id', $rtrw->kecamatan_id)
                ->where('kelurahan_id', $rtrw->kelurahan_id)
                ->where('rw', $rtrw->rw)->get();
        }

        return view('pages.rtrw.form_ketua_rt', compact(
            'title',
            'desc',
            'active_rtrw',
            'rtrw',
            'datas',
            'kategori'
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

        $kategori = $request->kategori;
        $status = $request->status;
        $rtrw_id = $request->rtrw_id;

        $rtrw = RTRW::find($rtrw_id);
        $kecamatan_id = $rtrw->kecamatan_id;
        $kelurahan_id = $rtrw->kelurahan_id;
        $rw = $rtrw->rw;

        /**
         * Tahapan
         * 1. Store Ketua RT
         *    1.1 Check status aktif ketua RT
         *    1.2 rt_mappings (create)
         *    1.3 rt_rw (update)
         *    1.4 users (create)
         *    1.5 model_has_roles (create)
         * 2. Store Ketua RW
         *    2.1 Check status aktif ketua RW
         *    2.2 rw_mappings (create)
         *    2.3 rt_rw (update)
         *    2.4 user (create)
         *    2.5 model_has_roles (create)
         */

        //* Tahap 1
        if ($kategori == 'rt') {
            DB::beginTransaction(); //* DB Transaction Begin
            try {
                //* Tahap 1.1
                if ($status == 1) {
                    $mappingRtRw = MappingRT::where('rtrw_id', $rtrw_id)->where('status', 1)->count();
                    if ($mappingRtRw != 0) {
                        return redirect()
                            ->route('rt-rw.createKetuaRT', [$rtrw_id, 'kategori=' . $kategori])
                            ->withErrors("Terdapat Ketua yang masih aktif menjabat.");
                    }
                }

                //* Tahap 1.2
                $input = $request->all();
                $input = $request->except(['kategori']);
                $data  = MappingRT::create($input);

                //* Tahap 1.3
                if ($status == 1) {
                    $rtrw->update([
                        'ketua_rt' => $data->id
                    ]);
                }

                $checkUser = User::where('nik', $request->nik)->count();
                if (!$checkUser) {
                    //* Tahap 1.4
                    $data_user = [
                        'dasawisma_id' => 0,
                        'rtrw_id' => $rtrw_id,
                        'kecamatan_id' => $rtrw->kecamatan_id,
                        'kelurahan_id' => $rtrw->kelurahan_id,
                        'rw' => $rtrw->rw,
                        'rt' => $rtrw->rt,
                        'username' => $request->nik,
                        'password' => \md5('123456789'),
                        'no_telp' => $request->no_hp,
                        's_aktif' => $status == 1 ? 1 : 0,
                        'nama' => $request->ketua,
                        'nik' => $request->nik,
                        'foto' => 'default.png'
                    ];
                    $userRT = User::create($data_user);

                    //* Tahap 1.5
                    $model_has_role = new ModelHasRole();
                    $model_has_role->role_id    = 3;
                    $model_has_role->model_type = 'app\Models\User';
                    $model_has_role->model_id   = $userRT->id;
                    $model_has_role->save();
                }
            } catch (\Throwable $th) {
                DB::rollback(); //* DB Transaction Failed
                return redirect()
                    ->route('rt-rw.createKetuaRT', [$rtrw_id, 'kategori=' . $kategori])
                    ->withErrors("Terjadi kesalahan, silahkan hubungi administrator");
            }
            DB::commit(); //* DB Transaction Success
        }

        //* Tahap 2
        if ($kategori == 'rw') {
            DB::beginTransaction(); //* DB Transaction Begin
            try {
                //* Tahap 1.1
                if ($status == 1) {
                    $mappingRW = MappingRW::where('kecamatan_id', $kecamatan_id)
                        ->where('kelurahan_id', $kelurahan_id)
                        ->where('rw', $rw)
                        ->where('status', 1)->first();
                    if ($mappingRW != 0) {
                        return redirect()
                            ->route('rt-rw.createKetuaRT', [$rtrw_id, 'kategori=' . $kategori])
                            ->withErrors("Terdapat Ketua yang masih aktif menjabat.");
                    }
                }

                //* Tahap 2.2
                $input = [
                    'ketua' => $request->ketua,
                    'no_hp' => $request->no_hp,
                    'nik' => $request->nik,
                    'awal_menjabat' => $request->awal_menjabat,
                    'akhir_menjabat' => $request->akhir_menjabat,
                    'status' => $request->status,
                    'kecamatan_id' => $kecamatan_id,
                    'kelurahan_id' => $kelurahan_id,
                    'rw' => $rw
                ];
                $data = MappingRW::create($input);

                //* Tahap 2.3
                if ($status == 1) {
                    $rtrws = RTRW::where('kecamatan_id', $kecamatan_id)
                        ->where('kelurahan_id', $kelurahan_id)
                        ->where('rw', $rw)
                        ->get();
                    foreach ($rtrws as $i) {
                        $i->update([
                            'ketua_rw' => $data->id
                        ]);
                    }
                }

                $checkUser = User::where('nik', $request->nik)->count();
                if (!$checkUser) {
                    //* Tahap 2.4
                    $data_user = [
                        'dasawisma_id' => 0,
                        'rtrw_id' => 0,
                        'rtrw_id' => $rtrw_id,
                        'kecamatan_id' => $rtrw->kecamatan_id,
                        'kelurahan_id' => $rtrw->kelurahan_id,
                        'rw' => $rtrw->rw,
                        'username' => $request->nik,
                        'password' => \md5('123456789'),
                        'no_telp' => $request->no_hp,
                        's_aktif' => 1,
                        'nama' => $request->ketua,
                        'nik' => $request->nik,
                        'foto' => 'default.png'
                    ];
                    $userRW = User::create($data_user);

                    //* Tahap 1.5
                    $model_has_role = new ModelHasRole();
                    $model_has_role->role_id    = 4;
                    $model_has_role->model_type = 'app\Models\User';
                    $model_has_role->model_id   = $userRW->id;
                    $model_has_role->save();
                }
            } catch (\Throwable $th) {
                DB::rollback(); //* DB Transaction Failed
                return redirect()
                    ->route('rt-rw.createKetuaRT', [$rtrw_id, 'kategori=' . $kategori])
                    ->withErrors("Terjadi kesalahan, silahkan hubungi administrator");
            }
            DB::commit(); //* DB Transaction Success
        }

        return redirect()
            ->route('rt-rw.createKetuaRT', [$rtrw_id, 'kategori=' . $kategori])
            ->withSuccess("Selamat, Data berhasil tersimpan.");
    }

    public function editKetuaRT(Request $request, $id)
    {
        $kategori = $request->kategori;

        if ($kategori == 'rt') {
            $data = MappingRT::find($id);
        }

        if ($kategori == 'rw') {
            $data = MappingRW::find($id);
        }

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

        /**
         * Tahapan
         * 1. Update Ketua RT
         *    1.1 Check status aktif ketua RT
         *    1.2 rt_mappings (update)
         *    1.3 rt_rw (update)
         *    1.4 users (update)
         * 2. Update Ketua RW
         *    2.1 Check status aktif ketua RW
         *    2.2 rw_mappings (update)
         *    2.3 rt_rw (update)
         *    2.4 users (update)
         */

        $kategori = $request->kategori;
        $status = $request->status;
        $id = $request->id;
        $rtrw_id = $request->rtrw_id;

        $rtrw = RTRW::find($rtrw_id);
        $kecamatan_id = $rtrw->kecamatan_id;
        $kelurahan_id = $rtrw->kelurahan_id;
        $rw = $rtrw->rw;

        //* Tahap 1
        if ($kategori == 'rt') {
            DB::beginTransaction(); //* DB Transaction Begin
            try {
                //* Tahap 1.1
                if ($status == 1) {
                    $mappingRtRw = MappingRT::where('rtrw_id', $rtrw_id)->whereNotIn('id', [$id])->where('status', 1)->count();
                    if ($mappingRtRw != 0) {
                        return redirect()
                            ->route('rt-rw.createKetuaRT', [$rtrw_id, 'kategori=' . $kategori])
                            ->withErrors("Terdapat Ketua yang masih aktif menjabat.");
                    }
                }

                //* Tahap 1.4
                $data  = MappingRT::find($id);
                $user = User::where('nik', $data->nik)->first();
                $user->update([
                    's_aktif' => $status == 1 ? 1 : 0,
                    'nik' => $request->nik,
                    'no_telp' => $request->no_telp,
                    'nama' => $request->ketua
                ]);

                //* Tahap 1.2
                $input = $request->all();
                $input = $request->except(['kategori']);
                $data  = MappingRT::find($id);
                $data->update($input);

                //* Tahap 1.3
                $rtrw = RTRW::find($rtrw_id);
                if ($status == 1) {
                    $rtrw->update([
                        'ketua_rt' => $data->id
                    ]);
                } else {
                    $rtrw->update([
                        'ketua_rt' => null
                    ]);
                }
            } catch (\Throwable $th) {
                DB::rollback(); //* DB Transaction Failed
                return response()->json(['message' => "Terjadi kesalahan, silahkan hubungi administrator"], 500);
            }
            DB::commit(); //* DB Transaction Success
        }

        //* Tahap 2
        if ($kategori == 'rw') {
            DB::beginTransaction(); //* DB Transaction Begin
            try {
                //* Tahap 1.1
                if ($status == 1) {
                    $mappingRW = MappingRW::where('kecamatan_id', $kecamatan_id)
                        ->where('kelurahan_id', $kelurahan_id)
                        ->where('rw', $rw)
                        ->whereNotIn('id', [$id])
                        ->where('status', 1)
                        ->count();
                    if ($mappingRW != 0) {
                        return redirect()
                            ->route('rt-rw.createKetuaRT', [$rtrw_id, 'kategori=' . $kategori])
                            ->withErrors("Terdapat Ketua yang masih aktif menjabat.");
                    }
                }

                //* Tahap 1.4
                $data = MappingRW::find($id);
                $user = User::where('nik', $data->nik)->first();
                $user->update([
                    's_aktif' => $status == 1 ? 1 : 0,
                    'nik' => $request->nik,
                    'no_telp' => $request->no_telp,
                    'nama' => $request->ketua
                ]);

                //* Tahap 1.2
                $input = [
                    'ketua' => $request->ketua,
                    'no_hp' => $request->no_hp,
                    'nik' => $request->nik,
                    'awal_menjabat' => $request->awal_menjabat,
                    'akhir_menjabat' => $request->akhir_menjabat,
                    'status' => $request->status
                ];
                $data = MappingRW::find($id);
                $data->update($input);

                //* Tahap 1.3
                $rtrws = RTRW::where('kecamatan_id', $kecamatan_id)
                    ->where('kelurahan_id', $kelurahan_id)
                    ->where('rw', $rw)
                    ->get();
                if ($status == 1) {
                    foreach ($rtrws as $i) {
                        $i->update([
                            'ketua_rw' => $data->id
                        ]);
                    }
                } else {
                    foreach ($rtrws as $i) {
                        $i->update([
                            'ketua_rw' => null
                        ]);
                    }
                }
            } catch (\Throwable $th) {
                DB::rollback(); //* DB Transaction Failed
                return response()->json(['message' => "Terjadi kesalahan, silahkan hubungi administrator"], 500);
            }
            DB::commit(); //* DB Transaction Success
        }

        return redirect()
            ->route('rt-rw.createKetuaRT', [$rtrw_id, 'kategori=' . $kategori])
            ->withSuccess("Selamat, Data berhasil diperbarui.");
    }

    public function deteleKetuaRT(Request $request, $id)
    {
        $kategori = $request->kategori;

        if ($kategori == 'rt') {
            $data = MappingRT::find($id);

            if ($data->status == 1) {
                $ketua_rt = RTRW::where('ketua_rt', $id)->first();
                $ketua_rt->update([
                    'ketau_rt' => null
                ]);
            }

            $data->delete();
        }

        if ($kategori == 'rw') {
            $data = MappingRW::destroy($id);

            if ($data->status == 1) {
                $ketua_rw = RTRW::where('ketua_rw', $id)->first();
                $ketua_rw->update([
                    'ketau_rw' => null
                ]);
            }

            $data->delete();
        }

        return response()->json(['message' => "Berhasil menghapus data."]);
    }
}
