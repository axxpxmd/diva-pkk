@extends('layouts.app')
@section('content')
<div class="page-heading mb-0">
    <h3>{{ $title }}</h3>
    <p class="text-subtitle text-muted">{{ $desc }}</p>
</div>
<section class="section animate__animated animate__fadeInRight">
    @include('layouts.alert')
    <div class="my-3">
        <a href="{{ route('pengajuan.index') }}" class="fs-14 text-danger fw-bold m-r-10"><i class="bi bi-arrow-left m-r-8"></i>Kembali</a>
    </div>
    <div class="card">  
        <h5 class="card-header bg-info text-white mb-2 p-3 fs-18">Menampilkan Detail Surat</h5>
        <div class="card-body fs-14">
            <div class="bg-light-secondary p-2 rounded mt-2">
                <h6 class="text-center text-black m-1">Data Pengaju</h6>
            </div>
            <div class="row mt-2">
                <div class="col-sm-6">
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Nama</label>
                        <label class="col-sm-8 col-form-label">{{ $data->anggota->nama }}</label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">No Telp</label>
                        <label class="col-sm-8 col-form-label">{{ $data->user->no_telp }}</label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold"></label>
                        <label class="col-sm-8 col-form-label">
                            <a target="blank" href="{{ route('anggota-keluarga.showByNIK', $data->nik) }}" title="Lihat Data Pengaju" class="text-info">Lebih lengkap <i class="bi bi-arrow-right"></i></a>
                        </label>
                    </div>
                </div>
            </div>
            <div class="bg-light-secondary p-2 rounded mt-2">
                <h6 class="text-center text-black m-1">Data Surat</h6>
            </div>
            <div class="col-md-12 mt-2">
                <div class="row p-0">
                    <label class="col-sm-2 col-form-label fw-bold">No Surat</label>
                    <label class="col-sm-10 col-form-label">{{ $data->no_surat }}</label>
                </div>
                <div class="row p-0">
                    <label class="col-sm-2 col-form-label fw-bold">Tanggal Pengajuan</label>
                    <label class="col-sm-10 col-form-label">{{ Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_pengajuan)->isoFormat('D MMMM Y'); }}</label>
                </div>
                <div class="row p-0">
                    <label class="col-sm-2 col-form-label fw-bold">Tanggal Surat</label>
                    <label class="col-sm-10 col-form-label">{{ Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_surat)->isoFormat('D MMMM Y'); }}</label>
                </div>
                <div class="row p-0">
                    <label class="col-sm-2 col-form-label fw-bold">Status</label>
                    <label class="col-sm-10 col-form-label">
                        @include('pages.pengajuan.status')
                    </label>
                </div>
                <div class="row p-0">
                    <label class="col-sm-2 col-form-label fw-bold">File Surat</label>
                    <label class="col-sm-10 col-form-label">
                        <a target="blank" href="{{ route('pengajuan.cetak', $data->id) }}" title="Lihat File Surat" class="text-info fs-18"><i class="bi bi-file-text"></i></a>
                    </label>
                </div>
            </div>
            @if ($data->status == 1)
            <div class="container col-md-12 mt-5">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <button class="btn btn-sm btn-success m-r-5" data-bs-toggle="modal" data-bs-target="#ttd"><i class="bi bi-check m-r-8"></i>Setujui / TTD</button>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-sm btn-danger"  data-bs-toggle="modal" data-bs-target="#tolak"><i class="bi bi-arrow-clockwise m-r-8"></i>Tolak / Kembalikan</button>
                    </div>
                </div>
            </div>
            @endif
            @if ($data->status == 3)
            <div class="container col-md-12 mt-5">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <a href="{{ route('pengajuan.kirimRW', $data->id) }}" class="btn btn-sm btn-primary m-r-5"><i class="bi bi-send m-r-8"></i>Kirim ke RW</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
{{-- TTD --}}
<div class="modal fade" id="ttd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h6 class="modal-title text-white">Tanda Tangani Surat</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-14">
                <form class="needs-validation" method="POST" action="{{ route('pengajuan.setujui', $data->id) }}" enctype="multipart/form-data" novalidate>
                    {{ method_field('POST') }}
                    {{ csrf_field() }} 
                    <input type="hidden" name="username" value="{{ Auth::user()->username }}">
                    <div class="col-md-12">
                        <div class="row">
                            <label for="password" class="col-form-label s-12 col-md-2 fw-bold">Password</label>
                            <div class="col-md-10">
                                <input type="password" name="password" id="password" placeholder="Masukan Password" class="form-control r-0 s-12" autocomplete="off" required/>
                                <div class="invalid-feedback p-0">
                                    Password tidak boleh kosong.
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-10">
                            <label class="col-md-2"></label>
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-sm btn-primary m-r-5"><i class="bi bi-pencil m-r-5"></i>Tandatangani</button>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"><i class="bi bi-x m-r-5"></i>Batalkan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Tolak --}}
<div class="modal fade" id="tolak" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h6 class="modal-title text-white">Kembalikan Surat / Tolak</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-14">
                <form class="needs-validation" method="POST" action="{{ route('pengajuan.tolak', $data->id) }}" enctype="multipart/form-data" novalidate>
                    {{ method_field('POST') }}
                    {{ csrf_field() }} 
                    <div class="col-md-12">
                        <div class="row">
                            <label for="alasan" class="col-form-label s-12 col-md-2 fw-bold">Alasan</label>
                            <div class="col-md-10">
                                <textarea name="alasan" id="alasan"class="form-control r-0 s-12" placeholder="Berikan Alasan"></textarea>
                            </div>
                        </div>
                        <div class="row m-t-10">
                            <label class="col-md-2"></label>
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-sm btn-primary m-r-5"><i class="bi bi-send m-r-5"></i>Kirim</button>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"><i class="bi bi-x m-r-5"></i>Batalkan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
    // 
</script>
@endpush