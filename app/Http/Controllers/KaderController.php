<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

// Models
use App\Models\RTRW;
use App\Models\User;
use App\Models\Kecamatan;
use App\Models\ModelHasRole;
use App\Models\DasawismaUser;

class KaderController extends Controller
{
    protected $title = 'Kader';
    protected $desc  = 'Menu ini berisikan data Kader';
    protected $active_kader = true;

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_kader = $this->active_kader;

        if ($request->ajax()) {
            return $this->dataTable();
        }

        $rtrws = RTRW::select('id', 'kecamatan_id', 'kelurahan_id', 'rt', 'rw');
        $rtrwAlls = $rtrws->get();
        $rtrwKelurahans = $rtrws->groupBy('kelurahan_id')->get();
        $roles = Role::select('id', 'name')->whereNotIn('id', [1])->get();
        $kecamatans = Kecamatan::select('id', 'n_kecamatan')->where('kabupaten_id', 40)->get();

        return view('pages.kader.index', compact(
            'title',
            'desc',
            'active_kader',
            'rtrws',
            'roles',
            'rtrwKelurahans',
            'rtrwAlls',
            'kecamatans'
        ));
    }

    public function dataTable()
    {
        $data = User::queryTable();

        return DataTables::of($data)
            ->rawColumns(['id', 'nama'])
            ->addColumn('action', function ($p) {
                $edit = '<a href="#" onclick="edit(' . $p->id . ')" class="text-info m-r-5" title="Edit Data"><i class="bi bi-pencil-fill"></i></a>';
                $delete = '<a href="#" onclick="remove(' . $p->id . ')" class="text-danger" title="Delete Data"><i class="bi bi-trash-fill"></i></a>';

                return $edit . $delete;
            })
            ->editColumn('dasawisma_id', function ($p) {
                return $p->dasawisma->nama;
            })
            ->addColumn('alamat', function ($p) {
                return $p->alamat;
            })
            ->rawColumns(['id', 'action', 'alamat'])
            ->addIndexColumn()
            ->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required|digits:16|unique:users,nik|numeric',
            'dasawisma_id' => 'required',
            'role_id' => 'required',
            'no_telp' => 'required|digits:13||unique:users,no_telp|numeric'
        ], [
            'dasawisma_id.required' => 'Dasawisma wajib diisi',
            'role_id.required' => 'Role Wajib diisi'
        ]);

        /* Tahapan : 
         * 1. users
         * 2. dasawimsa_users
         * 3. model_has_roles
         */

        DB::beginTransaction(); //* DB Transaction Begin

        try {
            //* Tahap 1
            $data_user = [
                'username' => $request->username,
                'password' => \md5('123456789'),
                'dasawisma_id' => $request->dasawisma_id,
                'rtrw_id' => $request->rtrw_id,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'nama' => $request->nama,
                'nik' => $request->nik,
                'foto' => 'default.png',
                's_aktif' => 1
            ];
            $user = User::create($data_user);

            //* Tahap 2
            $data_dasawisma_user = [
                'user_id' => $user->id,
                'dasawisma_id' => $request->dasawisma_id,
            ];
            DasawismaUser::create($data_dasawisma_user);

            //* Tahap 3
            $path = 'app\Models\User';
            $role_id = $request->role_id;

            $model_has_role = new ModelHasRole();
            $model_has_role->role_id    = $role_id;
            $model_has_role->model_type = $path;
            $model_has_role->model_id   = $user->id;
            $model_has_role->save();
        } catch (\Throwable $th) {
            DB::rollback(); //* DB Transaction Failed
            return response()->json(['message' => "Terjadi kesalahan, silahkan hubungi administrator"], 500);
        }

        DB::commit(); //* DB Transaction Success

        return response()->json(['message' => "Berhasil menyiman data."]);
    }

    public function edit($id)
    {
        $data = User::where('id', $id)->with(['modelHasRole', 'dasawisma'])->first();

        $data_user = [
            'id' => $data->id,
            'username' => $data->username,
            'nama' => $data->nama,
            'nik' => $data->nik,
            'alamat' => $data->alamat,
            'no_telp' => $data->no_telp,
            'dasawisma_id' => $data->dasawisma_id,
            'role_id' => $data->modelHasRole->role_id,
            'rtrw_id' => $data->dasawisma->rtrw_id,
            'kecamatan_id' => $data->dasawisma->rtrw->kecamatan_id,
            'kelurahan_id' => $data->dasawisma->rtrw->kelurahan_id
        ];

        return $data_user;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required|digits:16|numeric|unique:users,nik,' . $id,
            'no_telp' => 'required|digits:13|numeric|unique:users,no_telp,' . $id,
            'dasawisma_id' => 'required',
            'role_id' => 'required'
        ], [
            'dasawisma_id.required' => 'Dasawisma wajib diisi',
            'role_id.required' => 'Role Wajib diisi'
        ]);

        /* Tahapan : 
         * 1. users
         * 2. dasawisma_users
         * 2. model_has_roles
         */

        DB::beginTransaction(); //* DB Transaction Begin

        try {
            //* Tahap 1
            $data_user = [
                'username' => $request->username,
                'dasawisma_id' => $request->dasawisma_id,
                'nama' => $request->nama,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'nik' => $request->nik,
                's_aktif' => 1
            ];
            $data = User::find($id);
            $data->update($data_user);

            //* Tahap 2
            $data_dasawisma_user = DasawismaUser::where('user_id', $id)->first();
            $data_dasawisma_user->update([
                'dasawisma_id' => $request->dasawisma_id,
            ]);

            //* Tahap 2
            $model_has_role = ModelHasRole::where('model_id', $id);
            $model_has_role->update([
                'role_id' => $request->role_id
            ]);
        } catch (\Throwable $th) {
            DB::rollback(); //* DB Transaction Failed
            return response()->json(['message' => "Terjadi kesalahan, silahkan hubungi administrator"], 500);
        }

        DB::commit(); //* DB Transaction Success

        return response()->json(['message' => "Berhasil memperbaharui data."]);
    }

    public function destroy($id)
    {
        $data_user = User::find($id);
        $data_dasawisma_user = DasawismaUser::where('user_id', $id)->first();

        //TODO: Process delete photo
        if ($data_user->foto != 'default.png') {
            // $exist = $data_user->foto;
            // $path  = $this->path . $exist;
            // \File::delete(public_path($path));
        }

        $data_user->delete();
        $data_dasawisma_user->delete();

        return response()->json(['message' => "Berhasil menghapus data."]);
    }
}
