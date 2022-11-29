<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;

use App\Http\Helpers\CheckRole;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\User;
use App\Models\Pengajuan;
use App\Models\Kecamatan;

class PengajuanController extends Controller
{
    protected $title = 'Pengajuan';
    protected $desc  = 'Menu ini berisikan data pengajuan surat warga';
    protected $active_pengajuan = true;

    public function __construct(CheckRole $checkRole)
    {
        $this->middleware(['permission:pengajuan']);
        $this->checkRole = $checkRole;
    }

    public function checkFilter()
    {
        $role_id = Auth::user()->modelHasRole->role_id;

        // Filter
        if ($role_id == 3) {
            $rtrwDisplay = true;
            $rwDisplay = false;
            $rtDisplay = false;
        } else {
            $rtrwDisplay = false;
            $rwDisplay = true;
            $rtDisplay = true;
        }

        $kecamatanDisplay = true;
        $kelurahanDisplay = true;

        return [$kecamatanDisplay, $kelurahanDisplay, $rtrwDisplay, $rwDisplay, $rtDisplay];
    }

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_pengajuan = $this->active_pengajuan;

        list($dasawisma_id, $kecamatan_id, $kelurahan_id, $rtrw_id, $rw, $rt, $role_id) = $this->checkRole->getFilterValue();

        if ($rt) {
            $isRT = true;
        } else {
            $isRT = false;
        }

        $status = $request->status;
        $kecamatan_id = $kecamatan_id ? $kecamatan_id : $request->kecamatan_filter;
        $kelurahan_id = $kelurahan_id ? $kelurahan_id : $request->kelurahan_filter;
        $rw = $rw ? $rw : $request->rw_filter;
        $rt = $rt ? $rt : $request->rt_filter;
        $rtrw_id = $rtrw_id ? $rtrw_id : $request->rtrw_filter;
        if ($request->ajax()) {
            return $this->dataTable($kecamatan_id, $kelurahan_id, $rtrw_id, $rt, $rw, $status, $isRT);
        }

        $kecamatans = Kecamatan::select('id', 'n_kecamatan')->where('kabupaten_id', 40)->get();

        list($kecamatanDisplay, $kelurahanDisplay, $rtrwDisplay, $rwDisplay, $rtDisplay) = $this->checkFilter();

