@extends('layouts.app')
@section('content')
<div class="page-heading mb-0">
    <h3>{{ $title }}</h3>
    <p class="text-subtitle text-muted">{{ $desc }}</p>
</div>
<section class="section animate__animated animate__fadeInRight">
    @if ($role_id != 4 && $role_id != 5)
    <div class="mb-3 text-right">
        <a href="#" data-bs-toggle="modal" data-bs-target="#modalForm" class="btn btn-sm btn-success px-2"><i class="bi bi-plus fw-bolder fs-16 m-r-5"></i>Tambah Data</a>
    </div>
    @endif
    <div class="card my-2">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 px-0">
                    @include('layouts.alamat_filter')
                    <div class="row mb-2">
                        <label class="col-form-label col-md-3 text-end fw-bolder fs-14">Rumah</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" name="rumah_filter" id="rumah_filter">
                                <option value="">Pilih</option>
                            </select>
                            <div class="invalid-feedback">
                                Silahkan pilih Rumah.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 px-0">
                    <div class="row mb-2">
                        <label for="status_hidup" class="col-form-label col-md-3 text-end fw-bolder fs-14">Status </label>
                        <div class="col-sm-8">
                            <select class="form-select select2" id="status_hidup" name="status_hidup">
                                <option value="99">Semua</option>
                                <option value="1">Hidup</option>
                                <option value="0">Meninggal</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="kelamin" class="col-form-label col-md-3 text-end fw-bolder fs-14">Kelamin </label>
                        <div class="col-sm-8">
                            <select class="form-select select2" id="kelamin" name="kelamin">
                                <option value="99">Semua</option>
                                <option value="Laki - laki">Laki - laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-8">
                            <button class="btn btn-success btn-sm mr-2" onclick="pressOnChange()"><i class="bi bi-filter m-r-8"></i>Filter</button>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <div class="card">  
        <div class="card-body">
             <div class="table-responsive">
                <table id="dataTable" class="table data-table display nowrap table-hover table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Kelamin</th>
                            <th>Agama</th>
                            <th>Domisili</th>
                            <th>Status Kawin</th>
                            <th>No Registrasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modalForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel"><span id="txtTitle"></span> Data {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <a href="{{ route('anggota-keluarga.create', 'status=1') }}" class="btn btn-sm btn-block btn-outline-success px-2 mb-2"><i class="bi bi-plus fw-bolder fs-16 m-r-5"></i>Hidup</a>
                <a href="{{ route('anggota-keluarga.create', 'status=0') }}" class="btn btn-sm btn-block btn-outline-danger px-2"><i class="bi bi-plus fw-bolder fs-16 m-r-5"></i>Meninggal</a>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
    var table = $('#dataTable').dataTable({
        scrollX: true,
        processing: true,
        serverSide: true,
        order: [ 0, 'asc' ],
        pageLength: 25,
        ajax: {
            url: "{{ route('anggota-keluarga.index') }}",
            method: 'GET',
            data: function (data) {
                data.kelamin = $('#kelamin').val();
                data.status_hidup = $('#status_hidup').val();
                data.kecamatan_filter = $('#kecamatan_filter').val();
                data.kelurahan_filter = $('#kelurahan_filter').val();
                data.rw_filter = $('#rw_filter').val();
                data.rt_filter = $('#rt_filter').val();
                data.rumah_filter = $('#rumah_filter').val();
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false},
            {data: 'nama', name: 'nama'},
            {data: 'nik', name: 'nik'},
            {data: 'kelamin', name: 'kelamin'},
            {data: 'agama', name: 'agama'},
            {data: 'domisili', name: 'domisili'},
            {data: 'status_kawin', name: 'status_kawin'},
            {data: 'no_registrasi', name: 'no_registrasi'},
            {data: 'status_hidup', name: 'status_hidup', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false}
        ]
    });

    $('#rt_filter').on('change', function(){
        val = $("#rt_filter").val();
        rw  = $("#rw_filter").val();
        kecamatan_id = $("#kecamatan_filter").val();
        kelurahan_id = $("#kelurahan_filter").val();
        console.log(val)
       
        optionRumah = "<option value=''>Pilih</option>";
        if(val == ""){
            $('#rumah_filter').html(optionRumah);
        }else{
            $('#rumah_filter').html("<option value=''>Loading...</option>");
            url = "{{ route('rumahByRTRW', ':id') }}".replace(':id', val);
            addParams = url  + '?kecamatan_id=' + kecamatan_id + '&kelurahan_id=' + kelurahan_id + '&rw=' + rw
            $.get(addParams, function(data){
                if(data){
                    $.each(data, function(index, value){
                        optionRumah += "<option value='" + value.id + "'>" + value.kepala_rumah +"</li>";
                    });
                    $('#rumah_filter').empty().html(optionRumah);

                    $("#rumah_filter").val($("#rumah_filter option:first").val());
                }else{
                    $('#rumah_filter').html(optionRumah);
                }
            }, 'JSON'); 
        }
    });

    pressOnChange();
    function pressOnChange(){
        table.api().ajax.reload();
    }
</script>
@endpush