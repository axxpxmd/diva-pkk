<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ public_path('css/util.css') }}">
    <link rel="stylesheet" href="{{ public_path('css/pdf-css.css') }}">

    <style>
        body {
            padding-top: 0px !important;
            color: black !important;
        }

        .pd {
            padding-top: 3px !important;
            padding-bottom: 3px !important;
        }

        .fw-bold {
            font-weight: bold
        }

        .b-none {
            border: none !important
        }

        .bt-none {
            border-bottom: none !important
        }

        .va-m {
            vertical-align: middle !important;
            text-align: center
        }

        table {
            color: black !important;
        }

        table thead tr th {
            padding: 2px !important
        }

        table tbody tr td {
            padding: 2px !important
        }

        .va-auto{
            vertical-align: middle !important
        }
    </style>

</head>

<body>
    <p class="text-center font-weight-bold fs-16">DATA KARTU KELUARGA</p>
    <table style="width:100%;" class="fs-12">
        <tr>
            <td width="15%">CATATAN KELUARGA DARI</td>
            <td width="58%"> : &nbsp;{{ $data->nm_kpl_klrga }}</td>
            <td width="12%">KRITERIA RUMAH</td>
            <td width="%"> : &nbsp;{{ $data->rumah->layak_huni == 1 ? 'Layak' : 'Tidak Layak' }}</td>
        </tr>
        <tr>
            <td>KELOMPOK DASAWISA</td>
            <td> : &nbsp;{{ $data->rumah->dasawisma->nama }}</td>
            <td>JAMBAN KELUARGA</td>
            <td> : &nbsp;{{ $data->rumah->jamban == 0 ? 'Tidak Punya' : $data->rumah->jamban . ' Buah' }}</td>
        </tr>
        <tr>
            <td>TAHUN</td>
            <td> : &nbsp;{{ $data->thn_input }}</td>
            <td>TEMPAT SAMPAH</td>
            <td> : {{ $data->rumah->tempat_smph == 1 ? 'Ya' : 'Tidak' }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td style="vertical-align: top !important">SUMBER AIR</td>
            <td>
                @foreach (json_decode($data->rumah->sumber_air) as $value)
                    <span>- {{ $value }}</span><br>
                @endforeach
            </td>
        </tr>
    </table>
    <table style="width:100%;" class="fs-7 mt-4 table table-bordered">
        <thead>
            <tr>
                <th rowspan="2" class="va-m bt-none">NO</th>
                <th rowspan="2" class="va-m bt-none">ANGGOTA</th>
                <th rowspan="2" class="va-m bt-none">STATUS PERKAWINAN</th>
                <th rowspan="2" class="va-m bt-none">L/P</th>
                <th rowspan="2" class="va-m bt-none">TEMPAT LAHIR</th>
                <th rowspan="2" class="va-m bt-none">TANGGAL LAHIR</th>
                <th rowspan="2" class="va-m bt-none">AGAMA</th>
                <th rowspan="2" class="va-m bt-none">PENDIDIKAN</th>
                <th rowspan="2" class="va-m bt-none">PEKERJAAN</th>
                <th rowspan="2" class="va-m bt-none">BERKEBUTUHAN KHUSUS</th>
                <th class="bt-none text-center" colspan="8">KEGIATAN PKK YANG DIIKUTI</th>
                <th rowspan="2" class="va-m bt-none">KET</th>
            </tr>
            <tr>
                <th class="bt-none va-m">PENGHAYATAN PANCASILA</th>
                <th class="bt-none va-m">GOTONG ROYONG</th>
                <th class="bt-none va-m">PENDIDIKAN</th>
                <th class="bt-none va-m">KEHIDUPAN BERKOPERASI</th>
                <th class="bt-none va-m">PANGAN</th>
                <th class="bt-none va-m">SANDANG</th>
                <th class="bt-none va-m">KESEHATAN</th>
                <th class="bt-none va-m">PERENCANAAN KEHATAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anggota as $key => $i)
                <tr>
                    <td class="va-m">{{ $key + 1 }}</td>
                    <td class="va-auto">{{ $i->nama }}</td>
                    <td class="va-m">{{ $i->status_kawin }}</td>
                    <td class="va-m">{{ $i->kelamin == 'Laki - laki' ? 'L' : 'P' }}</td>
                    <td class="va-auto">{{ $i->tmpt_lahir }}</td>
                    <td class="va-m">{{ Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_lahir)->format('d-m-Y') }}
                    </td>
                    <td class="va-m">{{ $i->agama }}</td>
                    <td class="va-m">{{ $i->status_pendidkan == 1 ? 'Tamat Sekolah' : 'Putus Sekolah' }} /
                        {{ $i->pendidikan }}</td>
                    <td class="va-m">{{ $i->pekerjaan }}</td>
                    <td class="va-m">
                        {{ $i->kbthn_khusus == 'Ya' ? 'Ya / ' . $i->anggotaDetail->jenis_kbthn_khusus : 'Tidak' }}
                    </td>
                    <td class="va-auto">
                        @if ($i->anggotaDetail->jns_kgtn_pancasila)
                            @foreach(json_decode($i->anggotaDetail->jns_kgtn_pancasila) as $value)
                                <li class="m-l-7">
                                    {{ $value }}
                                    @if ($value == 'Kegiatan Keagamaan')
                                        ( {{ $i->anggotaDetail->jns_kgtn_keagamaan }} )
                                    @endif
                                </li>
                            @endforeach
                        @else
                        -    
                        @endif
                    </td>
                    <td class="va-auto">
                        @if ($i->anggotaDetail->jns_gotong_royong)
                            @foreach(json_decode($i->anggotaDetail->jns_gotong_royong) as $value)
                                <li class="m-l-7">
                                    {{ $value }}
                                </li>
                            @endforeach
                        @else
                        -    
                        @endif
                    </td>
                    <td class="va-m">{{ $i->anggotaDetail->klmpk_belajar }}</td>
                    <td class="va-auto">
                        @if ($i->anggotaDetail->hatinya_pkk == 1)
                            Ya
                        @else
                            Tidak
                        @endif
                        @if ($i->anggotaDetail->jns_hatinya_pkk)
                            @foreach(json_decode($i->anggotaDetail->jns_hatinya_pkk) as $value)
                                <li class="m-l-7">{{ $value }}</li>
                            @endforeach
                        @endif
                    </td>
                    <td></td>
                    <td></td>
                    <td class="va-auto">
                        <table style="width: 100%">
                            <tr>
                                <td class="p-0 b-none" width="10%">Posyandu</td>
                                <td class="p-0 b-none" width="0%">:</td>
                                <td class="p-0 b-none" width="90%">
                                    <span>{{ $i->aktif_posyandu ? $i->aktif_posyandu . '/bln' : '-' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-0 b-none" width="10%">Posbindu</td>
                                <td class="p-0 b-none" width="0%">:</td>
                                <td class="p-0 b-none" width="90%">
                                    <span>{{ $i->aktif_posbindu ? $i->aktif_posbindu . '/bln' : '-' }}</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table style="width: 100%">
                            <tr>
                                <td class="p-0 b-none" width="5%">KB</td>
                                <td class="p-0 b-none" width="0%">:</td>
                                <td class="p-0 b-none" width="95%">
                                    @if ($i->kb)
                                        {{ $i->kb }}
                                    @else
                                        Tidak
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="p-0 b-none">BPJS</td>
                                <td class="p-0 b-none">:</td>
                                <td class="p-0 b-none">
                                    @if ($i->bpjs == 1)
                                        Ya
                                    @else
                                        Tidak
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="p-0 b-none"></td>
                                <td class="p-0 b-none"></td>
                                <td class="p-0 b-none">
                                    @if ($i->asuransi_lainnya)
                                        @foreach(json_decode($i->asuransi_lainnya) as $value)
                                            <span class="">- {{ $value }}</span><br>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="p-0 b-none">Menabung</td>
                                <td class="p-0 b-none">:</td>
                                <td class="p-0 b-none">
                                    @if ($i->anggotaDetail->tabungan == 1)
                                        Ya
                                    @else
                                        Tidak
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
