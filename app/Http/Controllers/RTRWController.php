<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;

// Models
use App\Models\RTRW;

class RTRWController extends Controller
{
    protected $title = 'RT/RW';
    protected $desc  = 'Menu ini berisikan data RT / RW';
    protected $active_rtrw = true;

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_rtrw = $this->active_rtrw;

        if ($request->ajax()) {
            return $this->dataTable();
        }

        return view('rtrw.index', compact(
            'title',
            'desc',
            'active_rtrw'
        ));
    }

    public function dataTable()
    {
        $data = RTRW::all();

        return DataTables::of($data)
            ->rawColumns(['id', 'nama'])
            ->addIndexColumn()
            ->toJson();
    }

    public function create()
    {
        // 
    }
}
