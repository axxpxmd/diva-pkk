<div class="table-responsive">
    <table class="table data-table table-hover table-bordered" style="width:100%;">
        <thead>
            <tr>
                <th class="text-center">NO</th>
                <th>Nama Ketua</th>
                <th>NO HP</th>
                <th>NIK</th>
                <th class="text-center">Awal Menjabat</th>
                <th class="text-center">Akhir Menjabat</th>
                <th class="text-center">Lama Menjabat</th>
                <th class="text-center">Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mappingRtRw as $key => $i)
                <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td>{{ $i->ketua }}</td>
                    <td>{{ $i->no_hp }}</td>
                    <td>{{ $i->nik }}</td>
                    <td class="text-center">{{ Carbon\Carbon::createFromFormat('Y-m-d', $i->awal_menjabat)->isoFormat('D MMMM Y'); }}</td>
                    <td class="text-center">{{ Carbon\Carbon::createFromFormat('Y-m-d', $i->akhir_menjabat)->isoFormat('D MMMM Y'); }}</td>
                    <td class="text-center">
                        {{ date_diff(new \DateTime($i->awal_menjabat), new \DateTime($i->akhir_menjabat))->format("%y Tahun, %m Bulan, %d Hari"); }}
                    </td>
                    <td class="text-center">
                        @if ($i->status == 1)
                            <span class="badge bg-light-success">Aktif</span>
                        @else
                            <span class="badge bg-light-danger">Tidak Aktif</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="#" onclick="edit({{ $i->id }})"><i class="bi bi-pencil-fill"></i></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>