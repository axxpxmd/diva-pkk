<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;

// Models
use App\Models\Dasawisma;
use App\Models\RTRW;
use App\Models\User;

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

        return view('pages.kader.index', compact(
            'title',
            'desc',
            'active_kader'
        ));
    }

    public function dataTable()
    {
        $data = User::all();

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
}
