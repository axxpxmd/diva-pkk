<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ public_path('css/util.css') }}">

    <style>
        body {
            padding-left: 30px !important;
            padding-right: 30px !important;
        }
        .pd {
            padding-top: 3px !important;
            padding-bottom: 3px !important;
        }
        .fw-bold{
            font-weight: bold
        }
    </style>

</head>

<body>
    <h4 class="text-center">DATA WARGA TP-PKK</h4>
    <table style="width:100%;">
        <tr>
            <td width="30%" class="text-left fw-bold">Dasa Wisma</td>
            <td class="pd"> : {{ $anggota->rumah->dasawisma->nama }}</td>
        </tr>
        <tr>
            <td width="30%" class="text-left fw-bold">Nama Kepala Rumah</td>
            <td class="pd"> : {{ $anggota->rumah->kepala_rumah }}</td>
        </tr>
        <tr>
            <td width="30%" class="text-left fw-bold">No KK</td>
            <td class="pd"> : {{ $anggota->no_kk }} / {{ $anggota->kk ? $anggota->kk->domisili == 1 ? 'Tangsel' : 'Non Tangsel' : '' }}</td>
        </tr>
    </table>
    <table class="m-t-10" style="width:100%;">
        <tr>
            <td class="pd" width="2%">1. </td>
            <td class="pd" width="26%">No. Registrasi</td>
            <td class="pd" width="0%">&nbsp;:</td>
            <td class="pd" width="72%">{{ $anggota->no_registrasi }}</td>
        </tr>
        <tr>
            <td class="pd" width="2%">2. </td>
            <td class="pd" width="26%">No. KTP/NIK</td>
            <td class="pd" width="0%">&nbsp;:</td>
            <td class="pd" width="72%">{{ $anggota->nik }} / {{ $anggota_detail->domisili == 1 ? 'Tangsel' : 'Non Tangsel' }}</td>
        </tr>
        <tr>
            <td class="pd" width="2%">3. </td>
            <td class="pd" width="26%">Nama</td>
            <td class="pd" width="0%">&nbsp;:</td>
            <td class="pd" width="72%">{{ $anggota->nama }}</td>
        </tr>
        <tr>
            <td class="pd" width="2%">4. </td>
            <td class="pd" width="26%">Jabatan</td>
            <td class="pd" width="0%">&nbsp;:</td>
            <td class="pd" width="72%">{{ $anggota->jabatan }}</td>
        </tr>
        <tr>
            <td class="pd" width="2%">5. </td>
            <td class="pd" width="26%">Jenis Kelamin</td>
            <td class="pd" width="0%">&nbsp;:</td>
            <td class="pd" width="72%">{{ $anggota->kelamin }}</td>
        </tr>
        <tr>
            <td class="pd" width="2%">6. </td>
            <td class="pd" width="26%">Tempat Lahir</td>
            <td class="pd" width="0%">&nbsp;:</td>
            <td class="pd" width="72%">{{ $anggota->tmpt_lahir }}</td>
        </tr>
        <tr>
            <td class="pd" width="2%">7. </td>
            <td class="pd" width="26%">Tgl. Lahir / Umur</td>
            <td class="pd" width="0%">&nbsp;:</td>
            <td class="pd" width="72%">{{ Carbon\Carbon::createFromFormat('Y-m-d', $anggota->tgl_lahir)->format('d F Y') }} / {{ $umur }} Tahun</td>
        </tr>
        <tr>
            <td class="pd" width="2%">8. </td>
            <td class="pd" width="26%">Status Perkawinan</td>
            <td class="pd" width="0%">&nbsp;:</td>
            <td class="pd" width="72%">{{ $anggota->status_kawin }}</td>
        </tr>
        <tr>
            <td class="pd" width="2%">9. </td>
            <td class="pd" width="26%">Status Dalam Keluarga</td>
            <td class="pd" width="00%">&nbsp;:</td>
            <td class="pd" width="72%">
                @foreach(json_decode($anggota->status_dlm_klrga) as $value)
                    <p style="margin: 0px !important; margin-bottom: -15px !important; margin-left: 0px !important">- {{ $value }}</p><br>
                @endforeach
            </td>
        </tr>
        <tr>
            <td class="pd" width="2%">10. </td>
            <td class="pd" width="26%">Agama</td>
            <td class="pd" width="0%">&nbsp;:</td>
            <td class="pd" width="72%">{{ $anggota->agama }}</td>
        </tr>
        <tr>
            <td class="pd" width="2%">11. </td>
            <td class="pd" width="26%">Alamat Domisili</td>
            <td class="pd" width="0%">&nbsp;:</td>
            <td class="pd" width="72%">{{ $anggota->rumah->alamat_detail }}</td>
        </tr>
        <tr>
            <td class="pd" width="2%"></td>
            <td class="pd" width="26%"></td>
            <td class="pd" width="0%"></td>
            <td class="pd" width="72%">
                <table>
                    <tr>
                        <td class="pd">RT / RW</td>
                        <td class="pd">&nbsp;&nbsp;&nbsp;&nbsp;: {{ $anggota->rumah->rtrw->rt }} / {{ $anggota->rumah->rtrw->rw }}</td>
                    </tr>
                    <tr>
                        <td class="pd">Kelurahan</td>
                        <td class="pd">&nbsp;&nbsp;&nbsp;&nbsp;: {{ $anggota->rumah->rtrw->kelurahan->n_kelurahan }}</td>
                    </tr>
                    <tr>
                        <td class="pd">Kecamtan</td>
                        <td class="pd">&nbsp;&nbsp;&nbsp;&nbsp;: {{ $anggota->rumah->rtrw->kecamatan->n_kecamatan }}</td>
                    </tr>
                    <tr>
                        <td class="pd">Kab/Kota</td>
                        <td class="pd">&nbsp;&nbsp;&nbsp;&nbsp;: Tangerang Selatan</td>
                    </tr>
                    <tr>
                        <td class="pd">Provinsi</td>
                        <td class="pd">&nbsp;&nbsp;&nbsp;&nbsp;: {{ $anggota->rumah->rtrw->kecamatan->n_kecamatan }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="pd" width="2%">12. </td>
            <td class="pd" width="26%">Pendidikan</td>
            <td class="pd" width="0">&nbsp;:</td>
            <td class="pd" width="72%">{{ $anggota->status_pendidkan == 1 ? 'Tamat Sekolah' : 'Putus Sekolah' }} ( {{ $anggota->pendidikan }} )</td>
        </tr>
        <tr>
            <td class="pd" width="2%">13. </td>
            <td class="pd" width="26%">Pekerjaan</td>
            <td class="pd" width="0">&nbsp;:</td>
            <td class="pd" width="72%">{{ $anggota->pekerjaan ? $anggota->pekerjaan : '-'  }}</td>
        </tr>
        <tr>
            <td class="pd" width="2%">14. </td>
            <td class="pd" width="26%">Akseptor KB</td>
            <td class="pd" width="0">&nbsp;:</td>
            <td class="pd" width="72%">{{ $anggota->kb ? 'Ya / ' . $anggota->kb : 'Tidak'  }}</td>
        </tr>
        <tr>
            <td class="pd" width="2%">15. </td>
            <td class="pd" width="26%">Aktif Kegiatan Posyandu</td>
            <td class="pd" width="0">&nbsp;:</td>
            <td class="pd" width="72%">{{ $anggota->aktif_posyandu ? $anggota->aktif_posyandu . ' (Bulan)' : 'Tidak'  }}</td>
        </tr>
        <tr>
            <td class="pd" width="2%">16. </td>
            <td class="pd" width="26%">Program Bina Balita</td>
            <td class="pd" width="0">&nbsp;:</td>
            <td class="pd" width="72%">{{ $anggota_detail->prgrm_bina_balita == 1 ? 'Ya' : 'Tidak'  }}</td>
        </tr>
        <tr>
            <td class="pd" width="2%">17. </td>
            <td class="pd" width="26%">Tabungan</td>
            <td class="pd" width="0">&nbsp;:</td>
            <td class="pd" width="72%">{{ $anggota_detail->tabungan == 1 ? 'Ya' : 'Tidak'  }}</td>
        </tr>
        <tr>
            <td class="pd" width="2%">18. </td>
            <td class="pd" width="26%">Kelompok Belajar</td>
            <td class="pd" width="0">&nbsp;:</td>
            <td class="pd" width="72%">{{ $anggota_detail->klmpk_belajar }}</td>
        </tr>
        <tr>
            <td class="pd" width="2%">19. </td>
            <td class="pd" width="26%">PAUD / Sejenis</td>
            <td class="pd" width="0">&nbsp;:</td>
            <td class="pd" width="72%">{{ $anggota_detail->paud == 1 ? 'Ya' : 'Tidak' }}</td>
        </tr>
        <tr>
            <td class="pd" width="2%">20. </td>
            <td class="pd" width="26%">Kegiatan Koperasi</td>
            <td class="pd" width="0">&nbsp;:</td>
            <td class="pd" width="72%">{{ $anggota_detail->kgtn_koperasi == 1 ? 'Ya / ' . $anggota_detail->jns_kgtn_koperasi : 'Tidak'  }}</td>
        </tr>
        <tr>
            <td class="pd" width="2%">20. </td>
            <td class="pd" width="26%">Kebutuhan Khusus</td>
            <td class="pd" width="0">&nbsp;:</td>
            <td class="pd" width="72%">{{ $anggota_detail->kbthn_khusus == 1 ? 'Ya / ' . $anggota_detail->jenis_kbthn_khusus : 'Tidak'  }}</td>
        </tr>
    </table>
</body>

</html>
