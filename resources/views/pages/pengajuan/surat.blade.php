<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ public_path('css/util.css') }}">
    <link rel="stylesheet" href="{{ public_path('css/pdf-css.css') }}">

    <style>
        body {
            padding-top: 0px !important;
            padding-left: 20px !important;
            padding-right: 20px !important;
            color: black
        }
        .m-n{
            margin-bottom: -2px !important
        }
    </style>

</head>

<body>
    <div class="text-center text-black mb-2">
        <p class="fs-18 mb-0">RUKUN TETANGGA {{ $data->anggota->rtrw->rt }} RUKUN WARGA {{ $data->anggota->rtrw->rw }}</p>
        <p class="fs-16 font-weight-bolder text-uppercase mb-0">KELURAHAN {{ $data->anggota->rtrw->n_kelurahan }} KECAMATAN {{ $data->anggota->rtrw->n_kecamatan }}</p>
        <p class="fs-18 m-0">KOTA TANGERANG SELATAN</p>
    </div>
    <div style="border: 2px black solid; margin-bottom: 2px"></div>
    <div style="border: 1px black solid"></div>
    <div class="mt-3 fs-14" style="margin-left: 430px !important">
        <p>Tangerang Selatan, {{ Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_surat)->format('d F Y') }}</p>
        <p class="m-n">Kepada :</p>
        <p class="m-n">Yth. Sdr. Lurah {{ $data->anggota->rtrw->n_kelurahan }}</p>
        <p class="m-n">Kecamatan {{ $data->anggota->rtrw->n_kecamatan }}</p>
        <p class="m-n">di Tangerang Selatan</p>
    </div>
    <div class="text-center mt-3">
        <u class="fs-18 font-weight-bolder">SURAT PENGANTAR</u>
        <p class="fs-14">Nomor : 00001 / RT {{ $data->anggota->rtrw->rt }} / RW {{ $data->anggota->rtrw->rw }} / 2022</p>
    </div>
    <div class="mb-2">
        <p>Yang bertanda tangan  di bawah ini ketua RT {{ $data->anggota->rtrw->rt }} / RW {{ $data->anggota->rtrw->rw }} 
            Kelurahan {{ $data->anggota->rtrw->n_kelurahan }} Kecamatan {{ $data->anggota->rtrw->n_kecamatan }} Kota Tangerang Selatan, Dengan ini menerangkan bahwa :
        </p>
    </div>
    <div class="ml-4">
        <table>
            <tr>
                <td>Nama</td>
                <td>&nbsp;&nbsp; : {{ $data->anggota->nama }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>&nbsp;&nbsp; : {{ $data->anggota->kelamin }}</td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td>&nbsp;&nbsp; : {{ $data->anggota->tmpt_lahir }}, {{ Carbon\Carbon::createFromFormat('Y-m-d', $data->anggota->tgl_lahir )->format('d F Y') }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>&nbsp;&nbsp; : {{ $data->anggota->agama }}</td>
            </tr>
            <tr>
                <td>Status Kawin</td>
                <td>&nbsp;&nbsp; : {{ $data->anggota->status_kawin }}</td>
            </tr>
            <tr>
                <td>Kewarganegaraan</td>
                <td>&nbsp;&nbsp; : Indonesia</td>
            </tr>
            <tr>
                <td>Pendidikan</td>
                <td>&nbsp;&nbsp; : {{ $data->anggota->pendidikan }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>&nbsp;&nbsp; : {{ $data->anggota->pekerjaan }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>&nbsp;&nbsp; : {{ $data->anggota->nik }}</td>
            </tr>
            <tr>
                <td>Nomor KK</td>
                <td>&nbsp;&nbsp; : {{ $data->anggota->no_kk }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>&nbsp;&nbsp; : {{ $data->anggota->rumah->alamat_detail }}</td>
            </tr>
            <tr>
                <td>No. Telp/HP</td>
                <td>&nbsp;&nbsp; : {{ $data->user->no_telp }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top !important">Keperluan</td>
                <td>
                    @foreach ($data->perihal as $key => $i)
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $key+1 }}. {{ $i->perihal }} <br>
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
    <p class="text-center mt-2">Demikian untuk menjadikan periksa dan dipergunakan sebagaimana mestinya</p>
    <div class="mt-5">
        <table>
            <tr>
                <td>Nomor</td>
                <td>&nbsp;&nbsp; : 00001 / RT {{ $data->anggota->rtrw->rt }} / RW {{ $data->anggota->rtrw->rw }} / 2022</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>&nbsp;&nbsp; : {{ Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_surat)->format('d F Y') }}</td>
            </tr>
        </table>
    </div>
    <div class="mt-2">
        <table width="100%">
            <tr>
                <td class="text-center">
                    <div style="margin-right: 50px !important">
                        <p class="m-n">Mengetahui,</p>
                        <p class="m-n fs-14">KETUA RW {{ $data->anggota->rtrw->rw }}</p>
                        <p class="m-n fs-14 text-uppercase">KELURAHAN {{ $data->anggota->rtrw->n_kelurahan }}</p>
                        <div class="m-t-90">
                            <u class="m-n">{{ $data->anggota->rtrw->nKetuaRT->ketua }}</u>
                            <p class="m-n">NIK. {{ $data->anggota->rtrw->nKetuaRT->nik }}</p>
                        </div>
                    </div>
                </td>
                <td class="text-center">
                    <div style="margin-left: 50px !important">
                        <div style="margin-top: 20px !important">
                            <p class="m-n fs-14">KETUA RT {{ $data->anggota->rtrw->rt }} / KETUA RW {{ $data->anggota->rtrw->rw }}</p>
                            <p class="m-n fs-14 text-uppercase">KELURAHAN {{ $data->anggota->rtrw->n_kelurahan }}</p>
                        </div>
                        <div class="m-t-90">
                            <u class="m-n">{{ $data->anggota->rtrw->nKetuaRW->ketua }}</u>
                            <p class="m-n">NIK. {{ $data->anggota->rtrw->nKetuaRW->nik }}</p>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
