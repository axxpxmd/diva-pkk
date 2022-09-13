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
    </style>

</head>

<body>
    <p class="text-center text-black font-weight-bolder">DATA KEGIATAN WARGA</p>

    <table class="table table-bordered fs-13" style="width:100%;">
        <thead>
            <th class="text-center p-2 bg-gray-300 bt-none text-black">NO</th>
            <th class="text-center p-2 bg-gray-300 bt-none text-black">KEGIATAN</th>
            <th class="text-center p-2 bg-gray-300 bt-none text-black">AKTIVITAS (Y/T)</th>
            <th class="text-center p-2 bg-gray-300 bt-none text-black">KETERANGAN</th>
        </thead>
        <tbody>
            <tr class="text-black">
                <td width="5%">1.</td>
                <td width="35%">Penghayatan dan Pengamalan Pancasila</td>
                <td width="20%" class="text-center">{{ $anggota_detail->jns_kgtn_pancasila ? count(json_decode($anggota_detail->jns_kgtn_pancasila)) != 0 ? 'Ya' : 'Tidak' : 'Tidak' }}</td>
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
                <td width="5%">2.</td>
                <td width="35%">Kerjabakti</td>
                <td width="20%" class="text-center">
                    @forelse(json_decode($anggota_detail->jns_gotong_royong) as $value)
                        @if ($value == 'Kerja Bakti')
                            Ya @break
                        @else
                            Tidak @break
                        @endif
                    @empty
                        Tidak
                    @endforelse
                </td>
                <td width="40%"></td>
            </tr>
            <tr class="text-black">
                <td width="5%">3.</td>
                <td width="35%">Rukun Kematian</td>
                <td width="20%" class="text-center">
                    @forelse(json_decode($anggota_detail->jns_gotong_royong) as $value)
                        @if ($value == 'Rukun Kematian')
                            Ya @break
                        @else
                            Tidak @break
                        @endif
                    @empty
                        Tidak
                    @endforelse
                </td>
                <td width="40%"></td>
            </tr>
            <tr class="text-black">
                <td width="5%">4.</td>
                <td width="35%">Jimpitan</td>
                <td width="20%" class="text-center">
                    @forelse(json_decode($anggota_detail->jns_gotong_royong) as $value)
                        @if ($value == 'Jimpitan')
                            Ya @break
                        @else
                            Tidak @break
                        @endif
                    @empty
                        Tidak
                    @endforelse
                </td>
                <td width="40%"></td>
            </tr>
            <tr class="text-black">
                <td width="5%">5.</td>
                <td width="35%">Arisan</td>
                <td width="20%" class="text-center">
                    @forelse(json_decode($anggota_detail->jns_gotong_royong) as $value)
                        @if ($value == 'Arisan')
                            Ya @break
                        @else
                            Tidak @break
                        @endif
                    @empty
                        Tidak
                    @endforelse
                </td>
                <td width="40%"></td>
            </tr>
            <tr class="text-black">
                <td width="5%">6.</td>
                <td width="35%">Lainnya</td>
                <td width="20%" class="text-center">
                    @forelse(json_decode($anggota_detail->jns_gotong_royong) as $value)
                        @if ($value == 'Lainnya')
                            Ya @break
                        @else
                            Tidak @break
                        @endif
                    @empty
                        Tidak
                    @endforelse
                </td>
                <td width="40%"></td>
            </tr>
        </tbody>
    </table>
</body>

</html>
