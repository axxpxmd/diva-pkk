@extends('layouts.app')
@section('content')
<div class="page-heading mb-0">
    <h3>{{ $title }}</h3>
    <p class="text-subtitle text-muted">{{ $desc }}</p>
</div>
<section class="section animate__animated animate__fadeInRight">
    <div class="card">  
        <h5 class="card-header bg-info text-white mb-2 p-3 fs-18">Anggota Keluarga | 
            @if ($anggota->status_hidup == 1)
            <span class="badge bg-light-success m-0 fs-12">Hidup</span>     
            @else
            <span class="badge bg-light-danger m-0 fs-12">Meninggal</span>
            @endif
        </h5>
        <div class="card-body fs-14">
            @if ($anggota->status_hidup == 1)
                @include('pages.anggota_keluarga.show.hidup')
            @else
                @include('pages.anggota_keluarga.show.meninggal')
            @endif
        </div>
    </div>
</section>
<div class="modal fade" id="detailRumah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white">Detail Rumah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-14">
                <div class="row">
                    <label class="col-sm-4 col-form-label fw-bold">Jamban</label>
                    <label class="col-sm-8 col-form-label" id="jamban"></label>
                </div>
                <div class="row">
                    <label class="col-sm-4 col-form-label fw-bold">Pembuangan Sampah</label>
                    <label class="col-sm-8 col-form-label" id="tempat_sampah"></label>
                </div>
                <div class="row">
                    <label class="col-sm-4 col-form-label fw-bold">Pembuangan Limbah</label>
                    <label class="col-sm-8 col-form-label" id="saluran_pmbngn"></label>
                </div>
                <div class="row">
                    <label class="col-sm-4 col-form-label fw-bold">Stiker P4K</label>
                    <label class="col-sm-8 col-form-label" id="stiker_p4k"></label>
                </div>
                <div class="row">
                    <label class="col-sm-4 col-form-label fw-bold">Kriteria Rumah</label>
                    <label class="col-sm-8 col-form-label" id="kriteria_rmh"></label>
                </div>
                <div class="row">
                    <label class="col-sm-4 col-form-label fw-bold">Layak Huni</label>
                    <label class="col-sm-8 col-form-label" id="layak_huni"></label>
                </div>
                <div class="row">
                    <label class="col-sm-4 col-form-label fw-bold">Sumber Air</label>
                    <label class="col-sm-8 col-form-label" id="sumber_air"></label>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
    function getDetailRumah(id){
        $('#detailRumah').modal('show');
        $.get("{{ Route('getDetailRumah', ':id') }}".replace(':id', id), function(data){
            ya    = '<span class="badge bg-light-success">Ya</span>';
            tidak = '<span class="badge bg-light-danger">Tidak</span>';
            sehat = '<span class="badge bg-light-success">Sehat</span>';
            Tidaksehat = '<span class="badge bg-light-danger">Tidak Sehat</span>';

            $('#jamban').html(data.jamban == 0 ? 'Tidak Punya' : data.jamban + ' Buah' );
            $('#tempat_sampah').html(data.tempat_smph == 1 ? ya : tidak);
            $('#saluran_pmbngn').html(data.saluran_pmbngn == 1 ? ya : tidak);
            $('#stiker_p4k').html(data.stiker_p4k == 1 ? ya : tidak);
            $('#kriteria_rmh').html(data.kriteria_rmh == 1 ? sehat : Tidaksehat);
            $('#layak_huni').html(data.layak_huni == 1 ? ya : tidak);
            listSumberAir = '';
            $.each(JSON.parse(data.sumber_air), function(index, value){
                listSumberAir += "<li>" + value +"</li>";
            });
            $('#sumber_air').html(listSumberAir);
        });
    }
</script>
@endpush