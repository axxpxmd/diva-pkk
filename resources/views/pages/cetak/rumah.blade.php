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
        .fw-bold{
            font-weight: bold
        }
        .b-none {
            border: none !important
        }

        .bt-none {
            border-bottom: none !important
        }
    </style>

</head>

<body>
    <p class="text-center font-weight-bold fs-16">DATA KELUARGA</p>
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
                        <td width="10%">RT</td>
                        <td width="25%"> : {{ $data->rtrw->rt }}</td>
                        <td width="10%">RW</td>
                        <td width="55%"> : {{ $data->rtrw->rw }}</td>
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
                        <td>Prov.</td>
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
                            <table style="width:100%; margin-left: -88px !important">
                                <tr>
                                    <td width="8%">Balita</td>
                                    <td width="8%"> : {{ $data->anggota(3)->count() }} Anak</td>
                                    <td width="10%">PUS</td>
                                    <td width="8%"> : {{ $data->anggota(4)->count() }} Anak</td>
                                    <td width="13%">WUS</td>
                                    <td width="8%"> : {{ $data->anggota(5)->count() }} Anak</td>
                                    <td width="5%">3 Buta</td>
                                    <td width="12%"> : {{ $data->anggota(6)->count() }} Anak</td>
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
    <table style="width:100%;" class="fs-14">
        <tr>
            <td width="15%">Jamban Rumah</td>
            <td width="0%"> :&nbsp;</td>
            <td width="85%">{{ $data->jamban == 0 ? 'Tidak Punya' : $data->jamban.' Buah' }}</td>
        </tr>
        <tr>
            <td>Sumber Air</td>
            <td width="0%"> :&nbsp;</td>
            <td>
                @foreach(json_decode($data->sumber_air) as $value)
                    <span style="margin: 0px !important; margin-bottom: -15px !important; margin-right: 10px !important">- {{ $value }}</span>
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
