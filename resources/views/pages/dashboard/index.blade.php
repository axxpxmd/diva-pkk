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
    <div>
        <div class="row">
            {{-- <div class="col-sm" style="margin-bottom: -15px !important">
                <div class="card" style="border-left: 0.35rem solid #FDC90F !important">
                    <div class="card-body fs-14 fw-bold">
                        <div class="row">
                            <div class="col">
                                <div class="fw-bold fs-14 text-warning mb-1">Jumlah RW</div>
                                <div class="fw-bold fs-18 text-black">50 <sup class="fs-12 text-black-50"></div>
                            </div>
                            <div class="col-auto fs-20">
                                <i class="bi bi-clipboard-fill text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm" style="margin-bottom: -15px !important">
                <div class="card" style="border-left: 0.35rem solid #39CB7F !important">
                    <div class="card-body fs-14 fw-bold">
                        <div class="row">
                            <div class="col">
                                <div class="fw-bold fs-14 text-success mb-1">Jumlah RT</div>
                                <div class="fw-bold fs-18 text-black">120</div>
                            </div>
                            <div class="col-auto fs-20">
                                <i class="bi bi-clipboard-fill text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-sm" style="margin-bottom: -15px !important">
                <div class="card" style="border-left: 0.35rem solid #FC4B6C !important">
                    <div class="card-body fs-14 fw-bold">
                        <div class="row">
                            <div class="col">
                                <div class="fw-bold fs-14 text-danger mb-1">Jumlah Rumah</div>
                                <div class="fw-bold fs-18 text-black">304 <sup class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-up text-success"></i> 10%</sup></div>
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
                                <div class="fw-bold fs-18 text-black">505 <sup class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-down text-danger"></i> 14%</sup></div>
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
                                <div class="fw-bold fs-18 text-black">932 <sup class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-up text-success"></i> 10%</sup></div>
                            </div>
                            <div class="col-auto fs-20">
                                <i class="bi bi-people-fill text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="warga" role="tabpanel" aria-labelledby="warga-tab">
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
                                                500 
                                                <sup class="text-black-50"><i class="fw-bold bi bi-arrow-down text-danger"></i> 10%</sup>
                                            </td>
                                            <td class="text-center">
                                                10%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>WUS</td>
                                            <td class="text-center">
                                                500
                                                <sup class="text-black-50"><i class="fw-bold bi bi-arrow-up text-success"></i> 10%</sup>
                                            </td>
                                                <td class="text-center">
                                                40%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>Stunting</td>
                                            <td class="text-center">
                                                500
                                                <sup class="text-black-50"><i class="fw-bold bi bi-arrow-up text-success"></i> 10%</sup>
                                            </td>
                                                <td class="text-center">
                                                2%
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
                                    <div class="fw-bold fs-18 text-black">400 <sup class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-up text-success"></i> 10%</sup></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6" style="margin-bottom: -15px !important">
                            <div class="card">
                                <div class="card-body px-2 py-3 text-center">
                                    <div class="fw-bold fs-14 text-success mb-3">Luar Tangsel</div>
                                    <div class="fw-bold fs-18 text-black">890 <sup class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-down text-danger"></i> 10%</sup></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3" style="margin-bottom: -15px !important">
                            <div class="card" style="border-bottom: 0.35rem solid #FC4B6C !important">
                                <div class="card-body px-2 py-3 text-center">
                                    <div class="fw-bold fs-14 text-danger mb-3">Lajang</div>
                                    <div class="fw-bold fs-18 text-black">400 <sup class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-up text-success"></i> 10%</sup></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3" style="margin-bottom: -15px !important">
                            <div class="card" style="border-bottom: 0.35rem solid #39CB7F !important">
                                <div class="card-body px-2 py-3 text-center">
                                    <div class="fw-bold fs-14 text-success mb-3">Menikah</div>
                                    <div class="fw-bold fs-18 text-black">890 <sup class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-down text-danger"></i> 10%</sup></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3" style="margin-bottom: -15px !important">
                            <div class="card" style="border-bottom: 0.35rem solid #4e73df  !important">
                                <div class="card-body px-2 py-3 text-center">
                                    <div class="fw-bold fs-14 text-primary mb-3">Janda</div>
                                    <div class="fw-bold fs-18 text-black">300 <sup class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-up text-success"></i> 10%</sup></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3" style="margin-bottom: -15px !important">
                            <div class="card" style="border-bottom: 0.35rem solid #FDC90F !important">
                                <div class="card-body px-2 py-3 text-center">
                                    <div class="fw-bold fs-14 text-warning mb-3">Duda</div>
                                    <div class="fw-bold fs-18 text-black">200 <sup class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-up text-success"></i> 10%</sup></div>
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
        <div class="tab-pane fade" id="rumah" role="tabpanel" aria-labelledby="rumah-tab">
            Rumah
        </div>
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