        return view('pages.pengajuan.index', compact(
            'title',
            'desc',
            'active_pengajuan',
            'kecamatans',
            'kecamatanDisplay',
            'kelurahanDisplay',
            'rtrwDisplay',
            'rwDisplay',
            'rtDisplay',
            'kecamatan_id',
            'kelurahan_id',
            'rw',
            'rt',
            'rtrw_id',
            'isRT'
        ));
    }

    public function dataTable($kecamatan_id, $kelurahan_id, $rtrw_id, $rt, $rw, $status, $isRT)
    {
        $data = Pengajuan::queryTable($kecamatan_id, $kelurahan_id, $rtrw_id, $rt, $rw, $status, $isRT);

        return DataTables::of($data)
            ->addColumn('nama', function ($p) {
                $action = "<a href='" . route('pengajuan.show', $p->id) . "' class='text-info' title='Menampilkan Data'>" . $p->anggota->nama . "</a>";

                return $action;
            })
            ->editColumn('tgl_pengajuan', function ($p) {
                return Carbon::createFromFormat('Y-m-d', $p->tgl_pengajuan)->format('d F Y');
            })
            ->addColumn('jml_perihal', function ($p) {
                return $p->perihal->count() . ' Perihal ';
            })
            ->editColumn('status', function ($p) use ($isRT) {
                $proses = "<span class='badge bg-warning'>Proses</span>";
                $disetujui = "<span class='badge bg-success'>Disetujui</span>";
                $ditolak = "<span class='badge bg-danger'>Ditolak</span>";

                if ($isRT) {
                    if ($p->status == 1) {
                        return $proses;
                    } elseif ($p->status == 2) {
                        return $ditolak;
                    } else {
                        return $disetujui;
                    }
                } else {
                    if ($p->status == 4) {
                        return $proses;
                    } elseif ($p->status == 5) {
                        return $ditolak;
                    } elseif ($p->status == 6) {
                        return $disetujui;
                    }
                }
            })
            ->addColumn('surat', function ($p) {
                return  "<a target='blank' href='" . route('pengajuan.cetak', $p->id) . "' class='text-info' title='Surat'><i class='bi bi-file-text'></i></a>";
            })
            ->addColumn('action', function ($p) {
                return '-';
            })
            ->rawColumns(['id', 'nama', 'surat', 'status'])
            ->addIndexColumn()
            ->toJson();
    }

    public function show($id)
    {
        $title = $this->title;
        $desc  = $this->desc;
        $active_pengajuan = $this->active_pengajuan;

        $data = Pengajuan::find($id);

        list($dasawisma_id, $kecamatan_id, $kelurahan_id, $rtrw_id, $rw, $rt, $role_id) = $this->checkRole->getFilterValue();
        if ($rt) {
            $isRT = true;
        } else {
            $isRT = false;
        }

        return view('pages.pengajuan.show', compact(
            'data',
            'title',
            'desc',
            'active_pengajuan',
            'isRT'
        ));
    }

    public function cetak($id)
    {
        $data = Pengajuan::find($id);

        // QR Code RT
        $file_url = route('validasiRT', $id);
        $b   = base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->merge(public_path('images/logo-png.png'), 0.2, true)->size(900)->errorCorrection('H')->margin(0)->generate($file_url));
        $qrRT = '<img width="60" height="61" src="data:image/png;base64, ' . $b . '" alt="qr code" />';

        // QR Code RW
        $file_url = route('validasiRW', $id);
        $b   = base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->merge(public_path('images/logo-png.png'), 0.2, true)->size(900)->errorCorrection('H')->margin(0)->generate($file_url));
        $qrRW = '<img width="60" height="61" src="data:image/png;base64, ' . $b . '" alt="qr code" />';

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('legal', 'portrait');
        $pdf->loadView('pages.pengajuan.surat', compact(
            'data',
            'qrRT',
            'qrRW'
        ));

        return $pdf->stream($data->anggota->nama . ' ( ' . $data->no_surat . ' ) ' . ".pdf");
    }

    public function setujui(Request $request, $id)
    {
        $username = $request->username;
        $password = md5($request->password);
        $isRT = $request->isRT;

        try {
            //* Check Password
            $user = User::whereusername($username)
                ->wherepassword($password)
                ->first();
            if (!$user) {
                return redirect()
                    ->route('pengajuan.show', $id)
                    ->withErrors('Password Salah.');
            }

            //* 1 = RT | 0 = RW
            $pengajuan = Pengajuan::find($id);
            if ($isRT == 1) {
                //* Setujui Surat
                $pengajuan->update([
                    'status' => 3,
                    'alasan' => null,
                ]);
            } else {
                //* Setujui Surat
                $pengajuan->update([
                    'status' => 6,
                    'alasan' => null,
                ]);
            }

            return redirect()
                ->route('pengajuan.show', $id)
                ->withSuccess('Berhasil, Surat sudah disetujui.');
        } catch (\Throwable $th) {
            return redirect()
                ->route('pengajuan.show', $id)
                ->withErrors('Error 500.');
        }
    }

    public function tolak(Request $request, $id)
    {
        $alasan = $request->alasan;
        $isRT   = $request->isRT;

        //* 1 = RT | 0 = RW
        $pengajuan = Pengajuan::find($id);
        if ($isRT == 1) {
            $pengajuan->update([
                'alasan' => $alasan,
                'status' => 2
            ]);
        } else {
            $pengajuan->update([
                'alasan' => $alasan,
                'status' => 5
            ]);
        }

        return redirect()
            ->route('pengajuan.show', $id)
            ->withSuccess('Surat berhasil ditolak / dikembalikan.');
    }

    public function kirimRW($id)
    {
        $pengajuan = Pengajuan::find($id);
        $pengajuan->update([
            'alasan' => null,
            'status' => 4
        ]);

        return redirect()
            ->route('pengajuan.show', $id)
            ->withSuccess('Surat berhasil dikirim ke RW.');
    }
}
