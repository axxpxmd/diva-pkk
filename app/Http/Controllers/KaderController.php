<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Models
use App\Models\RTRW;
use App\Models\User;
use App\Models\ModelHasRole;
use Spatie\Permission\Models\Role;

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

        $rtrws = RTRW::groupBy('kelurahan_id')->get();
        $roles = Role::select('id', 'name')->get();

        return view('pages.kader.index', compact(
            'title',
            'desc',
            'active_kader',
            'rtrws',
            'roles'
        ));
    }

    public function dataTable()
    {
        $data = User::join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->whereNotIn('model_has_roles.role_id', [1])
            ->get();

        return DataTables::of($data)
            ->rawColumns(['id', 'nama'])
            ->addColumn('action', function ($p) {
                return '<a href="#" onclick="edit(' . $p->id . ')" class="text-info m-r-5" title="Edit Data"><i class="bi bi-pencil-fill"></i></a>
                        <a href="#" onclick="remove(' . $p->id . ')" class="text-danger" title="Delete Data"><i class="bi bi-trash-fill"></i></a>';
            })
            ->editColumn('dasawisma_id', function ($p) {
                return $p->dasawisma->nama;
            })
            ->addColumn('alamat', function ($p) {
                return $p->rtrw->kecamatan->n_kecamatan . ' - ' . $p->rtrw->kelurahan->n_kelurahan . ' - RT ' . $p->rtrw->rt . ' / RW ' . $p->rtrw->rw;
            })
            ->rawColumns(['id', 'action'])
            ->addIndexColumn()
            ->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required|digits:16|unique:users,nik',
            'rtrw_id' => 'required',
            'dasawisma_id' => 'required',
            'role_id' => 'required'
        ], [
            'rtrw_id.required' => 'Alamat wajib diisi',
            'dasawisma_id.required' => 'Dasawisma wajib diisi',
            'role_id.required' => 'Role Wajib diisi'
        ]);

        /* Tahapan : 
         * 1. tmusers
         * 2. model_has_roles
         */

        DB::beginTransaction(); //* DB Transaction Begin

        try {
            //* Tahap 1
            $data_user = [
                'username' => $request->username,
                'password' => \md5('123456789'),
                'rtrw_id' => $request->rtrw_id,
                'dasawisma_id' => $request->dasawisma_id,
                'nama' => $request->nama,
                'nik' => $request->nik,
                'foto' => 'default.png',
                's_aktif' => 1
            ];

            $user = User::create($data_user);

            //* Tahap 2
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
        $data = User::where('id', $id)->with('modelHasRole')->first();

        $data_user = [
            'id' => $data->id,
            'username' => $data->username,
            'nama' => $data->nama,
            'nik' => $data->nik,
            'rtrw_id' => $data->rtrw_id,
            'dasawisma_id' => $data->dasawisma_id,
            'role_id' => $data->modelHasRole->role_id
        ];

        return $data_user;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required|digits:16|unique:users,nik,' . $id,
            'rtrw_id' => 'required',
            'dasawisma_id' => 'required',
            'role_id' => 'required'
        ], [
            'rtrw_id.required' => 'Alamat wajib diisi',
            'dasawisma_id.required' => 'Dasawisma wajib diisi',
            'role_id.required' => 'Role Wajib diisi'
        ]);

        /* Tahapan : 
         * 1. tmusers
         * 2. model_has_roles
         */

        DB::beginTransaction(); //* DB Transaction Begin

        try {
            //* Tahap 1
            $data_user = [
                'username' => $request->username,
                'rtrw_id' => $request->rtrw_id,
                'dasawisma_id' => $request->dasawisma_id,
                'nama' => $request->nama,
                'nik' => $request->nik,
                'foto' => 'default.png',
                's_aktif' => 1
            ];

            $data = User::find($id);
            $data->update($data_user);

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

        //TODO: Process delete photo
        if ($data_user->foto != 'default.png') {
            // $exist = $data_user->foto;
            // $path  = $this->path . $exist;
            // \File::delete(public_path($path));
        }

        $data_user->delete();

        return response()->json(['message' => "Berhasil menghapus data."]);
    }
}
