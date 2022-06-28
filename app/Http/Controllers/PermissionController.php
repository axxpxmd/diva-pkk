<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;

// Models
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    protected $title = 'Permission';
    protected $desc  = 'Menu ini berisikan data Permission';
    protected $active_permission = true;

    public function __construct()
    {
        $this->middleware(['permission:permission']);
    }

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_permission = $this->active_permission;

        if ($request->ajax()) {
            return $this->dataTable();
        }

        return view('pages.permission.index', compact(
            'title',
            'desc',
            'active_permission'
        ));
    }

    public function dataTable()
    {
        $data = Permission::all();

        return DataTables::of($data)
            ->rawColumns(['id', 'nama'])
            ->addColumn('action', function ($p) {
                return '<a href="#" onclick="edit(' . $p->id . ')" class="text-info m-r-5" title="Edit Data"><i class="bi bi-pencil-fill"></i></a>
                        <a href="#" onclick="remove(' . $p->id . ')" class="text-danger" title="Delete Data"><i class="bi bi-trash-fill"></i></a>';
            })
            ->rawColumns(['id', 'action'])
            ->addIndexColumn()
            ->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);

        $input = $request->all();
        Permission::create($input);

        return response()->json(['message' => "Berhasil menyiman data."]);
    }

    public function edit($id)
    {
        $data = Permission::find($id);

        return $data;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id
        ]);

        $input = $request->all();
        $permission = Permission::findOrFail($id);
        $permission->update($input);

        return response()->json(['message' => "Berhasil memperbaharui data."]);
    }

    public function destroy($id)
    {
        Permission::destroy($id);

        return response()->json(['message' => "Berhasil menghapus data."]);
    }
}
