<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ public_path('css/util.css') }}">
    <link rel="stylesheet" href="{{ public_path('css/pdf-css.css') }}">

    <style>
        body {
            padding-top: 0px !important;
            color: black !important;
            padding-left: 30px !important;
            padding-right: 30px !important;
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

        table {
            color: black !important;
        }

        .va-m {
            vertical-align: middle !important;
            text-align: center
        }

    </style>

</head>

<body>
    <p class="text-center font-weight-bold fs-16">DATA RUMAH</p>
    <table style="width:100%;" class="fs-14">
        <tr>
            <td width="10%">Dasa Wisma</td>
            <td width="0%"> :&nbsp;</td>
            <td width="90%">{{ $data->dasawisma->nama }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td width="0%"> :&nbsp;</td>
            <td>{{ $data->alamat_detail }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <table style="width:100%;">
                    <tr>
                        <td width="8%">RT</td>
                        <td width="20%"> : {{ $data->rtrw->rt }}</td>
                        <td width="8%">RW</td>
                        <td width="64%"> : {{ $data->rtrw->rw }}</td>
                    </tr>
                    <tr>
                        <td>Kelurahan</td>
                        <td> : {{ $data->rtrw->kelurahan->n_kelurahan }}</td>
                        <td>Kecamatan</td>
                        <td> : {{ $data->rtrw->kecamatan->n_kecamatan }}</td>
                    </tr>
                    <tr>
                        <td>Kota</td>
                        <td> : Tangerang Selatan</td>
                        <td>Provinsi</td>
                        <td> : Banten</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>Kepala Rumah</td>
            <td width="0%"> :&nbsp;</td>
            <td>{{ $data->kepala_rumah }}</td>
        </tr>
        <tr>
            <td>Jumlah KK</td>
            <td width="0%"> :&nbsp;</td>
            <td>{{ $data->kk->count() }} Kartu Keluarga</td>
        </tr>
        <tr>
            <td>Jumlah Anggota</td>
            <td width="0%"> :&nbsp;</td>
            <td>{{ $data->anggota->count() }} Orang</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <table style="width:100%;">
                    <tr>
                        <td width="10%">Laki - Laki</td>
                        <td width="90%"> : {{ $data->anggota(1)->count() }} Orang</td>
                    </tr>
                    <tr>
                        <td>Perempuan</td>
                        <td> : {{ $data->anggota(2)->count() }} Orang</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <table style="width:100%; margin-left: -108px !important">
                                <tr>
                                    <td width="8%">Balita</td>
                                    <td width="8%"> : {{ $data->anggota(3)->count() }} Anak</td>
                                    <td width="10%">PUS</td>
                                    <td width="8%"> : {{ $data->anggota(4)->count() }} Anak</td>
                                    <td width="10%">WUS</td>
                                    <td width="8%"> : {{ $data->anggota(5)->count() }} Anak</td>
                                    <td width="5%">3 Buta</td>
                                    <td width="15%"> : {{ $data->anggota(6)->count() }} Anak</td>
                                </tr>
                                <tr>
                                    <td>Ibu Hamil</td>
                                    <td> : {{ $data->anggota(7)->count() }} Anak</td>
                                    <td>Ibu Menyusui</td>
                                    <td> : {{ $data->anggota(8)->count() }} Anak</td>
                                    <td>Berkebutuhan Khusus</td>
                                    <td> : {{ $data->anggota(9)->count() }} Anak</td>
                                    <td>Lansia</td>
                                    <td> : {{ $data->anggota(10)->count() }} Anak</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table class="table table-bordered tablekk fs-14 text-black mt-3" style="width: 100%">
        <thead>
            <tr>
                <th class="bt-none py-1 px-2 va-m">NO</th> 
                <th class="bt-none py-1 px-2 va-m">No KK</th>
                <th class="bt-none py-1 px-2 va-m">Nama Kepala KK</th>
                <th class="bt-none py-1 px-2 va-m">Tahun Input</th>
                <th class="bt-none py-1 px-2 va-m">Domisili</th>
                <th class="bt-none py-1 px-2 va-m">Total Anggota</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kk as $key => $i)
                <tr>
                    <td class="py-1 px-2 va-m">{{ $key+1 }}</td>
                    <td class="py-1 px-2">{{ $i->no_kk }}</td>
                    <td class="py-1 px-2">{{ $i->nm_kpl_klrga }}</td>
                    <td class="py-1 px-2 va-m">{{ $i->thn_input }}</td>
                    <td class="py-1 px-2 va-m">{{ $i->domisili == 1 ? 'Tangsel' : 'Non-Tangsel' }}</td>
                    <td class="py-1 px-2 va-m">{{ $i->anggota->count() }} Orang</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <table style="width:100%;" class="fs-14">
        <tr>
            <td width="15%">Jamban Rumah</td>
            <td width="0%"> :&nbsp;</td>
            <td width="85%">{{ $data->jamban == 0 ? 'Tidak Punya' : $data->jamban . ' Buah' }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top !important">Sumber Air</td>
            <td width="0%" style="vertical-align: top !important"></td>
            <td>
                @foreach (json_decode($data->sumber_air) as $value)
                    <span>- {{ $value }}</span><br>
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Pembuangan Sampah</td>
            <td width="0%"> :&nbsp;</td>
            <td>{{ $data->tempat_smph == 1 ? 'Ya' : 'Tidak' }}</td>
        </tr>
        <tr>
            <td>Pembuangan Limbah</td>
            <td width="0%"> :&nbsp;</td>
            <td>{{ $data->saluran_pmbngn == 1 ? 'Ya' : 'Tidak' }}</td>
        </tr>
        <tr>
            <td>Stiker P4K</td>
            <td width="0%"> :&nbsp;</td>
            <td>{{ $data->stiker_p4k == 1 ? 'Ya' : 'Tidak' }}</td>
        </tr>
        <tr>
            <td>Kriteria Rumah</td>
            <td width="0%"> :&nbsp;</td>
            <td>{{ $data->kriteria_rmh == 1 ? 'Sehat' : 'Tidak Sehat' }}</td>
        </tr>
        <tr>
            <td>Layak Huni</td>
            <td width="0%"> :&nbsp;</td>
            <td>{{ $data->layak_huni == 1 ? 'Layak' : 'Tidak Layak' }}</td>
        </tr>
    </table>

</body>

</html>
