@extends('layouts.app')
@section('content')
<div class="page-heading mb-0">
    <h3>{{ $title }}</h3>
    <p class="text-subtitle text-muted">{{ $desc }}</p>
</div>
<section class="section animate__animated animate__fadeInRight">
    @include('layouts.alert')
    <div class="my-3">
        <a href="{{ route('rt-rw.index') }}" class="fs-14 text-danger fw-bold m-r-10"><i class="bi bi-arrow-left m-r-8"></i>Kembali</a>
    </div>
    <div class="card">
        <h5 class="card-header bg-info text-white mb-2 p-3 fs-18">Daftar Ketua {{ $kategori == 'rt' ? 'RT' : 'RW' }}</h5>
        <div class="card-body fs-14">
            <div class="row mt-2">
                <div class="col-sm-6">
                    <div class="row p-0">
                        <label class="col-sm-2 col-form-label fw-bold">Kecamatan</label>
                        <label class="col-sm-8 col-form-label">{{ $rtrw->kecamatan->n_kecamatan }}</label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-2 col-form-label fw-bold">Kelurahan</label>
                        <label class="col-sm-8 col-form-label">{{ $rtrw->kelurahan->n_kelurahan}}</label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-2 col-form-label fw-bold">RW</label>
                        <label class="col-sm-8 col-form-label">{{ $rtrw->rw}}</label>
                    </div>
                    @if ($kategori == 'rt')
                    <div class="row p-0">
                        <label class="col-sm-2 col-form-label fw-bold">RT</label>
                        <label class="col-sm-8 col-form-label">{{ $rtrw->rt}}</label>
                    </div>
                    @endif
                </div>
            </div>
            <hr>
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
                            <th class="text-center">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $key => $i)
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
        </div>
    </div>
    <div class="card">
        <h5 class="card-header bg-info text-white mb-2 p-3 fs-18"><span id="textTitle">Tambah</span> Ketua {{ $kategori == 'rt' ? 'RT' : 'RW' }}</h5>
        <div class="card-body">
            <div class="col-md-6 container">
                <form id="form" class="fs-14 needs-validation" method="POST" action="{{ route('rt-rw.storeKetuaRT', ['kategori'=>$kategori]) }}" novalidate>
                    @csrf
                    <input type="text" class="d-none" id="rtrw_id" name="rtrw_id" value="{{ $rtrw->id }}"/>
                    <input type="text" class="d-none" id="id" name="id">
                    <div class="row mb-2">
                        <label for="ketua" class="col-sm-3 col-form-label fw-bold">Nama Ketua <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="ketua" id="ketua" class="form-control" placeholder="Masukan Nama Ketua {{ $kategori == 'rt' ? 'RT' : 'RW' }}" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="no_hp" class="col-sm-3 col-form-label fw-bold">No HP <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="no_hp" id="no_hp" maxlength="13" class="form-control" placeholder="Contoh : 08xxxxxxxxxx" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="nik" class="col-sm-3 col-form-label fw-bold">NIK <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="nik" id="nik" maxlength="16" class="form-control" placeholder="Masukan NIK : 16 Digit" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="awal_menjabat" class="col-sm-3 col-form-label fw-bold">Awal Menjabat <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                          <input type="date" name="awal_menjabat" id="awal_menjabat" class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="akhir_menjabat" class="col-sm-3 col-form-label fw-bold">Akhir Menjabat <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                          <input type="date" name="akhir_menjabat" id="akhir_menjabat" class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="status" class="col-sm-3 col-form-label fw-bold">Status <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-select select2" name="status" id="status">
                                <option>Pilih</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                            <div class="mt-1">
                                <span class="text-danger fs-12">Jika ingin menambahkan statuf aktif, rubah terlebih dahulu ketua yang aktif menjadi tidak aktif.</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-success fs-14"><i class="bi bi-save m-r-8"></i><span id="txtSave">Simpan Data</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });

    function edit(id){
        $('#loading').show();
        $('#textTitle').html('Edit');
        $('#id').val(id);
        $.get("{{ Route('rt-rw.editKetuaRT', [':id', 'kategori'=>$kategori]) }}".replace(':id', id), function(data){
            $('#loading').hide();
            $('#txtSave').html('Simpan Perubahan');
            $('#form').attr('action', "{{ route('rt-rw.updateKetuaRT', ['kategori'=>$kategori]) }}")

            $('#ketua').val(data.ketua);
            $('#no_hp').val(data.no_hp);
            $('#nik').val(data.nik);
            $('#awal_menjabat').val(data.awal_menjabat);
            $('#akhir_menjabat').val(data.akhir_menjabat);
            $('#status').val(data.status).trigger("change.select2");
        });
    }
</script>
@endpush