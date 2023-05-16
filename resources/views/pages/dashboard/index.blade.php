@extends('layouts.app')
@section('content')
<div class="page-heading">
    <div class="row">
        <div class="col-sm-6">
            <h3>{{ $title }} </h3>
        </div>
        <div class="col-sm-6 text-end">
            <h3><span class="fs-16 text-black-50">{{ Auth::user()->modelHasRole->role->name }} {{ Auth::user()->dasawisma_id != 0 ? 'Dasawisma ' . Auth::user()->dasawisma->nama : '' }}</span></h3>
        </div>
    </div>
</div>
<section class="section animate__animated animate__fadeInRight">
<div class="col-12">
    <div style="margin-bottom: -15px !important">
        <div class="card shadow-sm border-2">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-auto mb-5-m">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalFilter" class="btn btn-sm btn-success fs-14">Pilih Filter<i class="bi bi-filter m-l-8"></i></a>
                    </div>
                    <div class="col-auto">
                        <div class="row">
                            <div class="col-auto">
                                <span class="fs-14">Tahun : {{ $tahun ? $tahun : '-' }}</span>
                            </div>
                            <div class="col-auto">
                                <span class="fs-14">Kecamatan : {{ $kecamatan_id ? $kecamatan ? $kecamatan->n_kecamatan : '-' : '' }}</span>
                            </div>
                            <div class="col-auto">
                                <span class="fs-14">Kelurahan : {{ $kelurahan_id ? $kelurahan ? $kelurahan->n_kelurahan : '-' : '' }}</span>
                            </div>
                            <div class="col-auto">
                                <span class="fs-14">RW : {{ $rtrw_id ? $rtrw ? $rtrw->rw : '-' : '' }}</span>
                            </div>
                            <div class="col-auto">
                                <span class="fs-14">RT : {{ $rtrw_id ? $rtrw ? $rtrw->rt : '-' : '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <ul class="nav nav-pills justify-content-center mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link fs-14 active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">WARGA</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fs-14" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">RUMAH</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fs-14" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">KEGIATAN</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="row">
                <div class="col-sm" style="margin-bottom: -15px !important">
                    <div class="card" style="border-left: 0.35rem solid #FC4B6C !important">
                        <div class="card-body fs-14 fw-bold">
                            <div class="row">
                                <div class="col">
                                    <div class="fw-bold fs-14 text-danger mb-1">Jumlah Rumah</div>
                                    <div class="fw-bold fs-18 text-black">{{ $totalRumah }} <sup class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-up text-success"></i> 0%</sup></div>
                                </div>
                                <div class="col-auto fs-20">
                                    <i class="bi bi-house-fill text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm" style="margin-bottom: -15px !important">
                    <div class="card" style="border-left: 0.35rem solid #0BB2FB !important">
                        <div class="card-body fs-14 fw-bold">
                            <div class="row">
                                <div class="col">
                                    <div class="fw-bold fs-14 text-info mb-1">Jumlah KK</div>
                                    <div class="fw-bold fs-18 text-black">{{ $jumlahKK }} <sup class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-down text-danger"></i> 0%</sup></div>
                                </div>
                                <div class="col-auto fs-20">
                                    <i class="bi bi-file-earmark-text-fill text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm" style="margin-bottom: -15px !important">
                    <div class="card" style="border-left: 0.35rem solid #4e73df !important">
                        <div class="card-body fs-14 fw-bold">
                            <div class="row">
                                <div class="col">
                                    <div class="fw-bold fs-14 text-primary mb-1">Jumlah Warga</div>
                                    <div class="fw-bold fs-18 text-black">{{ $jumlahAnggota }} <sup class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-up text-success"></i> 0%</sup></div>
                                </div>
                                <div class="col-auto fs-20">
                                    <i class="bi bi-people-fill text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header bg-info text-white fw-bold fs-16 px-3 py-2">Data Lainnya</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mt-3 fs-14">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Data</th>
                                            <th>Jumlah</th>
                                            <th>Persen (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>PUS</td>
                                            <td class="text-center">
                                                {{ $totalPus }} 
                                                <sup class="text-black-50"><i class="fw-bold bi bi-arrow-down text-danger"></i> 10%</sup>
                                            </td>
                                            <td class="text-center">
                                                {{ $totalPus / $jumlahAnggota * 100 }}%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>WUS</td>
                                            <td class="text-center">
                                                {{ $totalWus }}
                                                <sup class="text-black-50"><i class="fw-bold bi bi-arrow-up text-success"></i> 10%</sup>
                                            </td>
                                            <td class="text-center">
                                                {{ $totalWus / $jumlahAnggota * 100 }}%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>Stunting</td>
                                            <td class="text-center">
                                                {{ $totalStunting }}
                                                <sup class="text-black-50"><i class="fw-bold bi bi-arrow-up text-success"></i> 10%</sup>
                                            </td>
                                            <td class="text-center">
                                                {{ $totalStunting / $jumlahAnggota * 100 }}%
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-header bg-info text-white fw-bold fs-16 px-3 py-2">Status Perkawinan</div>
                        <div class="card-body p-2">
                            @include('pages.dashboard.perkawinan_pie')
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col-sm-6" style="margin-bottom: -15px !important">
                            <div class="card">
                                <div class="card-body px-2 py-3 text-center">
                                    <div class="fw-bold fs-14 text-danger mb-3">Tangsel</div>
                                    <div class="fw-bold fs-18 text-black">{{ $totalDomTangsel }} <sup class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-up text-success"></i> 0%</sup></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6" style="margin-bottom: -15px !important">
                            <div class="card">
                                <div class="card-body px-2 py-3 text-center">
                                    <div class="fw-bold fs-14 text-success mb-3">Luar Tangsel</div>
                                    <div class="fw-bold fs-18 text-black">{{ $totalDomLuarTangsel }} <sup class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-down text-danger"></i> 0%</sup></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3" style="margin-bottom: -15px !important">
                            <div class="card" style="border-bottom: 0.35rem solid #FC4B6C !important">
                                <div class="card-body px-2 py-3 text-center">
                                    <div class="fw-bold fs-14 text-danger mb-3">Lajang</div>
                                    <div class="fw-bold fs-18 text-black">{{ $totalLajang }} <sup class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-up text-success"></i> 0%</sup></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3" style="margin-bottom: -15px !important">
                            <div class="card" style="border-bottom: 0.35rem solid #39CB7F !important">
                                <div class="card-body px-2 py-3 text-center">
                                    <div class="fw-bold fs-14 text-success mb-3">Menikah</div>
                                    <div class="fw-bold fs-18 text-black">{{ $totalMenikah }} <sup class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-down text-danger"></i> 0%</sup></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3" style="margin-bottom: -15px !important">
                            <div class="card" style="border-bottom: 0.35rem solid #4e73df  !important">
                                <div class="card-body px-2 py-3 text-center">
                                    <div class="fw-bold fs-14 text-primary mb-3">Janda</div>
                                    <div class="fw-bold fs-18 text-black">{{ $totalJanda }} <sup class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-up text-success"></i> 0%</sup></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3" style="margin-bottom: -15px !important">
                            <div class="card" style="border-bottom: 0.35rem solid #FDC90F !important">
                                <div class="card-body px-2 py-3 text-center">
                                    <div class="fw-bold fs-14 text-warning mb-3">Duda</div>
                                    <div class="fw-bold fs-18 text-black">{{ $totalDuda }} <sup class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-up text-success"></i> 0%</sup></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body p-0">
                            @include('pages.dashboard.jenis_kelamin_pie')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            
        </div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
    </div>
</section>
@include('pages.dashboard.filter_dashboard')
@endsection
@push('script')
<script type="text/javascript">
    $('.select2').select2({
        dropdownParent: $('#modalFilter')
    });
</script>
@endpush
