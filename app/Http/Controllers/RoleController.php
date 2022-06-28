<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;

// Models
use App\Models\RoleHasPermission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    protected $title = 'Role';
    protected $desc  = 'Menu ini berisikan data Role';
    protected $active_role = true;

    public function __construct()
    {
        $this->middleware(['permission:role']);
    }

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_role = $this->active_role;

        if ($request->ajax()) {
            return $this->dataTable();
        }

        return view('pages.role.index', compact(
            'title',
            'desc',
            'active_role'
        ));
    }

    public function dataTable()
    {
        $data = Role::all();

        return DataTables::of($data)
            ->rawColumns(['id', 'nama'])
            ->addColumn('action', function ($p) {
                return '<a href="#" onclick="edit(' . $p->id . ')" class="text-info m-r-5" title="Edit Data"><i class="bi bi-pencil-fill"></i></a>
                        <a href="#" onclick="remove(' . $p->id . ')" class="text-danger" title="Delete Data"><i class="bi bi-trash-fill"></i></a>';
            })
            ->addColumn('permissions', function ($p) {
                return count($p->permissions) . " <a href='" . route('role.permission', $p->id) . "' class='text-success pull-right' title='Edit Permissions'><i class='bi bi-clipboard2-fill m-l-5'></i></a>";
            })
            ->rawColumns(['id', 'action', 'permissions'])
            ->addIndexColumn()
            ->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        $input = $request->all();
        Role::create($input);

        return response()->json(['message' => "Berhasil menyiman data."]);
    }

    public function edit($id)
    {
        return Role::find($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id
        ]);

        $input = $request->all();
        $role  = Role::findOrFail($id);
        $role->update($input);

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil diperbaharui.'
        ]);

        return response()->json(['message' => "Berhasil memperbaharui data."]);
    }

    public function destroy($id)
    {
        Role::destroy($id);

        return response()->json(['message' => "Berhasil menghapus data."]);
    }

    public function permission($id)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_role = $this->active_role;

        $role  = Role::findOrFail($id);
        $exist_permission = RoleHasPermission::select('permission_id')->whererole_id($id)->get()->toArray();
        $permissions      = Permission::select('id', 'name')->whereNotIn('id', $exist_permission)->get();

        return view('pages.role.permission', compact(
            'title',
            'desc',
            'active_role',
            'permissions',
            'role'
        ));
    }

    public function getPermission($id)
    {
        $data = Role::findOrFail($id);

        return $data->permissions;
    }

    public function storePermission(Request $request)
    {
        $request->validate([
            'permissions' => 'required'
        ]);

        $data = Role::findOrFail($request->id);
        $data->givePermissionTo($request->permissions);

        return response()->json(['message' => "Berhasil menyimpan data."]);
    }

    public function destroyPermission(Request $request, $name)
    {
        $data = Role::findOrFail($request->id);
        $data->revokePermissionTo($name);

        return response()->json(['success' => true]);
    }
}
