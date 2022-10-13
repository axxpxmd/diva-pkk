@extends('layouts.app')
@section('content')
<div class="page-heading mb-0">
    <h3>{{ $title }}</h3>
    <p class="text-subtitle text-muted">{{ $desc }}</p>
</div>
<section class="section animate__animated animate__fadeInRight">
    <div class="my-3">
        <a href="{{ route('kelurahan.index') }}" class="fs-14 text-danger fw-bold m-r-10"><i class="bi bi-arrow-left m-r-8"></i>Kembali</a>
    </div>
    <div class="card">  
        <h5 class="card-header bg-info text-white mb-2 p-3 fs-18">Data Kelurahan {{ $data->n_kelurahan }}</h5>
        <div class="card-body fs-14">
            <div class="row mt-2">
                <div class="col-sm-6">
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Kecamatan</label>
                        <label class="col-sm-8 col-form-label">{{ $data->kecamatan->n_kecamatan }} &nbsp; ( {{ $data->kecamatan->kode }} )</label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Kelurahan</label>
                        <label class="col-sm-8 col-form-label">{{ $data->n_kelurahan }}</label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Kode Kelurahan</label>
                        <label class="col-sm-8 col-form-label">{{ $data->kode }}</label>
                    </div>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
            <div class="bg-light-secondary p-2 rounded mt-2">
                <h6 class="text-center text-black m-1">Detail Kelurahan {{ $data->n_kelurahan }}</h6>
            </div>
            <div class="row mt-2">
                <div class="col-sm-6">
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Jumlah RW</label>
                        <label class="col-sm-8 col-form-label">{{ $data->rw->count() }}</label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Jumlah RT</label>
                        <label class="col-sm-8 col-form-label">{{ $data->rt->count() }}</label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Jumlah Rumah</label>
                        <label class="col-sm-8 col-form-label">{{ $data->rumah->count() }}</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Jumlah Kartu Keluarga</label>
                        <label class="col-sm-8 col-form-label">{{ $data->kk->count() }}</label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Jumlah Warga</label>
                        <label class="col-sm-8 col-form-label">{{ $data->warga->count() }}</label>
                    </div>
                </div>
            </div>
            <div class="bg-light-secondary p-2 rounded mt-2">
                <h6 class="text-center text-black m-1">Detail Warga Kelurahan {{ $data->n_kelurahan }}</h6>
            </div>
            <div class="row mt-2">
                <div class="col-sm-6">
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Laki - Laki</label>
                        <label class="col-sm-8 col-form-label">{{ $data->warga(1)->count() }} Orang</label>
                    </div> 
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Perempuan</label>
                        <label class="col-sm-8 col-form-label">{{ $data->warga(2)->count() }} Orang</label>
                    </div> 
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Balita</label>
                        <label class="col-sm-8 col-form-label">{{ $data->warga(3)->count() }} Anak</label>
                    </div> 
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">PUS <span class="fs-12 text-black-50">(Pasangan Usia Subur)</span></label>
                        <label class="col-sm-8 col-form-label">{{ $data->warga(4)->count() }} Pasang</label>
                    </div> 
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">WUS <span class="fs-12 text-black-50">(Wanita Usia Subur)</span></label>
                        <label class="col-sm-8 col-form-label">{{ $data->warga(5)->count() }} Orang</label>
                    </div> 
                </div>
                <div class="col-sm-6">
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">3 Buta</label>
                        <label class="col-sm-8 col-form-label">{{ $data->warga(6)->count() }} Orang</label>
                    </div> 
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Ibu Hamil</label>
                        <label class="col-sm-8 col-form-label">{{ $data->warga(7)->count() }} Orang</label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Ibu Menyusui</label>
                        <label class="col-sm-8 col-form-label">{{ $data->warga(8)->count() }} Orang</label>
                    </div> 
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Berkebutuhan Khusus</label>
                        <label class="col-sm-8 col-form-label">{{ $data->warga(9)->count() }} Orang</label>
                    </div> 
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Lansia</label>
                        <label class="col-sm-8 col-form-label">{{ $data->warga(10)->count() }} Orang</label>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <div class="card">  
        <h5 class="card-header bg-info text-white mb-2 p-3 fs-18">Daftar Ketua Kelurahan {{ $data->n_kelurahan }}</h5>
        <div class="card-body">
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
                            <th class="text-center">Status Login</th>
                            <th class="text-center">Status</th>
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
                                    @if ($i->user)
                                        Ada / {{ $i->user->s_aktif == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                    @else
                                        Tidak ada
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($i->status == 1)
                                        <span class="badge bg-light-success">Aktif</span>
                                    @else
                                        <span class="badge bg-light-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data.</td>
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