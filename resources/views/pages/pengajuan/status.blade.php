@if ($data->status == 1)
    <span class="badge bg-warning">Proses RT</span>
@endif
@if ($data->status == 2)
    <span class="badge bg-danger">Ditolak RT</span>
@endif
@if ($data->status == 3)
    <span class="badge bg-success">Disetujui RT</span>
@endif
@if ($data->status == 4)
    <span class="badge bg-warning">Proses RW</span>
@endif
@if ($data->status == 5)
    <span class="badge bg-danger">Ditolak W</span>
@endif
@if ($data->status == 6)
    <span class="badge bg-success">Disetujui RW</span>
@endif