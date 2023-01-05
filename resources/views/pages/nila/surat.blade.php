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

        .m-n {
            margin-bottom: -2px !important
        }

        table.d {
            border-collapse: collapse;
            width: 100%
        }

        table.d tr.d,
        th.d,
        td.d {
            table-layout: fixed;
            border: 1px solid black;
            font-size: 12px;
            height: 100;
        }

        table.a tr.a,
        th.a,
        td.a {
            table-layout: fixed;
            border: 1px solid black;
            font-size: 12px;
        }

        table.c {
            font-size: 15px
        }
    </style>

</head>

<body>
    <table class="mb-2" style="width: 100%">
        <tr>
            <td>
                <img src="{{ public_path('images/logo/tangsel.png') }}" width="80" alt="">
            </td>
            <td class="text-center" style="vertical-align: top !important;">
                <div class="text-center">
                    <p class="font-weight-bolder m-0">PEMERINTAH KOTA TANGERANG SELATAN</p>
                    <p class="font-weight-bolder m-0 text-uppercase">{{ $n_dinas }}</p>
                    <span>{{ $alamat_dinas }}</span>
                </div>
            </td>
        </tr>
    </table>

    <div style="border: 2px black solid; margin-bottom: 2px"></div>
    <div style="border: 1px black solid"></div>

    <div class="px-5">
        <div class="text-center mt-3">
            <p class="font-weight-bolder m-0"><u>SURAT KETERANGAN</u></p>
            <p>Nomor : <span class="text-uppercase">{{ $no_surat }}</span></p>
        </div>
    
        <p class="ml-5 mt-4">Yang bertandatangan dibawah ini:</p>
        <table style="width: 100%">
            <tr>
                <td>Nama</td>
                <td>&nbsp;&nbsp; : {{ $nama }}</td>
            </tr>
            <tr>
                <td>NIP</td>
                <td>&nbsp;&nbsp; : {{ $nip }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>&nbsp;&nbsp; : Kepala {{ $n_dinas }} Kota Tangerang Selatan</td>
            </tr>
        </table>
    
        <p class="ml-5 mt-4">Dengan ini menerangkan Bahwa : </p>
        <table style="width: 100%">
            <tr>
                <td width="20%">Nama</td>
                <td width="2%">:</td>
                <td width="78%">Nila Munana</td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>:</td>
                <td>7774190024</td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>:</td>
                <td>Magister Akuntansi </td>
            </tr>
            <tr>
                <td>Asal Universitas</td>
                <td>:</td>
                <td>Universitas Sultan Ageng Tirtayasa </td>
            </tr>
            <tr>
                <td style="vertical-align: top !important;">Judul Penelitian</td>
                <td style="vertical-align: top !important;">:</td>
                <td>Pengaruh Partisipasi Anggaran Terhadap Kinerja Manajerial Dengan <i>Psychological Capital</i> Dan <i>Job Relevant Information</i> Sebagai Variabel Mediasi </td>
            </tr>
        </table>
    
        <div class="mt-4">
            <p class="m-0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dengan ini menyatakan bahwa Mahasiswa tersebut telah melaksanakan penelitian tesis pada <span class="text-uppercase">{{ $n_dinas }}</span> Kota Tangerang Selatan Selama 1 Bulan ( 1 – 30 November 2022)</p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikian surat keterangan ini dibuat untuk diketahui dan dipergunakan sebagaimana mestinya.</p>
        </div>

        <div class="mt-5">
            <table style="width: 100%">
                <tr>
                    <td width="50%"></td>
                    <td width="50%" class="text-center">
                        <p>Kepala</p>
                        <table class="m-l-15">
                            <tr class="a">
                                <td style="padding: 2px !important" width="8%" class="a"> {!! $QR !!}</td>
                                <td style="padding: 2px !important" width="92%" class="a">
                                    <p class="m-b-0 m-t-0 fs-10" style="font-style: italic">Telah ditandatangani secara elektronik oleh :</p>
                                    <p class="m-t-0 m-b-0 fs-10 text-primary">{{ $nama }}</p>
                                    <p class="m-t-0 m-b-0 fs-10">Menggunakan Sertifikat Elektronik.</p>
                                </td>
                            </tr>
                        </table>
                        <div class="mt-2">
                            <p class="font-weight-bolder m-0 text-uppercase"><u>{{ $nama }}</u></p>
                            <p>NIP. {{ $nip }}</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>

</html>
