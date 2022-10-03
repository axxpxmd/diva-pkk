<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ public_path('css/util.css') }}">
    <link rel="stylesheet" href="{{ public_path('css/pdf-css.css') }}">

    <style>
        body {
            padding-top: 30px !important;
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

        table thead tr th {
            padding: 5px !important
        }

        table tbody tr td {
            padding: 5px !important
        }

        .va-m {
            vertical-align: middle !important;
            text-align: center
        }

        .va-auto{
            vertical-align: middle !important
        }
    </style>

</head>

<body>
    <p class="text-center text-black font-weight-bolder mb-4">DATA KEGIATAN WARGA</p>
    <table class="fs-14 mb-3">
        <tr>
            <td class="b-none text-black">Nama</td>
            <td class="b-none text-black"> : {{ $anggota->nama }}</td>
        </tr>
        <tr>
            <td class="b-none text-black">No. Registrasi</td>
            <td class="b-none text-black"> : {{ $anggota->no_registrasi }}</td>
        </tr>
        <tr>
            <td class="b-none text-black">No. KTP/NIK</td>
            <td class="b-none text-black"> : {{ $anggota->nik }}</td>
        </tr>
    </table>
    <table class="table table-bordered fs-13" style="width:100%;">
        <thead>
            <tr>
                <th class="text-center bg-gray-300 bt-none text-black">NO</th>
                <th class="text-center bg-gray-300 bt-none text-black">KEGIATAN</th>
                <th class="text-center bg-gray-300 bt-none text-black">AKTIVITAS (Y/T)</th>
                <th class="text-center bg-gray-300 bt-none text-black">KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-black">
                <td class="va-m" width="5%">1.</td>
                <td width="35%" class="va-auto">Penghayatan dan Pengamalan Pancasila</td>
                <td width="20%" class="va-m">{{ $anggota_detail->jns_kgtn_pancasila ? count(json_decode($anggota_detail->jns_kgtn_pancasila)) != 0 ? 'Ya' : 'Tidak' : 'Tidak' }}</td>
                <td width="40%">
                    @if ($anggota_detail->jns_kgtn_pancasila)
                        @foreach(json_decode($anggota_detail->jns_kgtn_pancasila) as $value)
                            <li class="ml-3 mb-1">
                                {{ $value }}
                                @if ($value == 'Kegiatan Keagamaan')
                                    ( {{ $anggota_detail->jns_kgtn_keagamaan }} )
                                @endif
                            </li>
                        @endforeach
                    @else
                    -    
                    @endif
                </td>
            </tr>
            <tr class="text-black">
                <td width="5%" class="va-m">2.</td>
                <td width="35%" class="va-auto">Kerjabakti</td>
                <td width="20%" class="va-m">
                    @if ($anggota_detail->jns_gotong_royong != 0)
                        @forelse(json_decode($anggota_detail->jns_gotong_royong) as $value)
                        @if ($value == 'Kerja Bakti')
                            Ya @break
                        @else
                            Tidak @break
                        @endif
                        @empty
                            Tidak
                        @endforelse
                    @endif
                </td>
                <td width="40%"></td>
            </tr>
            <tr class="text-black">
                <td width="5%" class="va-m">3.</td>
                <td width="35%" class="va-auto">Rukun Kematian</td>
                <td width="20%" class="va-m">
                    @if ($anggota_detail->jns_gotong_royong != 0)
                        @forelse(json_decode($anggota_detail->jns_gotong_royong) as $value)
                        @if ($value == 'Rukun Kematian')
                            Ya @break
                        @else
                            Tidak @break
                        @endif
                        @empty
                            Tidak
                        @endforelse
                    @endif
                </td>
                <td width="40%"></td>
            </tr>
            <tr class="text-black">
                <td width="5%" class="va-m">4.</td>
                <td width="35%" class="va-auto">Jimpitan</td>
                <td width="20%" class="va-m">
                    @if ($anggota_detail->jns_gotong_royong != 0)
                        @forelse(json_decode($anggota_detail->jns_gotong_royong) as $value)
                            @if ($value == 'Jimpitan')
                                Ya @break
                            @else
                                Tidak @break
                            @endif
                        @empty
                            Tidak
                        @endforelse
                    @endif
                </td>
                <td width="40%"></td>
            </tr>
            <tr class="text-black">
                <td width="5%" class="va-m">5.</td>
                <td width="35%" class="va-auto">Arisan</td>
                <td width="20%" class="va-m">
                    @if ($anggota_detail->jns_gotong_royong != 0)
                        @forelse(json_decode($anggota_detail->jns_gotong_royong) as $value)
                            @if ($value == 'Arisan')
                                Ya @break
                            @else
                                Tidak @break
                            @endif
                        @empty
                            Tidak
                        @endforelse
                    @endif
                </td>
                <td width="40%"></td>
            </tr>
            <tr class="text-black">
                <td width="5%" class="va-m">6.</td>
                <td width="35%" class="va-auto">Lainnya</td>
                <td width="20%" class="va-m">
                    @if ($anggota_detail->jns_gotong_royong != 0)
                        @forelse(json_decode($anggota_detail->jns_gotong_royong) as $value)
                            @if ($value == 'Lainnya')
                                Ya @break
                            @else
                                Tidak @break
                            @endif
                        @empty
                            Tidak
                        @endforelse
                    @endif
                </td>
                <td width="40%"></td>
            </tr>
        </tbody>
    </table>
</body>

</html>
