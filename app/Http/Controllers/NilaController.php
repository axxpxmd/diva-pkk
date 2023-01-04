<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NilaController extends Controller
{
    public function index()
    {
        return view('pages.nila.index');
    }

    public function generateSurat(Request $request)
    {
        $nama = $request->nama;
        $nip  = $request->nip;
        $n_dinas  = $request->n_dinas;
        $no_surat = $request->no_surat;

        // QR Code
        $url  = 'https://amando.tangerangselatankota.go.id/uploads/surat/' . $nip . '.pdf';
        $data = base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->merge(public_path('images/logo-png.png'), 0.2, true)->size(900)->errorCorrection('H')->margin(0)->generate($url));
        $QR   = '<img width="60" height="61" src="data:image/png;base64, ' . $data . '" alt="qr code" />';

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('A4', 'portrait');
        $pdf->loadView('pages.nila.surat', compact(
            'QR',
            'nama',
            'nip',
            'n_dinas',
            'no_surat'
        ));

        return $pdf->stream($nip . ".pdf");
    }
}
