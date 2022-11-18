<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\Pengajuan;
use Carbon\Carbon;

class PengajuanController extends Controller
{
    protected $title = 'Pengajuan';
    protected $desc  = 'Menu ini berisikan data pengajuan';
    protected $active_pengajuan = true;

    public function __construct()
    {
        $this->middleware(['permission:pengajuan']);
    }

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_pengajuan = $this->active_pengajuan;

        if ($request->ajax()) {
            return $this->dataTable();
        }

        return view('pages.pengajuan.index', compact(
            'title',
            'desc',
            'active_pengajuan'
        ));
    }

    public function dataTable()
    {
        $data = Pengajuan::queryTable();

        return DataTables::of($data)
            ->addColumn('nama', function ($p) {
                $action = "<a href='" . route('rumah.show', $p->id) . "' class='text-info' title='Menampilkan Data'>" . $p->anggota->nama . "</a>";

                return $action;
            })
            ->editColumn('tgl_pengajuan', function ($p) {
                return Carbon::createFromFormat('Y-m-d', $p->tgl_pengajuan)->format('d M Y');
            })
            ->addColumn('jml_perihal', function ($p) {
                return $p->perihal->count() . ' Perihal ';
            })
            ->addColumn('surat', function ($p) {
                return  "<a target='blank' href='" . route('pengajuan.cetak', $p->id) . "' class='text-info' title='Surat'><i class='bi bi-file-text'></i></a>";
            })
            ->addColumn('action', function ($p) {
                return '-';
            })
            ->rawColumns(['id', 'nama', 'surat'])
            ->addIndexColumn()
            ->toJson();
    }

    public function cetak($id)
    {
        $data = Pengajuan::find($id);

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('legal', 'portrait');
        $pdf->loadView('pages.pengajuan.surat', compact(
            'data'
        ));

        return $pdf->stream($data->anggota->nama . ' ( ' . $data->tgl_pengajuan . ' ) ' . ".pdf");
    }
}
