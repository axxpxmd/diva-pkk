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
                return count($p->permissions) . " <a href='" . route('role.permission', $p->id) . "' class='text-success pull-right' title='Edit Permissions'><i class='icon-clipboard-list2 mr-1'></i></a>";
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
        // 
    }
}
