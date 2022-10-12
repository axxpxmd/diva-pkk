@extends('layouts.app')
@section('content')
<div class="page-heading mb-0">
    <h3>{{ $title }}</h3>
    <p class="text-subtitle text-muted">{{ $desc }}</p>
</div>
<section class="section animate__animated animate__fadeInRight">
    <div class="card">  
        <h5 class="card-header bg-info text-white mb-2 p-3 fs-18">Data {{ $kategori == 'rt' ? 'RT' : 'RW' }}</h5>
        <div class="card-body fs-14">
            <div class="my-3">
                <a href="{{ route('rumah.index') }}" class="fs-14 text-danger fw-bold m-r-10"><i class="bi bi-arrow-left m-r-8"></i>Kembali</a>
            </div>
            <hr>
            <div class="row mt-2">
                <div class="col-sm-6">
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Kecamatan</label>
                        <label class="col-sm-8 col-form-label">{{ $data->n_kecamatan }}</label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Kelurahan</label>
                        <label class="col-sm-8 col-form-label">{{ $data->n_kelurahan }}</label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">RW</label>
                        <label class="col-sm-8 col-form-label">{{ $data->rw }}</label>
                    </div>
                    @if ($kategori == 'rt')
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">RT</label>
                        <label class="col-sm-8 col-form-label">{{ $data->rt }}</label>
                    </div>
                    @endif
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </div>
    <div class="card">  
        <h5 class="card-header bg-info text-white mb-2 p-3 fs-18">Daftar Ketua {{ $kategori == 'rt' ? 'RT' : 'RW' }}</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table data-table table-hover table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th>Nama Ketua {{ $kategori == 'rt' ? 'RT' : 'RW' }}</th>
                            <th>NO HP</th>
                            <th>NIK</th>
                            <th class="text-center">Awal Menjabat</th>
                            <th class="text-center">Akhir Menjabat</th>
                            <th class="text-center">Lama Menjabat</th>
                            <th class="text-center">Status Login</th>
                            <th class="text-center">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($listKetua as $key => $i)
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
                                    {{ $i->user ? 'Ada' : 'Tidak Ada' }}
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
                                <td colspan="10" class="text-center">Tidak ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection
@push('script')
<script type="text/javascript">
    // 
</script>
@endpush